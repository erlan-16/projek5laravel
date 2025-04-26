<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\wali_murid;

class WaliMuridController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $query = wali_murid::query();

        if($search){
            $query->where('nama_wali', 'like', "%{$search}%")
                    ->orWhere('kontak', 'like', "%{$search}%");
        }

        $wali_murids = $query->paginate(5);

        return view('wali_murid', compact('wali_murids'));
    }
    public function create()
    {
        return view('walimurid_create');
    }

    public function store(Request $request)
    {
        wali_murid::create($request->all());

        return redirect()->route('wali-murid.index')->with('success','Orang tua berhasil ditambahkan');
    }

    public function edit(wali_murid $wali_murid) 
    {
        return view('walimurid_edit', compact('wali_murid'));
    }

    public function update(Request $request, wali_murid $wali_murid)
    {
        $wali_murid->update($request->all());

        return redirect()->route('wali-murid.index')->with('success','Orang tua berhasil di ganti');
    }

    public function destroy(wali_murid $wali_murid)
    {
        if($wali_murid->siswas()->count() > 0)
        {
            return redirect()->route('wali-murid.index')->with('error', 'Orang tua masih terdapat nama siswa!');
        }
        $wali_murid->delete();

        return redirect()->route('wali-murid.index')->with('success', 'Orang tua berhasil dihapus!');
    }
}
