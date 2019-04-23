<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MapGeo;
use Auth;

class MapGeoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Auth::user();
        return view('mapgeo.mapgeo');
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

        $user = Auth::user();

        $date = getdate();

        $Geo = MapGeo::create([
            'user_id' => $user->id,
            'place_id' => 1,
            'latitude' => $request->lat,
            'longitude' => $request->lng,
            'status' => $request->status,
            'day' => $date['mday'],
            'month' => $date['mon'],
            'year' => $date['year']
        ]);
        return $Geo;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {





if($request->ajax()){
        $hoy = getdate();
        $hoy['mday'];
        $user = Auth::user();
        $mapgeo = MapGeo::whereUser_id($user->id)->get()->last();
        if ($mapgeo) {
           if ($mapgeo->year == $hoy['year'] AND $mapgeo->month == $hoy['mon'] AND $mapgeo->day == $hoy['mday'] AND $mapgeo->status == 1) {
               return response()->json( $mapgeo , 200);
            } elseif ($mapgeo->year == $hoy['year'] AND $mapgeo->month == $hoy['mon'] AND $mapgeo->day == $hoy['mday'] AND $mapgeo->status == 2) {
               return response()->json( 'cierre' , 200);
            } else {
               return response()->json( 'null' , 200);
            }
        }

        return response()->json( 'null' , 200);

} else { return redirect('/'); }




        
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

    public function getReport()
    {
        $allGeo = MapGeo::with('user')->get();
        // return Auth::user();
        return view('mapgeo.show', compact('allGeo'));
    }
}
