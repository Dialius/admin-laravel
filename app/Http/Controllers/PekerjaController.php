<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pekerja;
use Illuminate\Support\Facades\Http;  // ← PENTING: Import ini untuk upload ke ImgBB

class PekerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $daftar_pekerja = Pekerja::paginate(10);
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
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pekerja,email',
            'skill' => 'required|string|max:255',
            'umur' => 'required|integer|min:17',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'nomor_hp' => 'required|string|max:15',
        ]);

        Pekerja::create($validated);

        return redirect()->route('pekerja.index')->with('success', 'Data pekerja berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pekerja = Pekerja::findOrFail($id);
        return view('pekerja.show', compact('pekerja'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pekerja = Pekerja::findOrFail($id);
        return view('pekerja.edit', compact('pekerja'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pekerja = Pekerja::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pekerja,email,' . $id,
            'skill' => 'required|string|max:255',
            'umur' => 'required|integer|min:17',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'nomor_hp' => 'required|string|max:15',
        ]);

        $pekerja->update($validated);

        return redirect()->route('pekerja.index')->with('success', 'Data pekerja berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pekerja = Pekerja::findOrFail($id);
        $pekerja->delete();

        return redirect()->route('pekerja.index')->with('success', 'Data pekerja berhasil dihapus!');
    }

    /**
     * Upload profile image to ImgBB
     */
    public function uploadProfile(Request $request, $id)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            // Ambil API key dari .env
            $apiKey = env('IMGBB_API_KEY');
            
            if (!$apiKey) {
                return redirect()->back()->with('error', 'API Key ImgBB belum diset di file .env');
            }
            
            // Ambil file gambar
            $image = $request->file('profile_image');
            
            // Convert image ke base64
            $imageData = base64_encode(file_get_contents($image->getRealPath()));
            
            // Upload ke ImgBB via HTTP
            $response = Http::asForm()->post('https://api.imgbb.com/1/upload', [
                'key' => $apiKey,
                'image' => $imageData,
            ]);
            
            // Cek jika berhasil
            if ($response->successful()) {
                $imageUrl = $response->json()['data']['url'];
                
                // Update pekerja
                Pekerja::where('id', $id)->update([
                    'profile_image' => $imageUrl
                ]);
                
                return redirect()->back()->with('success', 'Foto profil berhasil diupload!');
            } else {
                return redirect()->back()->with('error', 'Upload gagal ke ImgBB: ' . $response->body());
            }
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Upload gagal: ' . $e->getMessage());
        }
    }
}