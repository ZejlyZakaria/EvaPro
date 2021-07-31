<?php

namespace App\Http\Controllers;

use App\Admin;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Mail\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminController2 extends Controller
{
    protected $table = "admins";

    public function addAdmin(Request $request)
    {
        $Admin = new Admin();
        $Admin->first_name = $request->first_name;
        $Admin->last_name = $request->last_name;
        $Admin->full_name = $request->full_name;
        $Admin->email = $request->email;
        $Admin->phone = $request->phone;
        $Admin->job_title = $request->job_title;

        // Validation
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'full_name' => 'required|min:7',
            'email' => 'required|email|unique:admins',
            'phone' => 'unique:admins',
            'job_title' => 'required',

        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['status' => 'error', 'errors' => $errors]);
        }

        // ADD IMAGE
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('assets/images/', $filename);
            $Admin->image = $filename;
        }


        $password = $this->getRandomPassword();
        $Admin->password = Hash::make($password);
        $details = [
            'password' => $password . '',
            'email' => $Admin->email . ''
        ];
        Mail::to($Admin->email)->send(new SendEmail($details));
        // $Admin->notify(new WelcomeEmailNotification());
        $Admin->save();
        return response()->json(['status' => 'success', 'data' => $Admin]);
    }

    public function updateAdmin(Request $request, $admin_id)
    {
        $step = "";
        $Admin = Admin::find($admin_id);
        if($Admin->email != $request->email) {
            $step = '|unique:admins';
        }
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'full_name' => 'required|min:7',
            'email' => 'required|email' . $step,
            'phone' => 'unique:admins',
            'job_title' => 'required',

        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['status' => 'error', 'errors' => $errors]);
        }


        // ADD IMAGE
        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $extension = $file->getClientOriginalExtension();
        //     $filename = time() . '.' . $extension;
        //     $file->move('assets/images/', $filename);
        //     $Admin->image = $filename;
        // }
        // $Admin->first_name ="ffff";
        // $Admin->last_name = "fdfdf";
        // $Admin->full_name = "dfdffd";
        // $Admin->save();
        DB::table('admins')->where('id', $admin_id)->update(['first_name' => 'hahaha']);
        $Admin->save();
        return response()->json(['status' => 'success', 'data' => $Admin]);
    }


    public function getProviders()
    {
        $providers = User::all();
        return response()->json(['status' => 'success', 'data' => $providers]);

    }


    public function getRandomPassword()
    {
        $random = Str::random(7);
        return $random;
    }


}
