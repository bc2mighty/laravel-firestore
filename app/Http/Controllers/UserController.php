<?php

namespace App\Http\Controllers;

use Exception;
use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public $active_link = 'users';
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

    public function index() {
        try {
            $auth = app('firebase.auth');
            $signInResult = $auth->signInWithEmailAndPassword("akinadetunmise8@gmail.com", "Phil4verse13;");
            dd($signInResult->idToken());
        } catch (Exception $e) {
            echo $e->getMessage();
            dd($e);
        }
    }

    public function login(Request $request) {
        return view('auth.login');
    }

    public function dashboard(Request $request) {
        $active_link = 'dashboard';

        $product_length = 0;
        $firestore = app('firebase.firestore');

        foreach($this->categories as $key=>$collections) {
            foreach($collections as $collection){
                $products = $firestore->database()->collection('product')->document($key)->collection($collection)->documents();
                foreach($products as $key=>$product) {
                    $product_length++;
                }
            }
        }

        $orders_length = 0;

        $orders = $firestore->database()->collection('orders')->documents();

        foreach($orders as $key=>$order) {
            $orders_length++;
        }

        $users_length = 0;

        $users = $firestore->database()->collection('users')->documents();

        foreach($users as $key=>$user) {
            $users_length++;
        }

        return view('dashboard.index')->with(['active_link' => $active_link, 'products' => $product_length, 'orders' => $orders_length, 'users' => $users_length]);
    }

    public function syncDB(Request $request) {
        $firestore = app('firebase.firestore');

        foreach($this->categories as $key=>$collections) {
            foreach($collections as $collection){
                $products = $firestore->database()->collection('product')->document($key)->collection($collection)->documents();
                foreach($products as $key=>$product) {
                    // dd($product);
                    // $response = Http::post(env('CLEANCHECK_POST_PRODUCT_API_URL'), [
                    //     'cloth' => $product['cloth'],
                    //     'price' => $product['price'],
                    //     'type' => $product['type'],
                    //     'image' => $product['image'],
                    // ]);

                    $response = Http::asForm()->post(env('CLEANCHECK_POST_PRODUCT_API_URL'), [
                        'cloth' => $product['cloth'],
                        'price' => $product['price'],
                        'type' => $product['type'],
                        'image' => $product['image'],
                        'category' => $key,
                        'sub_category' => $collection,
                    ])->throw(function ($response, $e) {
                        dd($response->getBody()->getContents());
                    })->json();
                    
                    dd($response);
                }
            }
        }
    }

    public function submit_Login(Request $request) {
        $request->validate([
            'email' => 'email:rfc,dns',
            'password' => 'required',
        ]);

        try {
            $auth = app('firebase.auth');
            $signInResult = $auth->signInWithEmailAndPassword($request->email, $request->password);
            
            session(['idToken' => $signInResult->idToken()]);
            return redirect()->route('admin_dashboard')->with('success', 'Admin Signed In Successfully!');
        } catch (Exception $e) {
            $message = $e->getMessage();
            $exploded = explode("_", $message);
            $imploded = strtolower(implode(" ", $exploded));
            return redirect()->route('login')->with('danger', $imploded);
        }
    }

    public function logout(Request $request) {
        $request->session()->forget(['idToken']);

        return redirect()->route('login')->with('danger', 'Admin Signed Out Successfully!');
    }

    public function users(Request $request) {
        try {
            $firestore = app('firebase.firestore');
            $database = $firestore->database()->collection('users');
            $users = $database->documents();

            // dd($users);
            return view('users.list')->with(['active_link' => $this->active_link, 'users' => $users]);
        } catch (Exception $e) {
            $message = $e->getMessage();
            $exploded = explode("_", $message);
            $imploded = strtolower(implode(" ", $exploded));
            return redirect()->route('users')->with('danger', $imploded);
        }
    }

    public function create(Request $request) {
        return view('users.add')->with(['active_link' => $this->active_link]);
    }

    public function store(Request $request) {
        $request->validate([
            'email' => 'email:rfc,dns',
            'phone_number' => 'required',
            'fullname' => 'required',
        ]);

        $data = [
            'email' => $request->email,
            'phone number' => $request->phone_number,
            'fullname' => $request->fullname,
        ];

        try {
            $firestore = app('firebase.firestore');
            $user = $firestore->database()->collection('users')->add($data);
            // dd($user);
            return redirect()->route('users')->with('success', 'Users Created Successfully');
        } catch (Exception $e) {
            $message = $e->getMessage();
            $exploded = explode("_", $message);
            $imploded = strtolower(implode(" ", $exploded));
            // dd($message);
            return redirect()->route('create_user')->with('danger', $imploded);
        }
    }

    public function edit(Request $request, $id) {
        $firestore = app('firebase.firestore');
        $docRef = $firestore->database()->collection('users')->document($id);
        $user = $docRef->snapshot();
        
        return view('users.edit')->with(['active_link' => $this->active_link, 'user' => $user]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'email' => 'email:rfc,dns',
            'phone_number' => 'required',
            'fullname' => 'required',
        ]);

        $data = [
            'email' => $request->email,
            'phone number' => $request->phone_number,
            'fullname' => $request->fullname,
        ];

        try {
            $firestore = app('firebase.firestore');

            $user = $firestore->database()->collection('users')->document($id)->set($data, ['merge' => true]);

            return redirect()->route('users')->with('success', 'User Updated Successfully');
        } catch (Exception $e) {
            $message = $e->getMessage();
            $exploded = explode("_", $message);
            $imploded = strtolower(implode(" ", $exploded));
            // dd($message);
            return redirect()->route('edit_user', ['id' => $id])->with('danger', $imploded);
        }
    }

    public function destroy(Request $request, $id) {
        try {
            $firestore = app('firebase.firestore');
            $firestore->database()->collection('users')->document($id)->delete();

            return redirect()->route('users')->with('danger', 'User Deleted Successfully');
        } catch (Exception $e) {
            $message = $e->getMessage();
            $exploded = explode("_", $message);
            $imploded = strtolower(implode(" ", $exploded));
            // dd($message);
            return redirect()->route('users', ['id' => $id])->with('danger', $imploded);
        }
    }

    public function companyInfo() {
        // $firestore = new FirestoreClient(['projectId' => 'cleancheck-73ece']);
        // $collection =  $firestore->collection('users');
        // $userRef = $collection->document('3AoIR9VpmMXpXNkwbStHNf0asDG2');
        // $snapshot = $userRef->snapshot();
        // dd($snapshot);

        /*
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $users = $database->collection('users');
        $documentReference = $users->document('3AoIR9VpmMXpXNkwbStHNf0asDG2');
        $snapshot = $documentReference->snapshot();

        dd($snapshot);
        // dd($snapshot['email']);
        */

        /*
        $firestore = app('firebase.firestore');
        $database = $firestore->database()->collection('users');
        $users = $database->documents();
        // $snapshot = $documentReference->snapshot();
        foreach($users as $user) {
            echo $user['email']."<br>";
        }

        dd($users);
        */

        $firestore = app('firebase.firestore');
        $database = $firestore->database()->collection('users')->document('irononly')->collection('kidsCloth');
        $users = $database->documents();
        // $userSnapshot = $user->snapshot();

        dd($users);
    }

}
