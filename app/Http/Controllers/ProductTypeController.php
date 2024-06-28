<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $type = ProductType::all();
        return view('producttype.index', compact('type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('producttype.formcreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = new ProductType();
        $data->nama = $request->get("type_name");
        $data->save();

        return redirect()->route('producttype.index')->with('status', 'Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductType $productType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = ProductType::find($id);
        // dd($data);
        return view('producttype.formedit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductType $productType)
    {
        //
        $productType->nama = $request->type_name;
        $productType->save();
        return redirect()->route('producttype.index')->with('status', 'Berhasil Mengubah Data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = Auth::user();
        $this->authorize('employee-permission', $user);
        try {
            $data = ProductType::find($id);
            $data->delete();
            return redirect()->route('producttype.index')->with('status', 'Anda berhasil menghapus data');
        } catch (\PDOException $ex) {
            // Failed to delete data, then show exception message
            $msg = "Terjadi kesalahan pada saat menghapus data";
            return redirect()->route('producttype.index')->with('status', $msg);
        }
    }
}
