<?php

namespace App\Http\Controllers;

use App\Models\Pekerja;
use Illuminate\Http\Request;
use ImgBB;
use Illuminate\Support\Facades\Http;

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
        ], [
            'nama.required' => 'Nama wajib diisi',
            'umur.required' => 'Umur wajib diisi',
            'umur.min' => 'Umur minimal 17 tahun',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'alamat.required' => 'Alamat wajib diisi',
            'nomor_hp.required' => 'Nomor HP wajib diisi',
            'nomor_hp.unique' => 'Nomor HP sudah terdaftar',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'skill.required' => 'Skill wajib diisi',
        ]);

        Pekerja::create($request->all());

        // Notifikasi Success dengan Noty
        flash()->success('Data pekerja berhasil ditambahkan!');

        return redirect()->route('pekerja.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pekerja $pekerja)
    {
        return view('pekerja.show', compact('pekerja'));
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
            'nomor_hp' => 'required|string|unique:pekerja,nomor_hp,' . $pekerja->id,
            'email' => 'required|email|unique:pekerja,email,' . $pekerja->id,
            'skill' => 'required|string',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'umur.required' => 'Umur wajib diisi',
            'umur.min' => 'Umur minimal 17 tahun',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'alamat.required' => 'Alamat wajib diisi',
            'nomor_hp.required' => 'Nomor HP wajib diisi',
            'nomor_hp.unique' => 'Nomor HP sudah terdaftar',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'skill.required' => 'Skill wajib diisi',
        ]);

        $pekerja->update($request->all());

        // Notifikasi Info dengan Noty
        flash()->info('Data pekerja berhasil diperbarui!');

        return redirect()->route('pekerja.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pekerja $pekerja)
    {
        $nama_pekerja = $pekerja->nama;
        $pekerja->delete();

        // Notifikasi Warning dengan Noty
        flash()->warning("Data pekerja {$nama_pekerja} berhasil dihapus!");

        return redirect()->route('pekerja.index');
    }

    public function uploadProfile(Request $request, $id)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            // Upload ke ImgBB
            $response = ImgBB::image($request->file('profile_image'));
            
            // Ambil URL gambar
            $imageUrl = $response['data']['url'];
            
            // Update pekerja
            Pekerja::where('id', $id)->update([
                'profile_image' => $imageUrl
            ]);
            
            return redirect()->back()->with('success', 'Foto profil berhasil diupload!');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Upload gagal: ' . $e->getMessage());
        }
    }
}