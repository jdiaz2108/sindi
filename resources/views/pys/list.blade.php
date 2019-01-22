@extends('layouts.base')

@section('content')
{{-- <list-pys></list-pys> --}}
@php $aux = 0 @endphp
    <div class="row">
        <div class="col-lg-12">
            @foreach($user as $u)
                               {{--  {{$u->employee->position->depend_id}} {{$supervisor->position_id}} --}}
                @if($u->employee->position->depend_id == $supervisor->position_id || $supervisor->position->area_id == 2 || $supervisor->position->area_id == 3)
                    <div class="card mb-5">
                        <div class="card-header">
                            <strong class="card-title">
                                <div class="text-light blooker20-gradient rounded mx-auto shadow" style="margin-top: -25px; max-width: calc(100% - 20px);">
                                    <h2 class="p-3">Proceso de Paz  y Salvo: {{$u->name}} {{$u->last_name}} <a class="btn btn-dark float-right my-auto" href="#" role="button">Ver Perfil</a></h2>
                                </div>
                            </strong>
                        </div>
                        <div class="card-body">

{{-- {{$supervisor->position->area_id}} --}}

                            <table class="table shadow rounded">
                                <thead class="thead-dark text-center">
                                    <tr>
                                      <th scope="col"><h5 class="display-5">AREA</h5></th>
                                      <th scope="col" class="bg-dark"><h5 class="display-5">CONCEPTOS A VERIFICAR</h5></th>
                                      <th scope="col"><h5 class="display-5">PAZ Y SALVO</h5></th>
                                      <th scope="col"><h5 class="display-5">VALOR A DESCONTAR</h5></th>
                                      <th scope="col"><h5 class="display-5">FIRMA RESPONSABLE DE VERIFICACION</h5></th>
                                      <th scope="col"><h5 class="display-5">OBSERVACIONES</h5></th>
                                      <th scope="col"><h5 class="display-5">ACCIONES</h5></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($u->registerpys as $pys)
                                        @if($pys->concept->area->id == 1 && $u->employee->position->depend_id == $supervisor->position_id)
                                        {{$key}}
                                            <tr>
                                                <td class="text-center">{{ $pys->concept->area->name ?? '' }} </td>
                                                <td class="text-center">{{ $pys->concept->concept}}</td>
                                                <td class="text-center">@if($pys->concept->status == 'si')
                                                        <span class="badge badge-success">SI</span>
                                                    @elseif($pys->concept->status == 'no')
                                                        <span class="badge badge-danger">NO</span>
                                                    @else
                                                        <span class="badge badge-secondary">N/A</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ $pys->discount}}</td>
                                                <td class="text-center">$ 10.000</td>
                                                <td class="text-center">$ 10.000</td>
                                                <td class="text-center"><a class="btn btn-primary border" href="/pys/{{$pys->slug}}/edit" role="button">Verificar <i class="fa fa-check-square" aria-hidden="true"></i></a></td>
                                            </tr>
                                        @endif
                                        @if($pys->concept->area->id == $supervisor->position->area_id)
                                            <tr>
                                                <td class="text-center">{{ $pys->concept->area->name ?? '' }}</td>
                                                <td class="text-center">{{ $pys->concept->concept}}</td>
                                                <td class="text-center">@if($pys->status == 'si')
                                                        <span class="badge badge-success">SI</span>
                                                    @elseif($pys->status == 'no')
                                                        <span class="badge badge-danger">NO</span>
                                                    @else
                                                        <span class="badge badge-secondary">N/A</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ $pys->discount}}</td>
                                                <td class="text-center">$ 10.000</td>
                                                <td class="text-center">$ 10.000</td>
                                                <td class="text-center"><a class="btn btn-primary border" href="/pys/{{$pys->slug}}/edit" role="button">Verificar <i class="fa fa-check-square" aria-hidden="true"></i></a></td>
                                            </tr>
                                        @endif
                                     @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>




    <div class="row">
        <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Pas y Salvo</strong>
                        </div>
                        <div class="card-body">
                            <table class="table shadow rounded">
                                <thead class="thead-dark text-center">
                                    <tr>
                                      <th scope="col"><h5 class="display-5">AREA</h5></th>
                                      <th scope="col" class="bg-dark"><h5 class="display-5">CONCEPTOS A VERIFICAR</h5></th>
                                      <th scope="col"><h5 class="display-5">PAZ Y SALVO</h5></th>
                                      <th scope="col"><h5 class="display-5">VALOR A DESCONTAR</h5></th>
                                      <th scope="col"><h5 class="display-5">FIRMA RESPONSABLE DE VERIFICACION</h5></th>
                                      <th scope="col"><h5 class="display-5">OBSERVACIONES</h5></th>
                                      <th scope="col"><h5 class="display-5">ACCIONES</h5></th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach($registerpys as $pys)

                                    @php
                                    $rowspan = $registerpys->where('concept.area_id', $pys->concept->area->id)->count('area.id')
                                    @endphp

                                <tr>
                                    @if($aux != $rowspan)
                                        <td rowspan="{{$rowspan}}" class="text-center align-middle" scope="row">{{$pys->concept->area->name}}</td>
                            
                                    @endif 
                                    
                                    <td>{{$pys->concept->concept}}</td>
                                    <td class="text-center">@if($pys->status == 'si')
                                            <span class="badge badge-success">SI</span>
                                        @elseif($pys->status == 'no')
                                            <span class="badge badge-danger">NO</span>
                                        @else
                                            <span class="badge badge-secondary">N/A</span>
                                        @endif
                                    </td>
                                    <td class="text-center">$ 10.000</td>
                                    <td class="text-center">John Diaz</td>
                                    <td class="text-center">$ 10.000</td>
                                        @if($aux != $rowspan)
                                        <td rowspan="{{$rowspan}}" class="text-center align-middle" scope="row"><a class="btn btn-primary" href="#" role="button">Link</a></td>
                                        @php $aux = $rowspan @endphp
                                    @endif 
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
    </div>
@endsection