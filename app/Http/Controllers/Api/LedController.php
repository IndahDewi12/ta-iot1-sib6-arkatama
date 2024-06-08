<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Led;

class LedController extends Controller
{
    function index()
    {
        $leds = Led::orderBy('name', 'ASC')
            ->get(); // select * from led order by name asc
        $data['leds'] = $leds;

        return view('pages.led', $data);
    }

    function store(Request $request)
    {
        // membuat validasi
        $validated = $request->validate([
            'name' => [
                'required',
                'max:255',
                'min:3'
            ],
            'pin' => [
                'required',
                'numeric',
            ],
        ]);

        // insert into led (name, pin) values ('...', '...')
        $led = Led::create($validated); // orm eloquent

        return redirect()
            ->route('led-control.index')
            ->with('success', 'Data berhasil ditambahkan');
    }
}
