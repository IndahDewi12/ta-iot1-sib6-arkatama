<?php

namespace App\Service;

use App\Models\SentMessage;
use App\Models\User;
use Illuminate\Support\Facades\Http;


class WhatsappNotificationService
{
    public static function getConfig()
    {
        return config('wasender');
    }

    public static function getToken()
    {
        return self::getConfig()['token'];
    }

    public static function getEndpoint()
    {
        return self::getConfig()['endpoint'];
    }

    public static function sendMessage($target, $message)
    {
        $endPoint = self::getEndpoint() . '/send';

        $headers = [
            'Authorization' => self::getToken()
        ];

        $options = [
            [
                'name' => 'target',
                'contents' => $target
            ],
            [
                'name' => 'message',
                'contents' => self::formatMessage($message)
            ]
        ];

        $response = Http::withHeaders($headers)
            ->asMultipart()
            ->post($endPoint, $options);

        return $response->body();
    }

    public static function formatMessage($message)
    {
        $message .= PHP_EOL;
        $message .= PHP_EOL;
        $message .= 'Dikirimkan' . ' oleh IoT Manage Indah';
        return $message;
    }

    public static function notifikasiKebocoranGas($user, $nilaiSensor)
    {

        $target = $user->phone_number;
        //$target="085606117741";
        $name = $user->name;
        //dd($target);
        $message = "Peringatan!" . PHP_EOL;
        $message .= "Halo $name terdeteksi kebocoran gas pada sensor Anda. Nilai sensor: $nilaiSensor yang berpotensi membahayakan.";

        return self::sendMessage($target, $message);
    }

    public static function notifikasiKebocoranGasMassal($nilaiSensor)
    {
        // dd($nilaiSensor);
        $nilaiMaksimalSensor = 300; // contoh
        $durasiPesan = 3; // contoh dalam menit

        $jenisSensor = 'mq5';

        // ambil user role admin dan phone_number
        $users = User::where('role', 'admin')
            ->whereNotNull('phone_number')
            ->get();

        // cek kapan terakhir notifikasi dikirim untuk type sensor ini
        $lastSent = SentMessage::where('type', $jenisSensor)
            ->orderBy('created_at', 'desc')
            ->first();

        // jika nilai sensor lebih dari nilai maksimal sensor
        if ($nilaiSensor <= $nilaiMaksimalSensor) {
            return;
        }

        // jika belum pernah dikirim atau sudah lebih dari durasi pesan
        if (!$lastSent || abs(now()->diffInMinutes($lastSent->created_at)) >= $durasiPesan) {
            foreach ($users as $user) {
                self::notifikasiKebocoranGas($user, $nilaiSensor);
            }

            // simpan ke database
            SentMessage::create([
                'type' => $jenisSensor,
            ]);
        }
    }
}
