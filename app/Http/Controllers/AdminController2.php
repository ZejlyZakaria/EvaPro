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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AdminController2 extends Controller
{
    protected $table = "admins";

    public function addAdmin(Request $request)
    {

        // Validation
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'full_name' => 'required|min:7',
            'email' => 'required|email|unique:admins',
            'gender' => 'required',
            'dateOfBirth' => 'required',
            'phone' => 'regex:/(0)[0-9]{9}$/',

        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['status' => 'error', 'errors' => $errors]);
        }

        $Admin = new Admin();
        $Admin->first_name = $request->first_name;
        $Admin->last_name = $request->last_name;
        $Admin->full_name = $request->full_name;
        $Admin->email = $request->email;
        $Admin->phone = $request->phone;
        $Admin->gender = $request->gender;
        $Admin->dateOfBirth = $request->dateOfBirth;
        $Admin->isFirstTime = true;

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
        $Admin->save();

        Mail::to($Admin->email)->send(new SendEmail($details));
        return response()->json(['status' => 'success', 'data' => $Admin]);

    }

    public function updateAdmin(Request $request, $admin_id)
    {
        $admin = Admin::find($admin_id);

        $existEmail = $admin->email;
        $isSame = "";
        if($existEmail != $request->email)
        {
            $isSame = "|unique:admins";
        }
        // Validation
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email' . $isSame,
            'gender' => 'required',
            'dateOfBirth' => 'required',
            'phone' => 'regex:/(0)[0-9]{9}$/',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['status'=>'error','errors'=>$errors]);
        }

        if ($request->hasFile('file') && $request->file != '') {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('assets/images/', $filename);
            DB::table('admins')->where('id', $admin_id)->update(['image' => $filename]);
        }


        DB::table('admins')->where('id', $admin_id)->update(['first_name' => $request->first_name]);
        DB::table('admins')->where('id', $admin_id)->update(['last_name' => $request->last_name]);
        DB::table('admins')->where('id', $admin_id)->update(['full_name' => $request->full_name]);
        DB::table('admins')->where('id', $admin_id)->update(['email' => $request->email]);
        DB::table('admins')->where('id', $admin_id)->update(['phone' => $request->phone]);
        DB::table('admins')->where('id', $admin_id)->update(['gender' => $request->gender]);
        DB::table('admins')->where('id', $admin_id)->update(['dateOfBirth' => $request->dateOfBirth]);
        return response()->json(['status' => 'success', 'data' => 'done']);
    }


    public function getProviders()
    {
        $providers = User::all();
        return response()->json(['status' => 'success', 'data' => $providers]);

    }

    public function getAdmin(Request $request, $admin_id)
    {
        $admin = Admin::find($admin_id);
        return response()->json(['status' => 'successAdmin', 'data' => $admin]);
    }

    public function updateImageAdmin(Request $request, $admin_id)
    {
        if ($request->hasFile('file')) {
            $admin = Admin::find($admin_id);
            $oldImage = "assets/images/" . $admin->image;
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('assets/images/', $filename);
            DB::table('admins')->where('id', $admin_id)->update(['image' => $filename]);
            if ($oldImage != "assets/images/avatar.jpg")
            {
                if(File::exists($oldImage)) {
                    File::delete($oldImage);
                }
            }
        }

        return response()->json(['status' => 'success', 'data' => $filename]);
    }

    public function getRandomPassword()
    {
        $random = Str::random(7);
        return $random;
    }

    public function showAdmins()
    {
        return Admin::latest()->paginate(3);
    }

    public function changePasswordConfirmationAdmin(Request $request, $admin_id)
    {
        $admin = Admin::find($admin_id);
        if (Hash::check($request->currentPass, $admin->password)) {
            $password = Hash::make($request->newPass);
            DB::table('admins')->where('id', $admin_id)->update(['password' => $password]);
            return response()->json(['status' => 'success', 'data' => 'done']);

        }
        else {
            return response()->json(['status' => 'error', 'data' => 'nodone']);
        }
    }

    public function changePasswordAdmin(Request $request, $admin_id)
    {
        $password = Hash::make($request->password);
        DB::table('admins')->where('id', $admin_id)->update(['password' => $password]);
        DB::table('admins')->where('id', $admin_id)->update(['isFirstTime' => false]);
        return response()->json(['status' => 'success', 'data' => 'done']);
    }


}
