<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kelas;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $query = kelas::query();

        if($search){
            $query->where('nama_kelas', 'like', "%{$search}%");
        }

        $kelass = $query->paginate(5);

        return view('kelas', compact('kelass'));
    }
    public function create()
    {
        return view('kelas_create');
    }

    public function store(Request $request)
    {
        kelas::create($request->all());

        return redirect()->route('kelas.index')->with('success','Kelas berhasil ditambahkan');
    }

    public function edit(kelas $kela) 
    {
        return view('kelas_edit', compact('kela'));
    }

    public function update(Request $request, kelas $kela)
    {
        $kela->update($request->all());

        return redirect()->route('kelas.index')->with('success','Kelas berhasil di ganti');
    }

    public function destroy(kelas $kela)
    {
        if($kela->siswas()->count() > 0)
        {
            return redirect()->route('kelas.index')->with('error', 'Kelas masih diisi siswa!');
        }
        $kela->delete();

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus!');
    }
}
