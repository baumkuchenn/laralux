<?php

namespace App\Http\Controllers;

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
            ->get();

        // total poin yang dipunya sekarang
        $points = DB::table('memberships as m')
            ->join('users as u', 'u.id', '=', 'm.users_id')
            ->where('u.id', '=', $userId)
            ->sum(DB::raw('m.points - COALESCE(m.redeempoints, 0)'));


        // Khusus untuk owner dan staff
        $allCust = DB::table('users as u')
            ->join('memberships as m', 'm.users_id', '=', 'u.id')
            ->select('u.id', 'u.name', 'u.email', 'u.created_at', DB::raw('SUM(m.points) - SUM(IFNULL(m.redeempoints, 0)) as total_poin'))
            ->groupBy('u.id', 'u.name', 'u.email', 'u.created_at')
            ->get();

        // dd($transactions);
        return view('frontend.membership', compact('membership', 'points', 'allCust'));
    }
}
