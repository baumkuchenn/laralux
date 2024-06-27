<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelType;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //   
        $hotels = Hotel::all();
        return view('hotel.index', compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $user = Auth::user();
        $this->authorize('employee-permission', $user);

        $types = HotelType::all();
        return view('hotel.formcreate', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $user = Auth::user();
        $this->authorize('employee-permission', $user);

        $data = new Hotel();
        $data->nama = $request->get('hotel_name');
        $data->alamat = $request->get('hotel_address');
        $data->no_telpon = $request->get('hotel_phone');
        $data->email = $request->get('hotel_email');
        $data->bintang = $request->get('hotel_bintang');
        $data->hoteltype_id = $request->get('hotel_type');
        $data->save();

        $file = $request->file('thumbnail');
        $filename = $data->id . '.' . 'jpg';
        $path = $file->move(public_path('images/thumbnail_hotel'), $filename);

        return redirect()->route('hotel.index')->with('status', 'Berhasil Menambah Data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $hotel = Hotel::find($id);
        $product = Product::with('fasilitas')->where('hotel_id', $id)->get();
        return view('hotel.detail', compact('hotel', 'product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user = Auth::user();
        $this->authorize('employee-permission', $user);

        $types = HotelType::orderBy('nama')->get();
        $data = Hotel::find($id);
        return view('hotel.formedit', compact('data', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user = Auth::user();
        $this->authorize('employee-permission', $user);

        $data = Hotel::find($id);
        $data->nama = $request->get('hotel_name');
        $data->alamat = $request->get('hotel_address');
        $data->no_telpon = $request->get('hotel_phone');
        $data->email = $request->get('hotel_email');
        $data->bintang = $request->get('hotel_bintang');
        $data->hoteltype_id = $request->get('hotel_type');
        $data->save();
        return redirect()->route('hotel.index')->with('status', 'Berhasil Mengubah Data');
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
            $data = Hotel::find($id);
            $data->delete();
            return redirect()->route('hotel.index')->with('status', 'Anda berhasil menghapus data');
        } catch (\PDOException $ex) {
            // Failed to delete data, then show exception message
            $msg = "Terjadi kesalahan pada saat menghapus data, pastikan tidak ada relasi pada data tersebut";
            return redirect()->route('hotel.index')->with('status', $msg);
        }
    }
}
