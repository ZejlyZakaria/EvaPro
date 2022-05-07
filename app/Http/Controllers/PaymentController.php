<?php

namespace App\Http\Controllers;

use App\Project;
use App\Notification;
use App\Commission;
use App\User;
use App\Payment;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Mail\NotifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    protected $table = "payments";

    public function getPayment(Request $request, $billing_id)
    {
        $payment = DB::table('payments')->where('id_billing', $billing_id)->first();
        return response()->json(['status' => 'succesSDSDs', 'data' => $payment]);
    }


}
