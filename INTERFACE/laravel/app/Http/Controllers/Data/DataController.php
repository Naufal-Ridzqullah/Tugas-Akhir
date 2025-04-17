<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\DataModel;
use App\Models\Relay;
use App\Models\ResetEnergy;
use App\Models\ResetWifi;
use Illuminate\Http\Request;
use App\Models\LuasBangunan;
use App\Models\EnergiLog;
use Illuminate\Support\Facades\Cache;


class DataController extends Controller
{
    // Menampilkan Data Sensor
    public function dashboard() {
        // Parameter listrik
        $data = DataModel::orderBy('id', 'desc')->first();

        // Relay
        $relay = Relay::first();
        $status = $relay ? $relay->status : 0;

        // Reset Energi
        $resetenergi = ResetEnergy::first();
        $statusenergi = $resetenergi ? $resetenergi->status : 0;

        // Reset Energi
        $resetwifi = ResetWifi::first();
        $statuswifi = $resetwifi ? $resetwifi->status : 0;

        // Luas bangunan
        $luas = LuasBangunan::latest()->value('luas') ?? 0;

        $energiLogs = EnergiLog::orderByDesc('tanggal')->limit(10)->get()->reverse();
        $labels = $energiLogs->pluck('tanggal');
        $values = $energiLogs->pluck('kwh');
        $fuzzies = $energiLogs->pluck('fuzzy');

        return view('dashboard', compact(
            'data', 
            'status', 
            'statusenergi', 
            'statuswifi', 
            'luas', 
            'labels', 
            'values', 
            'fuzzies'));
    }

    public function tabel() {
        $data = DataModel::orderBy('waktu', 'desc')->get();
        return view('tabel', compact('data'));
    }

    // Menyimpan Data Sensor
    public function store(Request $request){
        $data = DataModel::create([
            "Voltage" => $request->input('voltage'),
            "Current" => $request->input('current'),
            "Power" => $request->input('power'),
            "Energy" => $request->input('energy'),
            "Frequency" => $request->input('frequency'),
            "PowerFactor" => $request->input('pf')
        ]);
    
        if($data){
            return ["message" => "Tersimpan Pada Database"];
        }
        return ["message" => "Gagal Tersimpan"];
    }

    public function dataRealtime(){
    $data = DataModel::latest()->first();

    return response()->json([
            'waktu' => $data->created_at->format('d-m-Y H:i:s') ?? 'Tidak ada data',
            'cards' => [
                ['title' => 'Tegangan (Volt)', 'value' => $data->Voltage ?? 'N/A', 'unit' => 'V'],
                ['title' => 'Arus (Amper)', 'value' => $data->Current ?? 'N/A', 'unit' => 'A'],
                ['title' => 'Frekuensi (Hz)', 'value' => $data->Frequency ?? 'N/A', 'unit' => 'Hz'],
                ['title' => 'Daya (Watt)', 'value' => $data->Power ?? 'N/A', 'unit' => 'W'],
                ['title' => 'Kwh Meter', 'value' => $data->Energy ?? 'N/A', 'unit' => 'kWh'],
                ['title' => 'Power Factor', 'value' => $data->PowerFactor ?? 'N/A', 'unit' => ''],
            ]
        ]);
    }

    // Diakses oleh browser (AJAX) untuk ambil data terbaru
    public function latestDataWeb()
    {
    $data = Cache::get('esp_latest_data');
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['error' => 'Belum ada data dari ESP'], 404);
        }
    }

    // Diakses oleh ESP (POST) untuk mengirim data
    public function receiveData(Request $request)
        {

            // Mapping dari input field ke format standar sistem
            $data = [
                "Voltage" => $request->input('voltage'),
                "Current" => $request->input('current'),
                "Frequency" => $request->input('frequency'),
                "Power" => $request->input('power'),
                "Energy" => $request->input('energy'),
                "PowerFactor" => $request->input('pf'),
                "waktu" => now()->toDateTimeString(),
            ];

            // Simpan data di cache
            Cache::put('esp_latest_data', $data, now()->addMinutes(10));

            return response()->json(['status' => 'Data received']);
        }


}

