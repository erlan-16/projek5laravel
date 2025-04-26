<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use App\Models\kelas;
use App\Models\wali_murid;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
        $search = $request->search;
        $query = Siswa::with('kelas', 'wali_murid');

        if($search){
            $query->where('nama_siswa', 'like', "%{$search}%")
                    ->orWhere('NIS', 'like', "%{$search}%")
                    ->orWhere('tempat_lahir', 'like', "%{$search}%")
                    ->orWhere('tanggal_lahir', 'like', "%{$search}%");
        }

        $siswas = $query->paginate(5);

        return view('siswa', compact('siswas'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = kelas::all();
        $wali_murid = wali_murid::all();

        return view('siswa_create', compact('kelas', 'wali_murid'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        siswa::create($request->all());

        return redirect()->route('siswa.index')->with('success','Siswa berhasil ditambahkan!!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(siswa $siswa)
    {
        $kelas = kelas::all();
        $wali_murid = wali_murid::all();

        return view('siswa_edit', compact('kelas', 'wali_murid', 'siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, siswa $siswa)
    {
        $siswa->update($request->all());

        return redirect()->route('siswa.index')->with('success','Siswa telah di ganti!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(siswa $siswa)
    {
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success','Siswa berhasil dihapus');
    }
}