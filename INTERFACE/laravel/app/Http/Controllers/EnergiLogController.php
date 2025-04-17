<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EnergiLog;

class EnergiLogController extends Controller
{
    // Menampilkan dashboard dengan data fuzzy
    public function fuzzy()
    {
        // Ambil data energi log dan ambil yang terbaru
        $data = EnergiLog::orderByDesc('tanggal')->limit(10)->get()->reverse();

        // Pisahkan data untuk chart
        $labels = $data->pluck('tanggal');
        $values = $data->pluck('kwh');
        $fuzzies = $data->pluck('fuzzy');

        // Kirimkan ke view
        return view('dashboard', compact('labels', 'values', 'fuzzies'));
    }

    // Mengambil data fuzzy dalam format JSON
    public function fuzzyJson()
    {
        // Ambil data energi log terbaru
        $data = EnergiLog::orderByDesc('tanggal')->limit(10)->get()->reverse();

        // Pisahkan data untuk chart
        $labels = $data->pluck('tanggal');
        $values = $data->pluck('kwh');
        $fuzzies = $data->pluck('fuzzy');

        // Kirimkan dalam format JSON
        return response()->json([
            'labels' => $labels,
            'values' => $values,
            'fuzzies' => $fuzzies
        ]);
    }

    // Menyimpan data fuzzy (misalnya dari ESP32)
    public function savefuzzy(Request $request)
    {
        $request->validate([
            'kwh' => 'required|numeric',
            'fuzzy' => 'required|string|max:255',
        ]);

        EnergiLog::create([
            'kwh' => $request->kwh,
            'fuzzy' => $request->fuzzy,
        ]);

        return response()->json(['message' => 'Data energi berhasil disimpan.']);
    }
}
