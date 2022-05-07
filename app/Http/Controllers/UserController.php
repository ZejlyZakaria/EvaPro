<?php

namespace App\Http\Controllers;

use App\User;
use App\Notification;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Mail\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    protected $table = "users";

    public function addUser(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'gender' => 'required',
            'dateOfBirth' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'regex:/(0)[0-9]{9}$/',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'postcode' => 'required|numeric',
            'country' => 'required',
            'ssn' => 'required|numeric',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['status'=>'error','errors'=>$errors]);
        }

        $User = new User();
        $User->first_name = $request->first_name;
        $User->last_name = $request->last_name;
        $User->full_name = $request->full_name;
        $User->email = $request->email;
        $User->phone = $request->phone;
        $User->gender = $request->gender;
        $User->dateOfBirth = $request->dateOfBirth;
        $User->address = $request->address;
        if ($request->address2 != "") {
            $User->address = $User->address . '*' . $request->address2;
        }
        $User->state = $request->state;
        $User->postcode = $request->postcode;
        $User->city = $request->city;
        $User->country = $request->country;
        $User->type = $request->type;
        $User->social_security_number = $request->ssn;
        $User->isFirstTime = true;
        $User->project_count = 0;

        $password = $this->getRandomPassword();
        $User->password = Hash::make($password);
        $details = [
            'password' => $password . '',
            'email' => $User->email . ''
        ];
        $User->save();
        Mail::to($User->email)->send(new SendEmail($details));
        return response()->json(['status'=>'success','data'=>$User]);

    }

    public function getRandomPassword()
    {
        $random = Str::random(7);
        return $random;
    }

    public function getProviders()
    {
        $providers = User::all();
        return response()->json(['status' => 'success', 'data' => $providers]);

    }
    public function showUsers()
    {
        return User::latest()->paginate(6);
    }

    public function getProjectsCount(Request $request, $user_id)
    {
        $projects = DB::table('projects')->where('id_provider', $user_id)->count();
        return response()->json(['status' => 'success', 'count' => $projects]);
    }

    public function changePassword(Request $request, $user_id)
    {
        $password = Hash::make($request->password);
        DB::table('users')->where('id', $user_id)->update(['password' => $password]);
        DB::table('users')->where('id', $user_id)->update(['isFirstTime' => false]);

        $usr = DB::table('users')->where('id', $user_id)->first();

        $admn = DB::table('admins')->first();

        $notification = new Notification();
        $notification->type = "starting";
        $notification->content = $usr->full_name . " a utilisé l'application";
        $notification->seen = false;
        $notification->id_admin = $admn->id;
        $notification->save();

        return response()->json(['status' => 'success', 'data' => 'done']);
    }

    public function updateProvider(Request $request, $user_id)
    {
        $user = User::find($user_id);

        $existEmail = $user->email;
        $isSame = "";
        if($existEmail != $request->email)
        {
            $isSame = "|unique:users";
        }
        // Validation
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'gender' => 'required',
            'dateOfBirth' => 'required',
            'email' => 'required|email' . $isSame,
            'phone' => 'regex:/(0)[0-9]{9}$/',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'postcode' => 'required|numeric',
            'country' => 'required',
            'social_security_number' => 'required|numeric',
            'type' => 'required',
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
            DB::table('users')->where('id', $user_id)->update(['image' => $filename]);
        }


        DB::table('users')->where('id', $user_id)->update(['first_name' => $request->first_name]);
        DB::table('users')->where('id', $user_id)->update(['last_name' => $request->last_name]);
        DB::table('users')->where('id', $user_id)->update(['full_name' => $request->full_name]);
        DB::table('users')->where('id', $user_id)->update(['email' => $request->email]);
        DB::table('users')->where('id', $user_id)->update(['phone' => $request->phone]);
        DB::table('users')->where('id', $user_id)->update(['gender' => $request->gender]);
        DB::table('users')->where('id', $user_id)->update(['dateOfBirth' => $request->dateOfBirth]);
        DB::table('users')->where('id', $user_id)->update(['address' => $request->address]);
        DB::table('users')->where('id', $user_id)->update(['city' => $request->city]);
        DB::table('users')->where('id', $user_id)->update(['state' => $request->state]);
        DB::table('users')->where('id', $user_id)->update(['country' => $request->country]);
        DB::table('users')->where('id', $user_id)->update(['social_security_number' => $request->social_security_number]);
        DB::table('users')->where('id', $user_id)->update(['postcode' => $request->postcode]);
        DB::table('users')->where('id', $user_id)->update(['type' => $request->type]);
        return response()->json(['status' => 'success', 'data' => 'done']);
    }

    public function getProvider(Request $request, $user_id)
    {
        $user = User::find($user_id);
        return response()->json(['status' => 'successUser', 'data' => $user]);
    }

    public function updateImage(Request $request, $user_id)
    {
        if ($request->hasFile('file')) {
            $user = User::find($user_id);
            $oldImage = "assets/images/" . $user->image;
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('assets/images/', $filename);
            DB::table('users')->where('id', $user_id)->update(['image' => $filename]);
            if ($oldImage != "assets/images/avatar.jpg")
            {
                if(File::exists($oldImage)) {
                    File::delete($oldImage);
                }
            }
        }

        return response()->json(['status' => 'success', 'data' => 'done']);
    }

    public function getProviderName(Request $request, $user_id)
    {
        $user = User::find($user_id);
        return response()->json(['status' => 'successUser', 'data' => $user->full_name]);
    }

    public function changePasswordConfirmation(Request $request, $user_id)
    {
        $user = User::find($user_id);
        if (Hash::check($request->currentPass, $user->password)) {
            $password = Hash::make($request->newPass);
            DB::table('users')->where('id', $user_id)->update(['password' => $password]);
            return response()->json(['status' => 'success', 'data' => 'done']);

        }
        else {
            return response()->json(['status' => 'error', 'data' => 'nodone']);
        }
    }
}
