<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Cars;

class ClientController extends Controller
{
    public function index()
    {
        return view('pages.newclient');
    }

    public function store(Request $request)
    {
        $client = new Client;
        $client->name = $request->name;
        $client->phone = $request->phone;
        $client->save();
        return redirect()->route('profile', $client->id);
    }

    public function edit(Request $request)
    {
        $client = Client::where('id', $request->id)->first();
        return view('pages.editclient', [
            'client' => $client,
            'id' => $request->id
        ]);
    }

    public function update(Request $request)
    {
        Client::where('id', $request->id)->update([
            'name' => $request->name,
            'phone' => $request->phone
        ]);
        return redirect()->route('profile', $request->id);
    }

    public function find(Request $request)
    {
        $bool = true;
        if ($request->name != '') {
            $client = Client::where('name', 'like', '%' . $request->name . '%')->get();
            if ($client->isEmpty()) {
                $bool = false;
            }
        }
        if ($request->number != '') {
            // $client = Client::all();
            $car = Cars::where('number', 'like', '%' . $request->number . '%')->first();
            if (empty($car)) {
                $bool = false;
            } else {
                $client = Client::where('id', $car->client_id)->get();
                if ($client->isEmpty()) {
                    $bool = false;
                }
            }
        }
        if ($bool) {
            foreach ($client as $value) {
                $url = route('profile', $value->id);
                echo '<a href="' . $url . '"> <div style="border: 1px solid black; padding: 5px 10px; border-radius:10px; width: 250px;">';
                echo 'Имя: ' . $value->name . '<br>Телефон: ' . $value->phone;
                echo '</div></a><br>';
            }
        } else {
            echo "Клиент не найден";
        }

    }
}
