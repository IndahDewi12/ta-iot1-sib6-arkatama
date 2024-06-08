<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MqSensor;
use Illuminate\Http\Request;

class MqSensorController extends Controller
{
    function index()
    {
        $sensorsData = MqSensor::orderBy('created_at', 'desc')
            ->limit(20)
            ->get();

        return response()
            ->json([
                'data' => $sensorsData,
                'message' => 'Success',
            ], 200);
    }

    function show($id)
    {
        $sensorData = MqSensor::find($id);
        if ($sensorData) {
            return response()
                ->json($sensorData, 200);
        } else {
            return response()
                ->json(['message' => 'Data not found'], 400);
        }
    }

    function store(Request $request)
    {
        $request->validate([
            'value' => [
                'required',
                'numeric',
            ]
        ]);

        $sensorData = MqSensor::create($request->all());

        return response()
            ->json($sensorData, 201);
    }
}
