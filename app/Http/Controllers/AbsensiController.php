<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Matakuliah;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    // Menampilkan dan melihat absensi
    public function index(Request $request)
    {
        $matakuliahs = Matakuliah::all();
        $mahasiswas = Mahasiswa::all();

        $tanggal = $request->tanggal ?? date('Y-m-d');
        $matakuliah_id = $request->matakuliah_id;

        $absensis = collect();

        if ($matakuliah_id) {
            $absensis = Absensi::with(['mahasiswa', 'matakuliah'])
                ->where('tanggal_absensi', $tanggal)
                ->where('matakuliah_id', $matakuliah_id)
                ->get();
        }

        return view('absensi.index', compact(
    'matakuliahs',
    'tanggal',
    'matakuliah_id',
    'mahasiswas',
    'absensis'
));
    }

    // Menyimpan absensi
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_absensi' => 'required|date',
            'matakuliah_id' => 'required|exists:matakuliah,id',
            'status' => 'required|array',
            'status.*' => 'required|in:A,H,I,S'
        ]);

        foreach ($request->status as $mahasiswa_id => $status) {

            Absensi::updateOrCreate(
                [
                    'mahasiswa_id' => $mahasiswa_id,
                    'matakuliah_id' => $request->matakuliah_id,
                    'tanggal_absensi' => $request->tanggal_absensi
                ],
                [
                    'status_absen' => $status
                ]
            );
        }

        return redirect()->route('absensi.index', [
            'tanggal' => $request->tanggal_absensi,
            'matakuliah_id' => $request->matakuliah_id
        ])->with('success', 'Absensi berhasil disimpan!');

        $matakuliahs = Matakuliah::all();

$tanggal = $request->tanggal ?? date('Y-m-d');

$matakuliah_id = $request->matakuliah_id;
    }
    
}
