<?php

namespace App\Http\Controllers;

use Exception;
use Google\Cloud\Firestore\FirestoreClient;

use Illuminate\Http\Request;

class UserController extends Controller
{
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
        return view('dashboard.index')->with(['active_link' => $active_link]);
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
        $database = $firestore->database()->collection('product')->document('irononly')->collection('kidsCloth');
        $products = $database->documents();
        // $productSnapshot = $product->snapshot();

        dd($products);
    }
}
