<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $fasilitas = Fasilitas::all();
        return view('fasilitas.index', compact('fasilitas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('fasilitas.formcreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = new Fasilitas();
        $data->nama = $request->get("nama");
        $data->deskripsi = $request->get("deskripsi");
        $data->save();

        return redirect()->route('fasilitas.index')->with('status', 'Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fasilitas $fasilitas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = Fasilitas::find($id);
        return view('fasilitas.formedit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $fasilitas = Fasilitas::find($id);
        $fasilitas->nama = $request->nama;
        $fasilitas->deskripsi = $request->deskripsi;
        $fasilitas->save();
        return redirect()->route('fasilitas.index')->with('status', 'Berhasil Mengubah Data');
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
            $data = Fasilitas::find($id);
            $data->delete();
            return redirect()->route('fasilitas.index')->with('status', 'Anda berhasil menghapus data');
        } catch (\PDOException $ex) {
            // Failed to delete data, then show exception message
            $msg = "Terjadi kesalahan pada saat menghapus data";
            return redirect()->route('fasilitas.index')->with('status', $msg);
        }
    }
}
