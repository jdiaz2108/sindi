<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\documentType;
use App\Models\Profession;
use App\Models\CivilStatus;
use App\Models\AcademicLevel;
use App\Models\Departament;
use App\Models\Municipalitie;
use App\Models\Afp;
use App\Models\Ccf;
use App\Models\Arl;
use App\Models\Eps;
use App\Models\Position;


class VueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function tiposDocumento(Request $request)
    {
        if($request->ajax()){
            $documentTypes = documentType::all();
            return response()->json( $documentTypes , 200);
        } else { return redirect('/'); }
    }

    public function getCorreo(Request $request, $id)
    {

        if($request->ajax()){
            $user = User::select('name', 'email')->whereDocument($id)->first();
            if ($user) { 
                $data = $user;
                return response()->json([ 'name' => $data->name, 'email' => $data->email ], 200);
            } else { 
                return response()->json([ 'error' => 'Usuario no Encontrado' ], 404);
             }
        } else { return redirect('/'); }
    }

    public function tiposProfession(Request $request)
    {
        if($request->ajax()){
            $professions = Profession::all();
            return response()->json( $professions , 200);
        } else { return redirect('/'); }
    }

    public function getProfession(Request $request, $id)
    {
        if($request->ajax()){
            $profession = Profession::select('name')->findOrFail($id);
            if ($profession) { $data = $profession;
            } else { $data = null; }
            return response()->json($data->name);
        } else { return redirect('/'); }
    }

    public function tiposCivilStatus(Request $request)
    {
        if($request->ajax()){
            $civilStatus = CivilStatus::all();
            return response()->json( $civilStatus , 200);
        } else { return redirect('/'); }
    }

    public function allAcademicLevel(Request $request)
    {
        if($request->ajax()){
            $academicLevel = AcademicLevel::all();
            return response()->json( $academicLevel , 200);
        } else { return redirect('/'); }
    }

    public function allDepartaments(Request $request)
    {
        if($request->ajax()){
            $departament = Departament::all();
            return response()->json( $departament , 200);
        } else { return redirect('/'); }
    }

    public function getCity(Request $request, $id)
    {
        if($request->ajax()){
            $city = Municipalitie::whereDepartament_id($id)->get();
            return response()->json( $city , 200);
        } else { return redirect('/'); }
    }

    public function AllAfp(Request $request)
    {
        if($request->ajax()){
            $afp = Afp::all();
            return response()->json( $afp , 200);
        } else { return redirect('/'); }
    }

    public function AllCcf(Request $request)
    {
        if($request->ajax()){
            $ccf = Ccf::all();
            return response()->json( $ccf , 200);
        } else { return redirect('/'); }
    }

    public function AllArl(Request $request)
    {
        if($request->ajax()){
            $arl = Arl::all();
            return response()->json( $arl , 200);
        } else { return redirect('/'); }
    }

    public function AllEps(Request $request)
    {
        if($request->ajax()){
            $eps = Eps::all();
            return response()->json( $eps , 200);
        } else { return redirect('/'); }
    }

    public function allPositions(Request $request)
    {
        if($request->ajax()){
            $positions = Position::all();
            return response()->json( $positions , 200);
        } else { return redirect('/'); }
    }

    public function getPosition(Request $request, $id)
    {
        if($request->ajax()){
            $position = Position::findOrFail($id);
            if ($position) { $data = $position;
            } else { $data = null; }
            return response()->json($data);
        } else { return redirect('/'); }
    }

    public function getDepend(Request $request, $id)
    {
        if($request->ajax()){
            $depend = Position::findOrFail($id);
            if ($depend) { $data = $depend;
            } else { $data = null; }
            return response()->json($depend->depend->employee->user->name .' '.  $depend->depend->employee->user->last_name);
        } else { return redirect('/'); }

    }

    public function getEmergencyContacts(Request $request, $id)
    {
        if($request->ajax()){
            $eContacts =  User::find($id)->eContacts;
            if ($eContacts) { $data = $eContacts;
            } else { $data = null; }
            return response()->json($data);
        } else { return redirect('/'); }
    }

    public function getChildrens(Request $request, $id)
    {
        if($request->ajax()){
            $Childrens =  User::find($id)->Childrens;
            if ($Childrens) { $data = $Childrens;
            } else { $data = null; }
            return response()->json($data);
        } else { return redirect('/'); }
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
        //
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
