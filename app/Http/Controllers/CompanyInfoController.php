<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CompanyInfoController extends Controller
{
    public $active_link = 'company_infos';

    public $categories = [
        'Customer Care' => [
            'FAQs',
            'Privacy Policy',
        ]
    ];

    public function index()
    {
        return view('company_infos.list')->with(['active_link' => $this->active_link, 'categories' => $this->categories]);
    }

    public function create(Request $request, $category, $sub_category)
    {
        return view('company_infos.add')->with(['active_link' => $this->active_link, 'category' => $category, 'sub_category' => $sub_category]);
    }

    public function edit(Request $request, $id, $category, $sub_category)
    {
        $firestore = app('firebase.firestore');
        $docRef = $firestore->database()->collection('Company Info')->document($category)->collection($sub_category)->document($id);
        $company_info = $docRef->snapshot();
        
        return view('company_infos.edit')->with(['active_link' => $this->active_link, 'category' => $category, 'sub_category' => $sub_category, 'company_info' => $company_info]);
    }

    public function store(Request $request, $category, $sub_category)
    {
        $request->validate([
            'question' => '',
            'answer' => '',
            'title' => '',
            'body' => '',
        ]);

        $data = [];
        
        if($request->question && $request->question != '' && $request->answer != '') {
            $data = [
                'Question' => $request->question,
                'Answer' => $request->answer,
            ];
        }

        if($request->title && $request->title != '' && $request->body != '') {
            $data = [
                'title' => $request->title,
                'body' => $request->body,
            ];
        }

        if(count($data) < 1) {
            return redirect()->route('create_company_info', ['category' => $category, 'sub_category' => $sub_category])->with('danger', 'Please Provide Data');
        }

        try {
            $firestore = app('firebase.firestore');

            $company_info = $firestore->database()->collection('Company Info')->document($category)->collection($sub_category)->add($data);
            // dd($company_info);
            return redirect()->route('company_infos_category', ['category' => $category, 'sub_category' => $sub_category])->with('success', 'Products Created Successfully');
        } catch (Exception $e) {
            $message = $e->getMessage();
            $exploded = explode("_", $message);
            $imploded = strtolower(implode(" ", $exploded));
            // dd($message);
            return redirect()->route('create_company_info', ['category' => $category, 'sub_category' => $sub_category])->with('danger', $imploded);
        }
    }

    public function update(Request $request, $id, $category, $sub_category)
    {
        $request->validate([
            'question' => '',
            'answer' => '',
            'title' => '',
            'body' => '',
        ]);

        $data = [];
        
        if($request->question && $request->question != '' && $request->answer != '') {
            $data = [
                'Question' => $request->question,
                'Answer' => $request->answer,
            ];
        }

        if($request->title && $request->title != '' && $request->body != '') {
            $data = [
                'title' => $request->title,
                'body' => $request->body,
            ];
        }

        if(count($data) < 1) {
            return redirect()->route('edit_company_info', ['id' => $id, 'category' => $category, 'sub_category' => $sub_category])->with('danger', 'Please Provide Data');
        }

        try {
            $firestore = app('firebase.firestore');

            $company_info = $firestore->database()->collection('Company Info')->document($category)->collection($sub_category)->document($id)->set($data, ['merge' => true]);

            return redirect()->route('company_infos_category', ['category' => $category, 'sub_category' => $sub_category])->with('success', 'Product Updated Successfully');
        } catch (Exception $e) {
            $message = $e->getMessage();
            $exploded = explode("_", $message);
            $imploded = strtolower(implode(" ", $exploded));
            // dd($message);
            return redirect()->route('edit_company_info', ['id' => $id, 'category' => $category, 'sub_category' => $sub_category])->with('danger', $imploded);
        }
    }

    public function destroy(Request $request, $id, $category, $sub_category)
    {
        try {
            $firestore = app('firebase.firestore');
            $firestore->database()->collection('Company Info')->document($category)->collection($sub_category)->document($id)->delete();

            return redirect()->route('company_infos_category', ['category' => $category, 'sub_category' => $sub_category])->with('danger', 'Product Deleted Successfully');
        } catch (Exception $e) {
            $message = $e->getMessage();
            $exploded = explode("_", $message);
            $imploded = strtolower(implode(" ", $exploded));
            // dd($message);
            return redirect()->route('company_infos_category', ['category' => $category, 'sub_category' => $sub_category])->with('danger', $imploded);
        }
    }

    public function get_company_infos(Request $request) {
        $request->validate([
            'category' => 'required',
            'sub_category' => 'required',
        ]);

        $category = $request->category;
        $sub_category = $request->sub_category;

        return redirect()->route('company_infos_category', [
            'category' => $category,
            'sub_category' => $sub_category,
        ]);
    }

    public function company_infos_category($category, $sub_category, Request $request) {
        try {
            $firestore = app('firebase.firestore');
            $database = $firestore->database()->collection('Company Info')->document($category)->collection($sub_category);
            $company_infos = $database->documents();

            // dd($company_infos);
            return view('company_infos.company_infos')->with(['active_link' => $this->active_link, 'company_infos' => $company_infos, 'category' => $category, 'sub_category' => $sub_category]);
        } catch (Exception $e) {
            $message = $e->getMessage();
            $exploded = explode("_", $message);
            $imploded = strtolower(implode(" ", $exploded));
            return redirect()->route('login')->with('danger', $imploded);
        }
    }
}
