<?php

namespace App\Http\Controllers;

use App\Models\Pekerja; // Import model
use Illuminate\Http\Request;


class PekerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $daftar_pekerja = Pekerja::latest()->paginate(10);
        return view('pekerja.index', compact('daftar_pekerja'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pekerja.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'nama' => 'required|string|max:255',
        'umur' => 'required|integer|min:17|max:65',
        'jenis_kelamin' => 'required|in:L,P',
        'alamat' => 'required|string',
        'nomor_hp' => 'required|string|unique:pekerja,nomor_hp',
        'email' => 'required|email|unique:pekerja,email',
        'skill' => 'required|string',
    ]);

    Pekerja::create($request->all());

    return redirect()->route('pekerja.index')->with('success', 'Pekerja baru berhasil ditambahkan!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pekerja $pekerja)
    {
        return view('pekerja.edit', compact('pekerja'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pekerja $pekerja)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'umur' => 'required|integer|min:17|max:65',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            // Validasi unik, tapi abaikan ID pekerja saat ini
            'nomor_hp' => 'required|string|unique:pekerja,nomor_hp,' . $pekerja->id,
            'email' => 'required|email|unique:pekerja,email,' . $pekerja->id,
            'skill' => 'required|string',
        ]);

        $pekerja->update($request->all());

        return redirect()->route('pekerja.index')->with('success', 'Data pekerja berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pekerja $pekerja)
    {
        $pekerja->delete();
        return redirect()->route('pekerja.index')->with('success', 'Data pekerja berhasil dihapus!');
    }

}
