<?php

namespace App\Http\Controllers;

use App\Models\HotelType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Strings;

class HotelTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $type = HotelType::all();
        // dd($type);
        return view('hoteltype.index', ['datas' => $type]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('hoteltype.formcreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = new HotelType();
        $data->nama = $request->get("type_name");
        $data->save();

        return redirect()->route('hoteltype.index')->with('status', 'Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     */
    public function show(HotelType $hotelType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = HotelType::find($id);
        // dd($data);
        return view('hoteltype.formedit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HotelType $hotelType)
    {
        //
        // $data = $hotelType;
        // $data->nama = $request->get('type_name');
        $hotelType->nama = $request->type_name;
        $hotelType->save();
        return redirect()->route('hoteltype.index')->with('status', 'Berhasil Mengubah Data');
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
            $data = HotelType::find($id);
            $data->delete();
            return redirect()->route('hoteltype.index')->with('status', 'Anda berhasil menghapus data');
        } catch (\PDOException $ex) {
            // Failed to delete data, then show exception message
            $msg = "Terjadi kesalahan pada saat menghapus data";
            return redirect()->route('hoteltype.index')->with('status', $msg);
        }
    }
}
