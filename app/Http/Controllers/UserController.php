<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use App\User;
use App\Employee;
use Illuminate\Support\Facades\Hash;
use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::with('user', 'position', 'city')->get();
        return view('admin.user.listar', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'document' => 'required|unique:users|max:255',
            'name' => 'required',
            'email' => 'required|unique:users',
            'last_name' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'document' => $request->document,
            'password' => Hash::make($request->document),
            'slug' => str_random(16),
            'document_type_id' => 100,
            'level' => 118,
            'user_type' => 2, 
            'status' => 1,

            // Borrar
            'profile_id' => 3,
        ]);

        $Employee = Employee::create([
            'id' => $user->id,
            'user_id' => $user->id,

        ]);

        return $user->slug;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user = User::whereSlug($id)->firstOrFail();
        return view('user', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        User::findOrFail($id)->update($request->all());
        if($request->ajax()){
        return response('ok', Response::HTTP_OK);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::whereSlug($id)->firstOrFail();

        if ($test = Hash::check($request->passwordOld, $user->password)) {
            $user->update(['password' => Hash::make($request->password), 'status' => 6 ]);
            return redirect()->back()->with('message', 'Tu contraseña se ha cambiado');
        } else {
            return redirect()->back()->with('message', 'Tu contraseña anterior no conincide');
        }
        return dd($test);
    }

    public function updateStatus(Request $request)
    {
        $user = User::whereSlug(Auth::user()->slug)->firstOrFail();
        if ($user->status == 1) {
            $user->update(['status' => 6]);
        }
        return redirect('/');
        // if($request->ajax()){
        //     $user->update('status' => 6);
        //     return redirect('/')->with('message', 'Tu contraseña se ha cambiado');
        // } else {
        //     return redirect()->back();
        // }
    }
}
