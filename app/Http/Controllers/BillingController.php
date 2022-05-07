<?php

namespace App\Http\Controllers;

use App\Project;
use App\Notification;
use App\Commission;
use App\User;
use App\Billing;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Mail\NotifyEmail;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BillingController extends Controller
{
    protected $table = "billings";


    public function getBillings()
    {
        $billings = DB::table('billings')->join('projects', 'projects.id', 'billings.id_project')
        ->join('users', 'users.id', 'projects.id_provider')
        ->select(['billings.id', 'projects.name', 'projects.id AS id_project', 'users.id AS provider_id', 'billings.billing_month', 'billings.billing_year', 'billings.all_total_bill',
        'billings.all_total_paid', 'billings.all_total_paid_per_client', 'billings.total_commissions', 'billings.created_at', 'projects.client', 'users.full_name', 'billings.status'])
        ->get();
        return response()->json(['status' => 'success', 'data' => $billings]);
    }

    public function getBillingsByUser(Request $request, $user_id)
    {
        $billings = DB::table('billings')->join('projects', 'projects.id', 'billings.id_project')
        ->join('users', 'users.id', 'projects.id_provider')
        ->select(['billings.id', 'projects.name', 'projects.id AS id_project', 'users.id AS provider_id', 'billings.billing_month', 'billings.billing_year', 'billings.all_total_bill',
        'billings.all_total_paid', 'billings.created_at', 'projects.client', 'users.full_name', 'billings.status'])
        ->where('projects.id_provider', $user_id)
        ->get();
        return response()->json(['status' => 'success', 'data' => $billings]);
    }

    public function getBilling(Request $request, $billing_id)
    {
        $billing = Billing::find($billing_id);
        $billing->all_total_bill = $billing->total_expenses + $billing->net_bill_after_comiss;
        $billing->save();
        $balance = $billing->all_total_paid - $billing->all_total_bill;
        $billing->balance = $balance;
        $billing->save();
        return response()->json(['status' => 'success', 'data' => $billing]);
    }

    public function getBillingsByStatus(Request $request, $status)
    {
        $billings = DB::table('billings')->join('projects', 'projects.id', 'billings.id_project')
        ->join('users', 'users.id', 'projects.id_provider')
        ->select(['billings.id', 'projects.name', 'projects.id AS id_project', 'users.id AS provider_id', 'billings.billing_month', 'billings.billing_year', 'billings.all_total_bill',
        'billings.all_total_paid', 'billings.created_at', 'projects.client', 'users.full_name', 'billings.status'])
        ->where('billings.status', $status)
        ->get();
        return response()->json(['status' => 'success', 'data' => $billings]);
    }

    public function getBillingsOrderBy()
    {
        $billings = DB::table('billings')->join('projects', 'projects.id', 'billings.id_project')
        ->join('users', 'users.id', 'projects.id_provider')
        ->select(['billings.id', 'projects.name', 'projects.id AS id_project', 'users.id AS provider_id', 'billings.billing_month', 'billings.billing_year', 'billings.all_total_bill',
        'billings.all_total_paid', 'billings.created_at', 'projects.client', 'users.full_name', 'billings.status'])
        ->orderByRaw('billings.all_total_bill')
        ->get();
        return response()->json(['status' => 'success', 'data' => $billings]);
    }

    public function getTotalSales()
    {
        $total = DB::table('billings')->sum('bill_amount');
        return response()->json(['status' => 'success', 'data' => $total]);
    }

    public function createBilling(Request $request, $project_id, $provider_id)
    {
        $total = DB::table('billings')->where('id_project', $project_id)
        ->where('billing_month', $request->billing_month)->where('billing_year', $request->billing_year)
        ->count();
        if($total > 0) {
            return response()->json(['status' => 'error', 'data' => $total]);
        }
        else {
            $billing = new Billing();
            $billing->bill_amount = $request->bill_amount;
            $billing->billing_month = $request->billing_month;
            $billing->billing_year = $request->billing_year;
            $billing->penalties = "";
            $billing->net_bill_after_comiss = $request->net_bill_after_comiss;
            $billing->total_amount = $request->bill_amount;
            $billing->all_total_bill = $request->bill_amount;
            $billing->all_total_paid = 0;
            $billing->total_expenses = 0;
            $billing->total_commissions = $request->total_commissions;
            $billing->balance = 0;
            $billing->all_total_paid_per_client = 0;
            $billing->nbrOfDaysWorked = $request->nbrOfDays;
            $billing->status = "unpaid";
            $billing->id_project = $project_id;

            $billing->save();

            $payment = new Payment();
            $payment->global_cost_value = 0;
            $payment->id_provider = $provider_id;
            $payment->id_billing = $billing->id;
            $payment->save();

            $usr = DB::table('users')->where('id', $provider_id)->first();
            $prj = DB::table('projects')->where('id', $project_id)->first();

            $admn = DB::table('admins')->first();

            $notification = new Notification();
            $notification->type = "reportwork";
            $notification->content = $usr->full_name . " a rendu le projet " . $prj->name;
            $notification->seen = false;
            $notification->id_admin = $admn->id;
            $notification->save();

            return response()->json(['status' => 'success', 'data' => $billing]);
        }

    }

    public function updateClientAmount(Request $request, $billing_id)
    {
        DB::table('billings')->where('id', $billing_id)->update(['all_total_paid_per_client' => $request->value]);
        return response()->json(['status' => 'success', 'data' => 'done']);

    }

    public function getBillingsWhere(Request $request, $year, $month)
    {
        $billings = DB::table('billings')->join('projects', 'projects.id', 'billings.id_project')
        ->join('users', 'users.id', 'projects.id_provider')
        ->select(['billings.id', 'projects.name', 'projects.id AS id_project', 'users.id AS provider_id', 'billings.billing_month', 'billings.billing_year', 'billings.all_total_bill',
        'billings.all_total_paid', 'billings.all_total_paid_per_client', 'billings.total_commissions', 'billings.created_at', 'projects.client', 'users.full_name', 'billings.status'])
        ->where('billing_year', $year)->where('billing_month', $month)->get();
        return response()->json(['status' => 'success', 'data' => $billings]);
    }

    public function getBillingsDash()
    {
        $billings = DB::table('billings')->get();
        return response()->json(['status' => 'success', 'data' => $billings]);
    }

    public function getBillingsDashProvider()
    {
        $billings = DB::table('billings')->get();
        return response()->json(['status' => 'success', 'data' => $billings]);
    }

    public function getProjectsCountProDone(Request $request, $id_provider)
    {
        $billings = DB::table('billings')->join('projects', 'projects.id', 'billings.id_project')
        ->join('users', 'users.id', 'projects.id_provider')
        ->where('projects.id_provider', $id_provider)
        ->count();
        return response()->json(['status' => 'success', 'data' => $billings]);
    }

}



// $commissions = DB::table('commissions')->join('projects', 'projects.id', 'commissions.id_project')
//     ->select(['billings.id', 'commissions.commission_rate', 'commissions.commissions_value', 'commissions.start_date',
//     'commissions.end_date', 'projects.id AS id_project', 'projects.name AS project_name'])
//     ->get();
// return response()->json(['status' => 'success', 'data' => $commissions]);
