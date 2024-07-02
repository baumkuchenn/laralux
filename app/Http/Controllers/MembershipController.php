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

        $membership = DB::table('transactions as t')
            ->join('memberships as m', 'm.transactions_id', '=', 't.id')
            ->join('users as u', 'u.id', '=', 'm.users_id')
            ->select('m.*', 'u.*', 't.*')
            ->where('u.id', '=', $userId)
            ->where('m.points', '>', '0')
            ->get();

        $points = DB::table('transactions as t')
            ->join('memberships as m', 'm.transactions_id', '=', 't.id')
            ->join('users as u', 'u.id', '=', 'm.users_id')
            ->select('m.*', 'u.*', 't.*')
            ->where('u.id', '=', $userId)
            ->where('m.points', '>', '0')
            ->sum('m.points');
            
        // dd($transactions);
        return view('frontend.membership', compact('membership','points'));
    }

}
