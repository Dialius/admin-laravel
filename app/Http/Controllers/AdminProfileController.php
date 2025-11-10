<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminProfileController extends Controller
{
    /**
     * Show admin profile page
     */
    public function showForm()
    {
        return view('admin.profile');
    }
    
    /**
     * Upload admin profile image
     */
    public function uploadProfile(Request $request)
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
                
                // Update admin yang login
                auth()->user()->update([
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