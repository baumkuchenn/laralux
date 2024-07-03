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
            ->limit(3)
            ->get();

        return view('laporan.mostReservedProduct', compact('product'));
    }

    public function richestCustomer()
    {
        $users = DB::table('transactions as t')
            ->join('memberships as m', 'm.transactions_id', '=', 't.id')
            ->join('users as u', 'u.id', '=', 'm.users_id')
            ->select('u.id', 'u.name', DB::raw('SUM(t.total + t.penukaran_poin) as total_seluruh_pembelian'))
            ->groupBy('u.id', 'u.name')
            ->orderByDesc('total_seluruh_pembelian')
            ->get();

        return view('laporan.richestCustomer', compact('users'));
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
