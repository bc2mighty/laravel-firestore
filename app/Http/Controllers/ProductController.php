<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public $active_link = 'products';

    public $categories = [
        'irononly' => [
            'kidsCloth',
            'menCloth',
            'womenCloth',
        ],
        'otherservices' => [
            'otherservices',
        ],
        'washandiron' => [
            'kidsCloth',
            'menCloth',
            'womenCloth',
        ],
        'washonly' => [
            'menCloth',
            'womenCloth',
        ],
    ];

    public function index()
    {
        return view('products.list')->with(['active_link' => $this->active_link, 'categories' => $this->categories]);
    }

    public function get_products(Request $request) {
        $request->validate([
            'category' => 'required',
            'sub_category' => 'required',
        ]);

        $category = $request->category;
        $sub_category = $request->sub_category;

        return redirect()->route('products_category', [
            'category' => $category,
            'sub_category' => $sub_category,
        ]);
    }

    public function products_category($category, $sub_category, Request $request) {
        try {
            $firestore = app('firebase.firestore');
            $database = $firestore->database()->collection('product')->document($category)->collection($sub_category);
            $products = $database->documents();

            // dd($products);
            return view('products.products')->with(['active_link' => $this->active_link, 'products' => $products]);
        } catch (Exception $e) {
            $message = $e->getMessage();
            $exploded = explode("_", $message);
            $imploded = strtolower(implode(" ", $exploded));
            return redirect()->route('login')->with('danger', $imploded);
        }
    }
}
