<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function contact(Request $request)
    {
        if ($request->isMethod('post')) {

            $validate = Validator::make($request->all(), [
                'email' => 'required|email',
                'name' => 'required|string|max:50',
                'number' => 'required|numeric|digits:10',
                'message' => 'required|string|max:250',
            ]);

            if ($validate->fails()) {
                return response()->json([
                    'error_message' => $validate->errors()->first(),
                    'status' => 0,
                ]);
            }
            if ($validate->passes()) {

                $data = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'number' => $request->number,
                    'message' => $request->message,
                    'created_at' => date('Y-m-d H:i:s'),
                ];

                $sub = DB::table('users')->insertGetId($data);
                if ($sub) {
                    return response()->json(['success_message' =>
                    'Added successfully.', 'status' => 1]);
                } else {
                    return response()->json(['error_message' =>
                    'Something went wrong', 'status' => 0]);
                }
            }
        }

        $result['name'] = '';
        $result['email'] = '';
        $result['number'] = '';
        $result['message'] = '';
        $result['id'] = '';

        return view('contact', compact('result'));
    }

    public function show()
    {
        $data = DB::table('users')->get();
        return view('show_contact', compact('data'));
    }

    public function view($id)
    {
        $arr = DB::table('users')->where('id', $id)->get();

        $result['name'] = $arr['0']->name;
        $result['email'] = $arr['0']->email;
        $result['number'] = $arr['0']->number;
        $result['message'] = $arr['0']->message;
        $result['id'] = $arr['0']->id;

        return view('contact', compact('result'));
    }
}
