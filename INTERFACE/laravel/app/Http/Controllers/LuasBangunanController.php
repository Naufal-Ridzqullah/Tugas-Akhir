<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LuasBangunan;

class LuasBangunanController extends Controller
{
    public function saveLuas(Request $request)
    {
        $request->validate([
            'luas' => 'required|numeric|min:1',
        ]);

        // Simpan luas baru ke database
        LuasBangunan::create(['luas' => $request->luas]);

        return response()->json(['message' => 'Luas bangunan berhasil disimpan!', 'luas' => $request->luas]);
    }

    public function luas()
    {
        // Ambil data luas terakhir jika ada
        $luas = LuasBangunan::latest()->first();
    
        return response()->json([
            'luas' => $luas ? $luas->luas : 0 ]);
    }
    
}
