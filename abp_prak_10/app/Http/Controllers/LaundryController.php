<?php

namespace App\Http\Controllers;

use App\Models\Laundry;
use Illuminate\Http\Request;

class LaundryController extends Controller
{
    public function index()
    {
        $laundries = Laundry::all();
        return view('laundry.index', compact('laundries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'jenis_layanan' => 'required',
            'berat' => 'required|numeric',
            'tanggal_transaksi' => 'required|date',
        ]);

        $harga_per_kg = 7000;
        $harga = $request->berat * $harga_per_kg;

        Laundry::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'jenis_layanan' => $request->jenis_layanan,
            'berat' => $request->berat,
            'harga' => $harga,
            'tanggal_transaksi' => $request->tanggal_transaksi,
        ]);

        return redirect('/')->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'jenis_layanan' => 'required',
            'berat' => 'required|numeric',
            'tanggal_transaksi' => 'required|date',
        ]);

        $laundry = Laundry::findOrFail($id);
        $laundry->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'jenis_layanan' => $request->jenis_layanan,
            'berat' => $request->berat,
            'harga' => $request->berat * 7000,
            'tanggal_transaksi' => $request->tanggal_transaksi,
        ]);

        return redirect('/')->with('success', 'Data berhasil diupdate');
    }


    public function destroy($id)
    {
        Laundry::destroy($id);
        return redirect('/');
    }
}
