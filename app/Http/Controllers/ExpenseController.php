<?php

namespace App\Http\Controllers;

use App\Billing;
use App\Project;
use App\Notification;
use App\Commission;
use App\User;
use App\Expense;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Mail\NotifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ExpenseController extends Controller
{
    protected $table = "expenses";

    public function getExpenses(Request $request, $user_id, $project_id)
    {
        $expenses = DB::table('expenses')->where([['id_provider', $user_id], ['id_project', $project_id]])->get();
        return response()->json(['status' => 'success', 'data' => $expenses]);
    }

    public function addExpense(Request $request, $user_id, $project_id)
    {
        $user = User::find($user_id);

        $validator = Validator::make($request->all(), [
            'subject' => 'required|min:3',
            'amount' => 'required|numeric',
            'file' => 'max:500|required'

        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['status' => 'error', 'errors' => $errors]);
        }

        $expense = new Expense();
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = "assets/files/" . $user->id;
            $file->move($path, $filename);
            $expense->verification = $filename;
        }

        $expense->subject = $request->subject;
        $expense->amount = $request->amount;
        $expense->toPayBy = $request->toPayBy;
        $expense->id_provider = $user_id;
        $expense->id_project = $project_id;
        $expense->status = "waiting";
        $expense->save();
        return response()->json(['status' => 'success', 'data' => $expense]);
    }

    public function deleteExpense(Request $request, $expense_id, $user_id)
    {
        $user = User::find($user_id);
        $expense = Expense::find($expense_id);
        $path = "assets/files/" . $user->id . '/' .$expense->verification;
        if(File::exists($path)) {
            File::delete($path);
        }
        DB::table('expenses')->where('id', $expense_id)->delete();
        return response()->json(['status' => 'success', 'data' => 'deleted']);
    }
    public function changeFile(Request $request, $expense_id, $user_id)
    {
        $user = User::find($user_id);
        $expense = Expense::find($expense_id);
        $path = "assets/files/" . $user->id . '/' .$expense->verification;
        if(File::exists($path)) {
            File::delete($path);
        }
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = "assets/files/" . $user->id;
            $file->move($path, $filename);
            $expense->verification = $filename;
        }
        $expense->save();
        return response()->json(['status' => 'success', 'data' => 'deleted']);
    }

    public function acceptOrRefuseExpense(Request $request, $expense_id, $value, $project_id)
    {
        $expense = Expense::find($expense_id);
        $expense->status = $value;
        $expense->save();

        $project = Project::find($project_id);

        $billing2 = DB::table('billings')->where('id_project', $project_id)->first();
        $billing = Billing::find($billing2->id);

        $notification = new Notification();
        if($value == 'accepted') {
            $billing->total_expenses = $billing->total_expenses + $expense->amount;
            $billing->total_amount = $billing->bill_amount + $billing->total_expenses;
            $notification->type = "expense";
            $notification->content = "Votre dépense a été acceptée";
            $notification->seen = false;
            $notification->id_provider = $project->id_provider;
            $notification->id_project = $project_id;
        }
        else if($value == 'refused') {
            $billing->total_expenses = $billing->total_expenses - $expense->amount;
            $billing->total_amount = $billing->bill_amount + $billing->total_expenses;
            $notification->type = "expense";
            $notification->content = "Votre dépense a été refusée";
            $notification->seen = false;
            $notification->id_provider = $project->id_provider;
            $notification->id_project = $project_id;
        }
        $billing->all_total_bill = $billing->total_expenses + $billing->net_bill_after_comiss;
        $billing->save();
        $notification->save();
        return response()->json(['status' => 'success', 'data' => 'changed']);
    }

}
