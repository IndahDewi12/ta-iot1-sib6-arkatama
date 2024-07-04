<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MqSensor;
use Illuminate\Http\Request;
use App\Service\WhatsappNotificationService;
use App\Models\SentMessage;
use Carbon\Carbon;

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

    public function store(Request $request)
    {


        //$berhasil="";
        $request->validate([
            'value' => [
                'required',
                'numeric',
            ]
        ]);

        $sensorData = MqSensor::create($request->all());

        // Cek nilai sensor dan kirim notifikasi jika lebih dari 300ppm
        if ($sensorData->value > 300) {
            // Mengirim notifikasi untuk semua admin
            WhatsappNotificationService::notifikasiKebocoranGasMassal($sensorData->value);
            //$berhasil="kirim";
            //dd($berhasil);
        }

        return response()->json($sensorData, 201);
    }
}
