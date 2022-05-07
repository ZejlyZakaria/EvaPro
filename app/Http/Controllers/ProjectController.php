<?php

namespace App\Http\Controllers;

use App\Project;
use App\Notification;
use App\Commission;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Mail\NotifyEmail;
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
        $project->id_provider = $request->provider;

        $project->save();

        $notification = new Notification();
        $notification->type = "project";
        $notification->content = "vous avez un nouveau projet";
        $notification->seen = false;
        $notification->id_provider = $request->provider;

        $notification->save();

        $user = User::find($request->provider);
        $user->project_count = $user->project_count + 1;
        $user->save();

        $details = [
            'title' => "Un nouveau projet vous est assigné.",
            'content' => "Veuillez vérifier votre compte, vous avez un nouveau projet!"
        ];
        Mail::to($user->email)->send(new NotifyEmail($details));

        return response()->json(['status' => 'success', 'data' => $project]);
    }

    public function getProjects(Request $request, $user_id)
    {
        $projects = DB::table('projects')->where('id_provider', $user_id)->get();
        return response()->json(['status' => 'success', 'data' => $projects]);
    }

    public function getProject(Request $request, $project_id)
    {
        $project = DB::table('projects')->where('id', $project_id)->first();
        return response()->json(['status' => 'successProject', 'data' => $project]);
    }

    public function getProjectName(Request $request, $project_id)
    {
        $project = DB::table('projects')->where('id', $project_id)->first();
        return response()->json(['status' => 'success', 'data' => $project->name]);
    }

    public function getClientName(Request $request, $project_id)
    {
        $project = DB::table('projects')->where('id', $project_id)->first();
        return response()->json(['status' => 'success', 'data' => $project->client]);
    }

    public function getProjectsCountDash()
    {
        $projects = DB::table('projects')->get();
        return response()->json(['status' => 'success', 'data' => $projects]);
    }

    public function getProjectsCountPro(Request $request, $id_provider)
    {
        $projects = DB::table('projects')->where("id_provider", $id_provider)->count();
        return response()->json(['status' => 'success', 'data' => $projects]);
    }

    public function showProjects()
    {
        return Project::latest()->paginate(10);
    }
}
