<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class MembershipController extends Controller
{
    //
    public function index()
    {
        $userId = Auth::id();

        // detail poin setiap transaksi
        $membership = DB::table('transactions as t')
            ->join('memberships as m', 'm.transactions_id', '=', 't.id')
            ->join('users as u', 'u.id', '=', 'm.users_id')
            ->select('m.*', 'u.*', 't.*')
            ->where('u.id', '=', $userId)
            ->whereNull('m.deleted_at') // Exclude soft-deleted memberships
            ->get();

        // total poin yang dipunya sekarang
        $points = DB::table('memberships as m')
            ->join('users as u', 'u.id', '=', 'm.users_id')
            ->where('u.id', '=', $userId)
            ->whereNull('m.deleted_at') // Exclude soft-deleted memberships
            ->sum(DB::raw('m.points - COALESCE(m.redeempoints, 0)'));


        // Khusus untuk owner dan staff
        $allCust = DB::table('users as u')
            ->join('memberships as m', function ($join) {
                $join->on('m.users_id', '=', 'u.id')
                    ->whereNull('m.deleted_at'); // Exclude soft-deleted memberships
            })
            ->select('u.id', 'u.name', 'u.email', 'u.created_at', DB::raw('SUM(m.points) - SUM(IFNULL(m.redeempoints, 0)) as total_poin'))
            ->groupBy('u.id', 'u.name', 'u.email', 'u.created_at')
            ->get();

        // dd($transactions);
        return view('frontend.membership', compact('membership', 'points', 'allCust'));
    }

    public function create()
    {
        $user = Auth::user();
        $this->authorize('owner-permission', $user);
        $user = User::where('role', 'customer')->get();
        return view('customer.formcreate', compact('user'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $this->authorize('owner-permission', $user);
        // $user = User::where('role', 'customer')->get();
        $transaction = new Transaction();
        $transaction->transaction_date = date('Y-m-d H:i:s');
        $transaction->total = 0;
        $transaction->ppn = 0;
        $transaction->penukaran_poin = 0;
        $transaction->save();

        $selectedUser = $request->get('user');
        $transaction->membership("member", 0, $selectedUser, $transaction->id, 0);

        return redirect()->route('customer.index')->with('status', 'Berhasil Menambah Data');
    }

    public function destroy(string $id)
    {
        $user = Auth::user();
        $this->authorize('owner-permission', $user);
        try {
            Membership::where('users_id', $id)->delete();
            $msg = 'Anda berhasil menghapus data';
        } catch (\PDOException $e) {
            $msg = 'Terjadi kesalahan pada saat menghapus data';
        }
        return redirect()->route('customer.index')->with('status', $msg);
    }
}
