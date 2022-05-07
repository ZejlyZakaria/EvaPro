<?php

namespace App\Http\Controllers\Api;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Admin::latest()->paginate(6);
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

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $this->validate($request, [
            'first_name' => 'required|string|max:15|min:3',
            'last_name' => 'required|string|max:15|min:3',
            'email' => 'required|string|email|max:100|unique:admins,email,' . $admin->id,
            'phone' => 'max:10|min:10|unique:admins,phone,' . $admin->id,
        ]);
        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->gender = $request->gender;
        $admin->dateOfBirth = $request->dateOfBirth;
        $admin->save();

        return ['message' => 'update the admin info'];
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Admin::findOrFail($id);

        //delete the user
        $project->delete();
        return ['message' => 'user deleted'];
    }

    public function search()
    {
        if ($search = \Request::get('q')) {
            $projects = Admin::where(function ($query) use ($search) {
                $query->where('first_name', 'LIKE', "%$search%")->orWhere('email', 'LIKE', "%$search%")
                    ->orWhere('last_name', 'LIKE', "%$search%");
            })->paginate(20);
        }

        return $projects;
    }
}
