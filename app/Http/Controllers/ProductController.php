<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        //
        $types = ProductType::all();
        $hotel = Hotel::find($id);
        return view('product.formcreate', compact('types', 'hotel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = new Product();
        $data->nama = $request->get('product_name');
        $data->hotel_id = $request->get('hotel_id');
        $data->price = $request->get('product_price');
        $data->producttype_id = $request->get('product_type');
        $data->save();

        $file = $request->file('gambar_kamar');
        $filename = $data->id . '.' . 'jpg';
        $file->move('images/products', $filename);

        return redirect()->route('hotel.show', $request->get('hotel_id'))->with('status', 'Berhasil Menambah Data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $idProduct)
    {
        //
        $types = ProductType::all();
        $product = Product::find($idProduct);
        $hotel = Hotel::find($product->hotel_id);
        return view('product.formedit', compact('types', 'hotel', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = Product::find($id);
        $data->nama = $request->get('product_name');
        $data->hotel_id = $request->get('hotel_id');
        $data->price = $request->get('product_price');
        $data->producttype_id = $request->get('product_type');
        $data->save();

        // File::delete(public_path() . "/" . $request->filepath);
        $file = $request->file('gambar_kamar');
        if ($file != null) {
            $filename = $id . '.' . 'jpg';
            File::delete(public_path() . "/images/products" . $filename);
            $file->move('images/products', $filename);
        }

        return redirect()->route('hotel.show', $request->get('hotel_id'))->with('status', 'Berhasil Mengubah Data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        $user = Auth::user();
        $this->authorize('permission', $user);
        $hotel_id = $product->hotel_id;
        try {
            $product->delete();
            $msg = 'Anda berhasil menghapus data';
        } catch (\PDOException $e) {
            $msg = 'Terjadi kesalahan pada saat menghapus data';
        }
        return redirect()->route('hotel.show', $hotel_id)->with('status', $msg);
    }
}
