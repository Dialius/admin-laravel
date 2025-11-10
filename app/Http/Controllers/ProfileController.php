<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ImgBB;

class ProfileController extends Controller
{
    public function showForm()
    {
        return view('profile.upload');
    }

    public function uploadProfile(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            // Upload ke ImgBB
            $response = ImgBB::image($request->file('profile_image'));
            
            // Ambil URL gambar
            $imageUrl = $response['data']['url'];
            
            // Simpan URL ke database
            auth()->user()->update([
                'profile_image' => $imageUrl
            ]);
            
            return redirect()->back()->with('success', 'Foto profil berhasil diupload!');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Upload gagal: ' . $e->getMessage());
        }
    }
}