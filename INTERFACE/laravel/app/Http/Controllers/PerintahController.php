<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Relay;
use App\Models\ResetEnergy;
use App\Models\ResetWifi;

class PerintahController extends Controller
{
    // Perintah Solid State Relay
    public function toggle(Request $request)
    {
        $relay = Relay::first();
        if (!$relay) {
            $relay = Relay::create(['status' => 0]);
        }

        $relay->update(['status' => $request->status]); // Update status di database

        return response()->json(['message' => 'Relay ' . ($request->status ? 'ON' : 'OFF')]);
    }

    public function status()
    {
        $relay = Relay::first();
        return response()->json(['status' => $relay ? $relay->status : 0]);
    }

    // Perintah Reset Energy
    public function toggleenergi(Request $request)
    {
        $resetenergi = ResetEnergy::first();
        if (!$resetenergi) {
            $resetenergi = ResetEnergy::create(['status' => 0]);
        }

        $resetenergi->update(['status' => $request->status]);

        return response()->json([
            'message' => 'Reset Energi ' . ($request->status ? 'ON' : 'OFF')
        ]);
    }

    public function statusenergi()
    {
        $resetenergi = ResetEnergy::first();
        return response()->json(['status' => $resetenergi ? $resetenergi->status : 0
        ]);
    }

        // Perintah Reset WiFi
        public function togglewifi(Request $request)
        {
            $resetwifi = ResetWifi::first();
            if (!$resetwifi) {
                $resetwifi = ResetWifi::create(['status' => 0]);
            }
    
            $resetwifi->update(['status' => $request->status]);
    
            return response()->json([
                'message' => 'Reset Wifi ' . ($request->status ? 'ON' : 'OFF')
            ]);
        }
    
        public function statuswifi()
        {
            $resetwifi = ResetWifi::first();
            return response()->json(['status' => $resetwifi ? $resetwifi->status : 0
            ]);
        }
}