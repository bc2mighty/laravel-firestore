<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

class DispatcherController extends Controller
{
    public $active_link = 'dispatchers';

    public function index(Request $request) {
        try {
            $firestore = app('firebase.firestore');
            $database = $firestore->database()->collection('dispatchers');
            $dispatchers = $database->documents();

            // dd($dispatchers);
            return view('dispatchers.list')->with(['active_link' => $this->active_link, 'dispatchers' => $dispatchers]);
        } catch (Exception $e) {
            $message = $e->getMessage();
            $exploded = explode("_", $message);
            $imploded = strtolower(implode(" ", $exploded));
            return redirect()->route('dispatchers')->with('danger', $imploded);
        }
    }

    public function create(Request $request) {
        return view('dispatchers.add')->with(['active_link' => $this->active_link]);
    }

    public function store(Request $request) {
        $request->validate([
            'email' => 'email:rfc,dns',
            'phone_number' => 'required',
            'fullname' => 'required',
            'status' => 'required',
        ]);

        $data = [
            'email' => $request->email,
            'phone number' => $request->phone_number,
            'fullname' => $request->fullname,
            'status' => $request->status,
        ];

        try {
            $firestore = app('firebase.firestore');
            $dispatcher = $firestore->database()->collection('dispatchers')->add($data);
            // dd($dispatcher);
            return redirect()->route('dispatchers')->with('success', 'Dispatchers Created Successfully');
        } catch (Exception $e) {
            $message = $e->getMessage();
            $exploded = explode("_", $message);
            $imploded = strtolower(implode(" ", $exploded));
            // dd($message);
            return redirect()->route('create_dispatcher')->with('danger', $imploded);
        }
    }

    public function edit(Request $request, $id) {
        $firestore = app('firebase.firestore');
        $docRef = $firestore->database()->collection('dispatchers')->document($id);
        $dispatcher = $docRef->snapshot();
        
        // dd(isset($dispatcher['email']));
        return view('dispatchers.edit')->with(['active_link' => $this->active_link, 'dispatcher' => $dispatcher]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'email' => 'email:rfc,dns',
            'phone_number' => 'required',
            'fullname' => 'required',
            'status' => 'required',
        ]);

        $data = [
            'email' => $request->email,
            'phone number' => $request->phone_number,
            'fullname' => $request->fullname,
            'status' => $request->status,
        ];

        try {
            $firestore = app('firebase.firestore');

            $dispatcher = $firestore->database()->collection('dispatchers')->document($id)->set($data, ['merge' => true]);

            return redirect()->route('dispatchers')->with('success', 'Dispatcher Updated Successfully');
        } catch (Exception $e) {
            $message = $e->getMessage();
            $exploded = explode("_", $message);
            $imploded = strtolower(implode(" ", $exploded));
            // dd($message);
            return redirect()->route('edit_dispatcher', ['id' => $id])->with('danger', $imploded);
        }
    }

    public function destroy(Request $request, $id) {
        try {
            $firestore = app('firebase.firestore');
            $firestore->database()->collection('dispatchers')->document($id)->delete();

            return redirect()->route('dispatchers')->with('danger', 'Dispatcher Deleted Successfully');
        } catch (Exception $e) {
            $message = $e->getMessage();
            $exploded = explode("_", $message);
            $imploded = strtolower(implode(" ", $exploded));
            // dd($message);
            return redirect()->route('dispatchers', ['id' => $id])->with('danger', $imploded);
        }
    }
}
