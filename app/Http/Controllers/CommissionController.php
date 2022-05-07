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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CommissionController extends Controller
{
    protected $table = "commissions";

    public function getCommission(Request $request, $project_id)
    {
        $commission = DB::table('commissions')->where('id_project', $project_id);
        return response()->json(['status' => 'success', 'data' => $commission]);
    }

    public function getCommissionsByProject(Request $request, $project_id)
    {
        $commissions = DB::table('commissions')->where('id_project', $project_id)->get();
        return response()->json(['status' => 'success', 'data' => $commissions]);
    }

    public function deleteCommission(Request $request, $commission_id)
    {
        $commission = Commission::find($commission_id);
        $project = Project::find($commission->id_project);
        $billing2 = DB::table('billings')->where('id_project', $project->id)->first();
        $billing = Billing::find($billing2->id);
        if ($commission->commission_rate != null) {
            $billing->total_commissions = $billing->total_commissions - ($billing->bill_amount * ($commission->commission_rate/100));
        } else if($commission->commission_value != null){
            $billing->total_commissions = $billing->total_commissions - $commission->commission_value;

        }
        $billing->net_bill_after_comiss = $billing->bill_amount - $billing->total_commissions;
        $billing->all_total_bill = $billing->net_bill_after_comiss + $billing->total_expenses;
        $billing->save();
        DB::table('commissions')->where('id', $commission_id)->delete();
        return response()->json(['status' => 'success', 'data' => 'deleted']);
    }

    public function getCommissionRate(Request $request, $project_id)
    {
        $rate = DB::table('commissions')->where('id_project', $project_id)->sum('commission_rate');
        return response()->json(['status' => 'success', 'data' => $rate]);
    }

    public function getCommissionValue(Request $request, $project_id)
    {
        $value = DB::table('commissions')->where('id_project', $project_id)->sum('commission_value');
        return response()->json(['status' => 'success', 'data' => $value]);
    }

    public function addCommission(Request $request, $project_id)
    {
        $billing2 = DB::table('billings')->where('id_project', $project_id)->first();
        $billing = Billing::find($billing2->id);

        $project = Project::find($project_id);

        $commission = new Commission();
        if ($request->commissionType == "rate") {
            $commission->commission_rate = $request->commission;
            $billing->total_commissions = $billing->total_commissions + ($billing->bill_amount * ($request->commission/100));
        } else {
            $commission->commission_value = $request->commission;
            $billing->total_commissions = $billing->total_commissions + $request->commission;
        }
        $billing->net_bill_after_comiss = $billing->bill_amount - $billing->total_commissions;
        $billing->all_total_bill = $billing->net_bill_after_comiss + $billing->total_expenses;
        $billing->save();
        $commission->start_date = $project->start_date;
        $commission->end_date = $project->end_date;
        $commission->id_project = $project_id;
        $commission->save();

        $commissions = DB::table('commissions')->where('id_project', $project_id)->get();
        return response()->json(['status' => 'success', 'data' => $commissions]);
    }

    public function addingCom(Request $request, $project_id)
    {
        $commission = new Commission();
        if ($request->commissionType == 'rate') {
            $commission->commission_rate = $request->commissionValue;
        }
        else if ($request->commissionType == 'value') {
            $commission->commission_value = $request->commissionValue;
        }
        $project = DB::table('projects')->where('id', $project_id)->first();
        $commission->start_date = $project->start_date;
        $commission->end_date = $project->end_date;
        $commission->id_project = $project_id;
        $commission->save();
        return response()->json(['status' => 'success', 'data' => $commission]);

    }

    public function showCommission()
    {
        // return Commission::latest()->paginate(6);
        $commissions = DB::table('commissions')->join('projects', 'projects.id', 'commissions.id_project')
            ->select([
                'commissions.id', 'commissions.commission_rate', 'commissions.commission_value', 'commissions.start_date',
                'commissions.end_date', 'projects.id AS id_project', 'projects.name AS project_name'
            ])
            ->get();
        return response()->json(['status' => 'success', 'data' => $commissions]);
    }
}
