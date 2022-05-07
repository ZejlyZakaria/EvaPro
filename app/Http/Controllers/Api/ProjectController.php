<?php

namespace App\Http\Controllers\Api;

Use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Project::latest()->paginate(6);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $project_id)
    {
        $project = Project::findOrFail($project_id);

        $this->validate($request, [
            'name' => 'required|string|min:3',
            'client' => 'required|string|max:50|min:3',
            'average_daily_rate' => 'required|integer',
            'start_date' => 'required',
            'end_date' => '',
            'outstanding' => 'required',
        ]);
            $project->name = $request->name;
            $project->client = $request->client;
            $project->average_daily_rate = $request->average_daily_rate;
            $project->end_date = $request->end_date;
            $project->start_date = $request->start_date;
            $project->outstanding = $request->outstanding;
            $project->save();


        return ['message' => 'update the project info'];
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        //delete the user
        $project->delete();
        return ['message' => 'user deleted'];
    }

    public function search()
    {
        if ($search = \Request::get('q')) {
            $projects = Project::where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%");
            })->paginate(20);
        }

        return $projects;
    }
}
