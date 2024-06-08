<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dht11Sensor;
use Illuminate\Http\Request;

class Dht11SensorController extends Controller
{
    public function index()
    {
        $data = Dht11Sensor::orderBy('created_at', 'desc')->first();
        return response()->json(['data' => $data], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'humidity' => 'required|numeric',
            'temperature' => 'required|numeric',
        ]);

        $sensorData = new Dht11Sensor();
        $sensorData->humidity = $request->humidity;
        $sensorData->temperature = $request->temperature;
        $sensorData->save();

        return response()->json(['message' => 'Data stored successfully'], 201);
    }
}
