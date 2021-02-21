<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

class OrderController extends Controller
{
    public $active_link = 'orders';

    public function index(Request $request) {
        try {
            $firestore = app('firebase.firestore');
            $database = $firestore->database()->collection('orders');
            // $orders = $database->documents();
            $orders = $database->orderBy('createdAt', 'DESC')->documents();

            // dd($orders);
            return view('orders.list')->with(['active_link' => $this->active_link, 'orders' => $orders]);
        } catch (Exception $e) {
            $message = $e->getMessage();
            $exploded = explode("_", $message);
            $imploded = strtolower(implode(" ", $exploded));
            return redirect()->route('orders')->with('danger', $imploded);
        }
    }
}
