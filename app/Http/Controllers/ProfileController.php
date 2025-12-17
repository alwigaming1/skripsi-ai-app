<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ApiKey; 
use Illuminate\Validation\ValidationException;
use Exception;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil, misi, dan manajemen API Key.
     */
    public function index()
    {
        $apiKeys = ApiKey::all();
        return view('profile.index', compact('apiKeys'));
    }
    
    /**
     * Endpoint untuk menangani permintaan penambahan API Key baru.
     */
    public function createApiKey(Request $request)
    {
        try {
            $request->validate([
                'key' => 'required|string|unique:api_keys,key|max:255', 
                'name' => 'nullable|string|max:255',
            ], [
                'key.unique' => 'API Key ini sudah terdaftar di sistem. Gunakan Key lain.'
            ]);
        } catch (ValidationException $e) {
            $errorMessage = $e->errors()['key'][0] ?? 'Input API Key tidak valid.';
            return response()->json([
                'status' => 'validation_error',
                'message' => $errorMessage
            ], 422);
        }
        
        try {
            ApiKey::create([
                'key' => trim($request->key),
                'name' => $request->name ?? 'Key Baru',
                'is_active' => true, 
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'API Key berhasil ditambahkan dan siap digunakan!'
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan Key ke database. Coba lagi atau cek log server PHP.'
            ], 500);
        }
    }
    
    /**
     * Endpoint AJAX untuk klaim token gratis (Iklan atau Misi).
     */
    public function claimTokenAjax(Request $request)
    {
        $user = Auth::user();
        $type = $request->input('type');
        $tokenAmount = 0;
        $message = "Token berhasil ditambahkan.";

        // Implementasi logika penambahan token
        if ($type === 'ad') {
            $tokenAmount = 1;
            $message = "Berhasil! +1 Token ditambahkan setelah simulasi nonton iklan.";
        } elseif ($type === 'mission') {
            // Dalam aplikasi nyata, di sini akan ada pengecekan kondisi misi
            $tokenAmount = 5;
            $message = "Selamat! Misi berhasil diklaim, +5 Token ditambahkan.";
        } else {
            return response()->json(['status' => 'error', 'message' => 'Tipe klaim tidak valid.'], 400);
        }
        
        // Tambahkan kredit ke user
        $user->increment('credits', $tokenAmount);
        
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'new_credits' => $user->credits
        ]);
    }


    public function claimMission(Request $request)
    {
        // ... (Method ini opsional, digunakan jika Anda punya form non-AJAX) ...
        return redirect()->route('profile.index')->with('success', 'Misi berhasil diklaim!');
    }
}