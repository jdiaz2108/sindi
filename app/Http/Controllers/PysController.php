<?php

namespace App\Http\Controllers;

use App\User;
use App\Employee;
use App\Models\Registerpys;
use Illuminate\Http\Request;
use Auth;

class PysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = User::whereStatus(5)->with('employee', 'employee.position')->get();
        $user = User::whereStatus(5)->with('employee', 'employee.position', 'registerpys', 'registerpys.concept', 'registerpys.concept.area')->get();
        // return $user2 = Employee::find(2)->user->get();
        $supervisor = Auth::user()->employee;
        $registerpys = Registerpys::whereUser_id(1)->with('concept', 'concept.area')->get();
        return view('pys.list', compact('user', 'registerpys', 'supervisor'));
    }

    public function list()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $registerpys = Registerpys::whereUser_id($user->id)->with('concept', 'concept.area')->get();
        return view('pys.table', compact('user', 'registerpys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
        $registerpys = Registerpys::whereUser_id($user->id)->with('concept', 'concept.area')->get();
        return view('pys.table', compact('user', 'registerpys'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $registerpys = Registerpys::whereSlug($id)->firstOrFail();
        return $registerpys;

        $user = User::whereSlug($id)->firstOrFail();
        $registerpys = Registerpys::whereUser_id($user->id)->with('concept', 'concept.area')->get();
        return view('pys.table', compact('user', 'registerpys'));
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
        //
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
}
