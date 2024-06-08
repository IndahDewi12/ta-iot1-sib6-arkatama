<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RainSensor;

class RainSensorController extends Controller
{
    public function index()
    {
        $rainSensorData = RainSensor::latest()->first();
        return response()->json(['data' => $rainSensorData]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'value' => 'required|numeric',
        ]);

        $rainSensor = new RainSensor();
        $rainSensor->value = $request->value;
        $rainSensor->save();

        return response()->json(['message' => 'Data saved successfully', 'data' => $rainSensor], 201);
    }
}
