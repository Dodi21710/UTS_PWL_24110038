<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    // Menampilkan seluruh data mata kuliah
    public function index()
    {
        $matakuliahs = Matakuliah::all();

        return view('matakuliah.index', compact('matakuliahs'));
    }

    // Menampilkan form tambah
    public function create()
    {
        return view('matakuliah.create');
    }

    // Menyimpan data mata kuliah
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:matakuliah,kode',
            'nama_matakuliah' => 'required|string|max:255'
        ]);

        Matakuliah::create([
            'kode' => $request->kode,
            'nama_matakuliah' => $request->nama_matakuliah
        ]);

        return redirect()->route('matakuliah.index')
            ->with('success', 'Mata kuliah berhasil ditambahkan!');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $matakuliah = Matakuliah::findOrFail($id);

        return view('matakuliah.edit', compact('matakuliah'));
    }

    // Memperbarui data
    public function update(Request $request, $id)
    {
        $matakuliah = Matakuliah::findOrFail($id);

        $request->validate([
            'kode' => 'required|unique:matakuliah,kode,' . $id . ',id',
            'nama_matakuliah' => 'required|string|max:255'
        ]);

        $matakuliah->update([
            'kode' => $request->kode,
            'nama_matakuliah' => $request->nama_matakuliah
        ]);

        return redirect()->route('matakuliah.index')
            ->with('success', 'Mata kuliah berhasil diperbarui!');
    }

    // Menghapus data
    public function destroy($id)
    {
        $matakuliah = Matakuliah::findOrFail($id);

        $matakuliah->delete();

        return redirect()->route('matakuliah.index')
            ->with('success', 'Mata kuliah berhasil dihapus!');
    }
}