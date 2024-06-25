<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelType;
use Illuminate\Http\Request;

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
        $types = HotelType::all();
        return view('hotel.formcreate', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = new Hotel();
        $data->nama = $request->get('hotel_name');
        $data->alamat = $request->get('hotel_address');
        $data->no_telpon = $request->get('hotel_phone');
        $data->email = $request->get('hotel_email');
        $data->bintang = $request->get('hotel_bintang');
        $data->hoteltype_id = $request->get('hotel_type');
        $data->save();
        return redirect()->route('hotel.index')->with('status', 'Berhasil Menambah Data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
    public function destroy(Hotel $hotel)
    {
        //
    }
}
