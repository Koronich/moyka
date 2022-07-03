<?php

namespace App\Http\Controllers;

use App\Cars;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    public function add(Request $request)
    {
        $client_id = $request->id;

        return view('pages.addcar', [
            'client_id' => $client_id
        ]);
    }

    public function store(Request $request)
    {
        if ($request->file('image') != null) {
            $path = $request->file('image')->store('uploads', 'public');
        } else {
            $path = '';
        }
        $cars = new Cars;
        $cars->number = $request->number;
        $cars->photo = $path;
        $cars->client_id = $request->client_id;
        $cars->marka = $request->marka;
        $cars->type = $request->type;
        $cars->save();

        return redirect()->route('profile', $request->client_id);
    }
}
