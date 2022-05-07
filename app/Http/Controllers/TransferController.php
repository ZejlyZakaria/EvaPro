<?php

namespace App\Http\Controllers;

use App\Billing;
use App\Project;
use App\Notification;
use App\Commission;
use App\User;
use App\Payment;
use App\Transfer;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Mail\NotifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransferController extends Controller
{
    protected $table = "transfers";

    public function addTransfer(Request $request, $payment_id)
    {
        $validator = Validator::make($request->all(), [
            'value' => 'required|numeric',
            'name' => 'required',
            'year' => 'required',
            'month' => 'required',

        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['status' => 'error', 'errors' => $errors]);
        }

        $transfer = new Transfer();
        // $name = "Transfer";
        // $count = DB::table('transfers')->where('id_payment', $payment_id)->count();
        // if($count != 0) {
        //     $transfer->name = $name . ' ' . ($count + 1);
        // }
        // else {
        //     $transfer->name = $name . ' 1';
        // }
        $transfer->name = $request->name;
        $transfer->value = $request->value;
        $transfer->month = $request->month;
        $transfer->year = $request->year;
        $transfer->id_payment = $payment_id;

        $transfer->save();

        $payment = Payment::find($payment_id);
        $payment->total_payment = $payment->total_payment + $request->value;
        $payment->save();

        $billing = Billing::find($payment->id_billing);
        $billing->all_total_paid = $payment->total_payment;
        if ($billing->all_total_paid != 0) {
           if($billing->all_total_paid == $billing->all_total_bill) {
            $billing->status = "paid";
           }
           else{
            $billing->status = "not completed";
           }
        }
        else {
            $billing->status = "unpaid";
        }
        $billing->balance = $billing->all_total_paid - $billing->all_total_bill;
        $billing->save();

        $transfers = DB::table('transfers')->where('id_payment', $payment_id)->get();
        return response()->json(['status' => 'success', 'data' => $transfers]);
    }

    public function removeTransfer(Request $request, $transfer_id)
    {
        $transfer = Transfer::find($transfer_id);
        $payment = Payment::find($transfer->id_payment);
        $billing = Billing::find($payment->id_billing);

        $payment->total_payment = $payment->total_payment - $transfer->value;
        $payment->save();

        $billing->all_total_paid = $payment->total_payment;
        if ($billing->all_total_paid != 0) {
            if($billing->all_total_paid == $billing->all_total_bill) {
             $billing->status = "paid";
            }
            else{
             $billing->status = "not completed";
            }
         }
         else {
             $billing->status = "unpaid";
         }
         $billing->save();

        DB::table('transfers')->where('id', $transfer_id)->delete();
        $transfers = DB::table('transfers')->where('id_payment', $payment->id)->get();
        return response()->json(['status' => 'success', 'data' => $transfers]);

    }

    public function getTransfers(Request $request, $payment_id)
    {
        $transfers = DB::table('transfers')->where('id_payment', $payment_id)->get();
        return response()->json(['status' => 'success', 'data' => $transfers]);
    }

    public function getTransfersCount(Request $request, $payment_id)
    {
        $count = DB::table('transfers')->where('id_payment', $payment_id)->count();
        return response()->json(['status' => 'success', 'data' => $count]);
    }

    public function updateTransfer(Request $request, $transfer_id, $payment_id)
    {
        $validator = Validator::make($request->all(), [
            'value' => 'required|numeric',
            'name' => 'required',
            'year' => 'required',
            'month' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['status' => 'error', 'errors' => $errors]);
        }

        $transfer = Transfer::find($transfer_id);
        $payment = Payment::find($payment_id);
        $billing = Billing::find($payment->id_billing);

        $payment->total_payment = $payment->total_payment - $transfer->value;
        $payment->total_payment = $payment->total_payment + $request->value;

        $transfer->name = $request->name;
        $transfer->value = $request->value;
        $transfer->month = $request->month;
        $transfer->year = $request->year;

        $transfer->save();
        $payment->save();

        $billing->all_total_paid = $payment->total_payment;
        if ($billing->all_total_paid != 0) {
           if($billing->all_total_paid == $billing->all_total_bill) {
            $billing->status = "paid";
           }
           else{
            $billing->status = "not completed";
           }
        }
        else {
            $billing->status = "unpaid";
        }
        $billing->save();

        $transfers = DB::table('transfers')->where('id_payment', $payment_id)->get();
        return response()->json(['status' => 'success', 'data' => $transfers]);
    }


}
