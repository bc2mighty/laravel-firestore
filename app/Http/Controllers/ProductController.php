<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Google\Cloud\Storage\StorageClient;
use App\Imports\ProductImport;
use Excel;

class ProductController extends Controller
{
    public $active_link = 'products';

    public $categories = [
        'irononly' => [
            'kidsCloth' => 'Kids',
            'menCloth' => 'Men',
            'womenCloth' => 'Women',
        ],
        'otherservices' => [
            'otherservices' => 'OtherServices',
        ],
        'washandiron' => [
            'kidsCloth' => 'Kids',
            'menCloth' => 'Men',
            'womenCloth' => 'Women',
        ],
        'washonly' => [
            'menCloth' => 'Men',
            'womenCloth' => 'Kids',
        ],
    ];

    public $categories_texts = [
        "washandiron" => "wash and iron",
        "irononly" => "iron only",
        "otherservices" => "OtherServices",
        "washonly" => "Wash Only",
    ];

    public function index()
    {
        return view('products.list')->with(['active_link' => $this->active_link, 'categories' => $this->categories]);
    }

    public function create(Request $request, $category, $sub_category)
    {
        return view('products.add')->with(['active_link' => $this->active_link, 'category' => $category, 'sub_category' => $sub_category]);
    }

    public function edit(Request $request, $id, $category, $sub_category)
    {
        $firestore = app('firebase.firestore');
        $docRef = $firestore->database()->collection('product')->document($category)->collection($sub_category)->document($id);
        $product = $docRef->snapshot();

        return view('products.edit')->with(['active_link' => $this->active_link, 'category' => $category, 'sub_category' => $sub_category, 'product' => $product]);
    }

    public function store(Request $request, $category, $sub_category)
    {
        $request->validate([
            'cloth' => 'required',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'image' => 'required|file|max:2000|mimes:jpg,png,jpeg',
        ]);

        $data = [
            'cloth' => $request->cloth,
            'price' => (float) $request->price,
        ];
        $data['type'] = $this->categories[$category][$sub_category];
        $data['category'] = $this->categories_texts[$category];

        try {
            $firestore = app('firebase.firestore');
            $storage = app('firebase.storage');
            $defaultBucket = $storage->getBucket();
            // dd($defaultBucket);
            // $storage = new StorageClient();
            $image = $request->file('image');
            $name = (string) Str::uuid().".".$image->getClientOriginalExtension();
            $pathName = $image->getPathName();
            $file = fopen($pathName, 'r');
            $object = $defaultBucket->upload($file, [
                'name' => $name,
                'predefinedAcl' => 'publicRead'
            ]);
            // $object = $storage->getBucket()->object($name);
            // $object->update(
            //     ['acl' => []],
            //     ['predefinedAcl' => 'PUBLICREAD']
            // );
            // dd($object, 'https://storage.googleapis.com/'.env('FIREBASE_PROJECT_ID').'.appspot.com/'.$name);
            $image_url = 'https://storage.googleapis.com/'.env('FIREBASE_PROJECT_ID').'.appspot.com/'.$name;
            $data['image'] = $image_url;

            $product = $this->saveProduct($data, $category, $sub_category);
            // dd($product);
            return redirect()->route('products_category', ['category' => $category, 'sub_category' => $sub_category])->with('success', 'Products Created Successfully');
        } catch (Exception $e) {
            $message = $e->getMessage();
            $exploded = explode("_", $message);
            $imploded = strtolower(implode(" ", $exploded));
            // dd($message);
            return redirect()->route('create_product', ['category' => $category, 'sub_category' => $sub_category])->with('danger', $imploded);
        }
    }

    public function store_bulk(Request $request, $category, $sub_category)
    {
        $request->validate([
            'excel_file' => 'required|file|max:5000|mimetypes:'.
                'application/vnd.ms-office,'.
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,'.
                'application/vnd.ms-excel',
        ]);

        $categories = [
            "category" => Str::ucfirst($this->categories_texts[$category]),
//            "sub_category" => $sub_category,
            "type" => $this->categories[$category][$sub_category],
        ];

        $products = Excel::toArray(new ProductImport, $request->file('excel_file'));
        $products = array_shift($products);
        foreach ($products as $product) {
            $product['cloth'] = $product['item'];
            unset($product['item']);
            $product = array_merge($product, $categories);
            $result = $this->saveProduct($product, $category, $sub_category);
        }
        return redirect()->route('products_category', ['category' => $category, 'sub_category' => $sub_category])->with('success', 'Products Created Successfully');
    }

    public function update(Request $request, $id, $category, $sub_category)
    {
        $request->validate([
            'cloth' => 'required',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'image' => 'file|max:2000|mimes:jpg,png,jpeg',
        ]);

        $data = [
            'cloth' => $request->cloth,
            'price' => (float) $request->price,
        ];

        try {
            $firestore = app('firebase.firestore');

            if($request->file('image')) {
                $storage = app('firebase.storage');
                $defaultBucket = $storage->getBucket();
                $image = $request->file('image');
                $name = (string) Str::uuid().".".$image->getClientOriginalExtension();
                $pathName = $image->getPathName();
                $file = fopen($pathName, 'r');
                $object = $defaultBucket->upload($file, [
                    'name' => $name,
                    'predefinedAcl' => 'publicRead'
                ]);
                $image_url = 'https://storage.googleapis.com/'.env('FIREBASE_PROJECT_ID').'.appspot.com/'.$name;
                $data['image_url'] = $image_url;
            }

            $product = $firestore->database()->collection('product')->document($category)->collection($sub_category)->document($id)->set($data, ['merge' => true]);

            return redirect()->route('products_category', ['category' => $category, 'sub_category' => $sub_category])->with('success', 'Product Updated Successfully');
        } catch (Exception $e) {
            $message = $e->getMessage();
            $exploded = explode("_", $message);
            $imploded = strtolower(implode(" ", $exploded));
            // dd($message);
            return redirect()->route('edit_product', ['id' => $id, 'category' => $category, 'sub_category' => $sub_category])->with('danger', $imploded);
        }
    }

    public function destroy(Request $request, $id, $category, $sub_category)
    {
        try {
            $firestore = app('firebase.firestore');
            $firestore->database()->collection('product')->document($category)->collection($sub_category)->document($id)->delete();

            return redirect()->route('products_category', ['category' => $category, 'sub_category' => $sub_category])->with('danger', 'Product Deleted Successfully');
        } catch (Exception $e) {
            $message = $e->getMessage();
            $exploded = explode("_", $message);
            $imploded = strtolower(implode(" ", $exploded));
            // dd($message);
            return redirect()->route('products_category', ['category' => $category, 'sub_category' => $sub_category])->with('danger', $imploded);
        }
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
            return view('products.products')->with(['active_link' => $this->active_link, 'products' => $products, 'category' => $category, 'sub_category' => $sub_category]);
        } catch (Exception $e) {
            $message = $e->getMessage();
            $exploded = explode("_", $message);
            $imploded = strtolower(implode(" ", $exploded));
            return redirect()->route('login')->with('danger', $imploded);
        }
    }

    public function saveProduct($data, $category, $sub_category)
    {
        $firestore = app('firebase.firestore');
        return $firestore->database()->collection('product')->document($category)->collection($sub_category)->add($data);
    }
}

//4Frappi!
