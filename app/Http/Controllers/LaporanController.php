<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function mostReservedProduct()
    {

        // return view('frontend.detailreceipt', compact('transaction'));
    }

    public function richestCustomer()
    {
    }

    public function richestPoinCustomer()
    {
        $topUser = DB::table('users as u')
            ->join('memberships as m', 'm.users_id', '=', 'u.id')
            ->select('u.id', 'u.name', 'u.email', 'u.created_at', DB::raw('(SUM(m.points) - SUM(m.redeempoints)) as total_poin'))
            ->groupBy('u.id', 'u.name', 'u.email', 'u.created_at')
            ->orderBy('total_poin', 'desc')
            ->limit(1)
            ->first();

        return view('laporan.richestPointCustomer', compact('topUser'));
    }
}
