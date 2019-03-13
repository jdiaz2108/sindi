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
        return $request;
        $user = Auth::user();

        $date = getdate();

        $Geo = MapGeo::create([
            'user_id' => $user->id,
            'place_id' => 1,
            'latitude' => $request->lat,
            'longitude' => $request->lng,
            'status' => 1,
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
    public function show($id)
    {
        $hoy = getdate();
        $hoy['mday'];
        $user = Auth::user();
        $mapgeo = MapGeo::whereUser_id($user->id)->get()->last();
        if ($mapgeo) {
           if ($mapgeo->year == $hoy['year'] AND $mapgeo->month == $hoy['mon'] AND $mapgeo->day == $hoy['mday'] ) {
               return $mapgeo;
            } else {
                return 'null';
            }
        }

        return 'nada';
        
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
