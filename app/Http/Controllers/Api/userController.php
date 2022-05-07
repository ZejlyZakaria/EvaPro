<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::latest()->paginate(6);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:15|min:3',
            'last_name' => 'required|string|max:15|min:3',
            'email' => 'required|string|email|max:100|unique:users',
            'phone' => 'max:10|min:10|unique:users',
        ]);
        return User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'type' => $request['type'],
            'social_security_number' => $request['social_security_number'],
        ]);
    }

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
        $user = User::findOrFail($id);

        $this->validate($request, [
            'first_name' => 'required|string|max:15|min:3',
            'last_name' => 'required|string|max:15|min:3',
            'email' => 'required|string|email|max:100|unique:users,email,' . $user->id,
            'phone' => 'max:10|min:10|unique:users,phone,' . $user->id,
        ]);

        $user->update($request->all());
        return ['message' => 'update the user info'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        //delete the user
        $user->delete();
        return ['message' => 'user deleted'];
    }

    public function search()
    {
        if ($search = \Request::get('q')) {
            $users = User::where(function ($query) use ($search) {
                $query->where('first_name', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%")
                    ->orWhere('last_name', 'LIKE', "%$search%");
            })->paginate(20);
        }

        return $users;
    }
}
