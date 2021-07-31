<?php

namespace App\Http\Controllers;

use App\Project;
use App\Notification;
use App\Commission;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Mail\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    protected $table = "projects";

    public function createProject(Request $request)
    {


        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'client' => 'required|min:3',
            'average_daily_rate' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'outstanding' => 'required',
            'commission' => 'required',

        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['status' => 'error', 'errors' => $errors]);
        }

        $date1 = Str::substr($request->start_date, 0, 10);
        $date2 = Str::substr($request->end_date, 0, 10);
        $project = new Project();
        $project->name = $request->name;
        $project->client = $request->client;
        $project->average_daily_rate = $request->average_daily_rate;
        $project->start_date = $date1;
        $project->end_date = $date2;
        $project->outstanding = $request->outstanding;
        $project->commission = $request->commission;
        $project->total_commission = $request->commission;
        $project->id_provider = $request->provider;

        $project->save();

        $commission = new Commission();
        if ($request->commissionType == "rate")
        {
            $commission->commission_rate = $request->commission;
        }
        else
        {
            $commission->commission_value = $request->commission;
        }
        $commission->start_date = $date1;
        $commission->end_date = $date2;
        $commission->id_project = $project->id;
        $commission->save();

        $notification = new Notification();
        $notification->type = "project";
        $notification->content = "Another project has assigned to you!";
        $notification->seen = false;
        $notification->id_provider = $request->provider;
        $notification->id_project = $project->id;

        $notification->save();

        return response()->json(['status' => 'success', 'data' => $project]);
    }

    public function getProjects(Request $request, $user_id)
    {
        $projects = DB::table('projects')->where('id_provider', $user_id)->get();
        return response()->json(['status' => 'success', 'data' => $projects]);
    }
}
