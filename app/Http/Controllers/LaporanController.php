<?php

namespace App\Http\Controllers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function mostReservedProduct()
    {

        $product = DB::table('products as p')
        ->join('products_transactions as pt', 'p.id', '=', 'pt.products_id')
        ->select('p.id', 'p.nama', DB::raw('sum(pt.quantity) as jumlah_direservasi'))
        ->groupBy('p.id', 'p.nama')
        ->orderBy('jumlah_direservasi', 'desc')
        ->limit(5)
        ->get();

        return view('laporan.mostReservedProduct', compact('product'));
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
            ->limit(5)
            ->get();


        return view('laporan.richestPointCustomer', compact('topUser'));
    }
}
