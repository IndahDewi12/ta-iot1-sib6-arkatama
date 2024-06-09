<?php

namespace App\Http\Controllers\Api;

use App\Models\Led;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LedController extends Controller
{
    // CRUD

    // READ all data-> index (GET) -> terserah namanya
    function index()
    {
        $leds = Led::orderBy('name', 'ASC')
            ->get(); //select * from led order by name ASC
        return response()
            ->json([
                'massage' => 'Data berhasil ditampilkan',
                'data'    => $leds
            ], 200);
    }

    // READ single data -> show (GET) -> terserah namanya
    function show($id)
    {
        //select * from led where id = $id
        $led = Led::find($id); //cara 1
        //$led = Led::where('id', $id)
        //    ->first(); //cara 2

        if (!$led) { //dibaca jika led tidak ada
            return response()
                ->json([
                    'massage' => 'Data tidak berhasil ditampilkan',
                    'data'    => null
                ], 200);
        }

        return response()
            ->json([
                'massage' => 'Data berhasil ditampilkan',
                'data'    => $led
            ], 200);
    }

    // CREATE data -> store (POST) -> terserah namanya
    function store(Request $request)
    {
        $validated =  $request
            ->validate([
                "name" => [
                    "required",
                    "string",
                    "min:3",
                    "max:255",
                ],
                "pin" => [
                    "required",
                    "numeric",
                    "between:0,39",
                ],
                "status" => [
                    "required",
                    "boolean",
                ],
            ]);
        $led = Led::create($validated);
        return response()
            ->json([
                'massage' => 'Data berhasil ditampilkan',
                'data'    => $led
            ], 201); // 200 OK -> 201 Created

    }

    // UPDATE data -> update (PUT/PATCH) -> terserah namanya
    function update(Request $request, $id)
    {
        $led = Led::find($id);

        if (!$led) {
            return response()->json(['message' => 'Data not found', 'data' => null], 404);
        }

        $validated = $request->validate([
            'status' => 'required|boolean',
        ]);

        $led->status = $validated['status'];
        $led->save();

        return response()->json(['message' => 'Status updated successfully', 'data' => $led], 200);
    }

    // DELETE data -> destroy (DELETE) -> terserah namanya
    function destroy($id)
    {
        $led = Led::find($id);

        if (!$led) { // dibaca: Jika led tidak ada
            return response()
                ->json([
                    'message'   => 'Data tidak ditemukan',
                    'data'      => null
                ], 404);
        }

        $led->delete();

        return response()
            ->json([
                'message'   => 'Data berhasil dihapus',
                'data'      => $led
            ], 200);
    }
}
