<?php

namespace App\Http\Controllers;

use App\User;
use App\Employee;
use App\Models\Registerpys;
use App\Models\Conceptpys;
use Illuminate\Http\Request;
use Auth;

class PysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function estado()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        if ($user->status == 5) {
            $registerpys = Registerpys::whereUser_id($user->id)->with('concept', 'concept.area')->get();
            return view('pys.table', compact('user', 'registerpys'));
        } elseif($user->status == 6) {
            return view('pys.desvinculacion') ;
        }
    }

    public function index()
    {

        // $registerpys = Registerpys::whereUser_id(1)->with('concept', 'concept.area')->get();


        $users = User::whereStatus(5)->with('employee.position.depend.employee.user', 'registerpys.concept.area')->get();


            return view('pys.level.talento', compact('users'));

        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = User::whereSlug($id)->firstOrFail();

        // $user = User::find(161);

            if ($user->registerpys->count() == 0){

                $Conceptpys = Conceptpys::all();
                    foreach ($Conceptpys as $key => $value) {
                        $var = Registerpys::create([
                            'user_id' => $user->id,
                            'conceptpys_id' => $value->id,
                            'status' => NULL,
                            'discount' => NULL,
                            'sign' => NULL,
                            'signer' => NULL,
                            'observations' => NULL,
                            'slug' => str_random(10),
                        ]);
                    }

                $user->update(['status' => 5 ]);

                return redirect('/pys')->with('message', 'Ha empezado el proceso de Paz y Salvo');

            }
                return redirect('/pys')->with('message', 'Error sistema');

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
        $responsable = Auth::user();
        $registerpys = Registerpys::whereSlug($id)->with('concept', 'concept.area', 'user')->firstOrFail();
        return view('pys.verificar', compact('registerpys', 'responsable'));
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
        Registerpys::find($id)->update($request->all());
        $registerpys = Registerpys::findorFail($id);
        $signer =  Auth::user();
        $registerpys->signer = $signer->id;
        $registerpys->sign = $signer->name.' '.$signer->last_name;
        $registerpys->save();
        return redirect('pys');
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
