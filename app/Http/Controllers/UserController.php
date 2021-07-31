<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Mail\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    protected $table = "users";

    public function addUser(Request $request)
    {
        $User = new User();
        $User->first_name = $request->first_name;
        $User->last_name = $request->last_name;
        $User->full_name = $request->full_name;
        $User->email = $request->email;
        $User->phone = $request->phone;
        $User->type = $request->type;
        $User->social_security_number = $request->ssn;

        // Validation
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['status'=>'error','errors'=>$errors]);
        }


        $password = $this->getRandomPassword();
        $User->password = Hash::make($password);
                $details = [
            'password' => $password . '',
            'email' => $User->email . ''
        ];
        Mail::to($User->email)->send(new SendEmail($details));
        // $User->notify(new WelcomeEmailNotification());
        $User->save();
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
        return User::latest()->paginate(3);
    }
}
