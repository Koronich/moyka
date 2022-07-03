<?php

namespace App\Http\Controllers;

use App\Cars;
use App\Client;
use App\Orders;
use App\Uslugi;
use App\Wokers;
use DB;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function start()
    {
        return view('pages.start');
    }

    public function choose()
    {
        return view('pages.choose');
    }

    public function profile(Request $request)
    {
        $client = Client::where('id', $request->id)->get();
        $cars = Cars::where('client_id', $request->id)->get();

        return view('pages.profile', [
            'client' => $client,
            'cars' => $cars
        ]);
    }

    public function index(Request $request)
    {
        $uslugi = Uslugi::all();
        $wokers = Wokers::all();
        $id = $request->id;
        $car = $request->car;

        return view('pages.order', [
            'uslugi' => $uslugi,
            'id' => $id,
            'car' => $car,
            'wokers' => $wokers
        ]);
    }

    public function make(Request $request)
    {
        $data = [];
        $findusluga = Uslugi::all();

        foreach ($findusluga as $value) {
            if (isset($_POST['usluga_' . $value->id])) {
                $data[] = $value->id;
            }
        }

        $type = $request->type;
        $woker = $request->woker;
        $id = $request->id;
        $car = $request->car;

        $car = Cars::where('id', $car)->first();
        $client = Client::where('id', $id)->first();
        $woker = Wokers::where('id', $woker)->first();
        $usluga = Uslugi::whereIn('id', $data)->get();
        $time = date("H:i:s", strtotime("+3 hours"));
        $start = strtotime('20:00:00');
        $end = strtotime('9:00:00');
        $time_now = strtotime($time);

        $price = 0;
        foreach ($usluga as $value) {
            if ($car->type == "Первая") {

                if ($type == 1) {
                    $price += $value->price_1;
                }
                if ($type == 2) {
                    $price += $value->price_1_1;
                }
                if ($type == 3) {
                    $price += $value->price_1_2;
                }
                if ($type == 4) {
                    $price += $value->price_1_3;
                }
                if ($type == 5) {
                    $price += $value->price_1_4;
                }
            }
            if ($car->type == "Второй") {
                if ($type == 1) {
                    $price += $value->price_2;
                }
                if ($type == 2) {
                    $price += $value->price_2_1;
                }
                if ($type == 3) {
                    $price += $value->price_2_2;
                }
                if ($type == 4) {
                    $price += $value->price_2_3;
                }
                if ($type == 5) {
                    $price += $value->price_2_4;
                }
            }
            if ($car->type == "Третья") {
                if ($type == 1) {
                    $price += $value->price_3;
                }
                if ($type == 2) {
                    $price += $value->price_3_1;
                }
                if ($type == 3) {
                    $price += $value->price_3_2;
                }
                if ($type == 4) {
                    $price += $value->price_3_3;
                }
                if ($type == 5) {
                    $price += $value->price_3_4;
                }
            }
            if ($car->type == "Четыре") {
                if ($type == 1) {
                    $price += $value->price_4;
                }
                if ($type == 2) {
                    $price += $value->price_4_1;
                }
                if ($type == 3) {
                    $price += $value->price_4_2;
                }
                if ($type == 4) {
                    $price += $value->price_4_3;
                }
                if ($type == 5) {
                    $price += $value->price_4_4;
                }
            }
        }

        if ($time_now > $start) {
            $day = 'ночная';
        } else {
            $day = 'дневная';
        }
        if ($time_now < $end) {
            $day = 'ночная';
        }

        return view('pages.finish', [
            'usluga' => $usluga,
            'type' => $type,
            'woker' => $woker,
            'client' => $client,
            'car' => $car,
            'time' => $time,
            'day' => $day,
            'price' => $price,
            'arr_usl' => serialize($data)
        ]);
    }

    public function finishpost(Request $request)
    {
        $time = strtotime($request->time);
        $current = strtotime(date("H:i:s"));
        $left = $current - $time;
        $left = date("H:i:s", $left);

        // Добавление
        $order = new Orders;
        $order->work_id = $request->woker;
        $order->car_id = $request->car;
        $order->client_id = $request->client;
        $order->day = $request->day;
        $order->usluga = $request->usluga;
        $order->comment = $request->comment;
        $order->type = $request->type;
        $order->time = $left;
        $order->price = $request->price;
        $order->created_at = date("Y-m-d H:i:s", strtotime("+3 hours"));
        $order->save();


        echo $left;
    }

    public function ordertable(Request $request)
    {

        $time_1 = strtotime($request->time_1);
        $time_1 = date("Y-m-d H:i:s", $time_1);
        $time_2 = strtotime($request->time_2);
        $time_2 = date("Y-m-d H:i:s", $time_2);
        $sum = false;
        if ($request->time_1 == '' && $request->time_2 == '' && $request->woker == '' && $request->client == '' && $request->time == '') {
            $orders = Orders::orderBy('id', 'desc')->get();
        } else {
            $query = DB::table('orders')->select();
            if ($request->time_1 != '') {
                $query->where('created_at', '>=', $time_1);
            }
            if ($request->time_2 != '') {
                $query->where('created_at', '<=', $time_2);
            }
            if ($request->woker != '') {
                $query->where('work_id', $request->woker);
                $sum = true;
            }
            if ($request->client != '') {
                $query->where('client_id', $request->client);
            }
            if ($request->time != '') {
                $query->where('day', $request->time);
            }
            $orders = $query->orderBy('id', 'desc')->get();
        }

        $price_woker = 0;
        if ($sum) {
            foreach ($orders as $value) {
                $price_woker += $value->price;
            }
            $proc = Wokers::where('id', $request->woker)->first();
            $price_woker = $price_woker * ($proc->proc / 100);
        }
        $price = 0;
        foreach ($orders as $value) {
            $price += $value->price;
        }
        $client = Client::all();
        $cars = Cars::all();
        $wokers = Wokers::all();
        $uslugi = Uslugi::all();

        return view('pages.ordertable', [
            'orders' => $orders,
            'clients' => $client,
            'cars' => $cars,
            'wokers' => $wokers,
            'uslugis' => $uslugi,
            'price_woker' => $price_woker,
            'price' => $price
        ]);
    }

    public function deleteorder(Request $request)
    {
        Orders::where('id', $request->id)->delete();

        return redirect()->back();
    }
}
