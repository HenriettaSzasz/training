<?php

namespace App\Http\Controllers;

use App\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('isAdmin', '0')->get();

        return response()
            ->view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()
            ->view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $rules = array(
            'name'        => 'required',
            'email'       => 'required|email|unique:users',
            'password'    => 'required|string',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
            // store
            $user = new User;
            $user->name          = $request->input('name');
            $user->email         = $request->input('email');
            $user->password      = Hash::make($request->input('password'));
            if($request->input('verified') == 1){
                $user->markEmailAsVerified();
            }
            else{
                //$user->sendEmailVerificationNotification();
            }
            $user->save();

            return redirect()->route('users.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return response()
            ->view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return response()
            ->view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'name'        => 'required',
            'email'       => 'required|email',
            'password'    => 'required|string',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
            // store
            $user = User::find($id);
            $user->name          = $request->input('name');
            $user->email         = $request->input('email');
            $user->password      = Hash::make($request->input('password'));
            $user->save();

            return response()->view('users.show', ['user' => $user]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(user $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}
