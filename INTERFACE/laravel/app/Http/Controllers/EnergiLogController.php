<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EnergiLog;

class EnergiLogController extends Controller
{
    public function fuzzy()
    {
        $data = EnergiLog::orderByDesc('tanggal')->limit(10)->get()->reverse();

        return view('dashboard', compact('labels', 'values', 'fuzzies'));

    }

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
