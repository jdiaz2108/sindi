@extends('layouts.base')

@section('title', 'Estado Paz y Salvo')

@section('content')
{{-- <list-pys></list-pys> --}}
@php $aux = 0 @endphp
{{-- {{$user->employee->position->depend->employee}} --}}

    <div class="row">
        <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Paz y Salvo</strong>
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
                                      <th scope="col"><h5 class="display-5">ESTADO</h5></th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach($registerpys as $pys)

                                    @php
                                    $rowspan = $registerpys->where('concept.area_id', $pys->concept->area->id)->count('area.id');
                                    @endphp

                                <tr>
                                    @if($aux != $rowspan)
                                        <td rowspan="{{$rowspan}}" class="blue-gradient text-center text-white align-middle border-dark border" scope="row">
                                            {{$pys->concept->area->name}}
                                            <br>
                                            @if($pys->concept->area->id == 1)
                                            Responsable: 
                                            <br>
                                            {{$user->employee->position->depend->employee->user->name}} {{$user->employee->position->depend->employee->user->last_name}}
                                            <br>
                                            Correo: 
                                            <br>
                                            {{$user->employee->position->depend->employee->email_corporate}}
                                            @else Responsable:
                                            <br>
                                            Diana
                                            <br>
                                            Correo: diana@correo.com 
                                            @endif

                                                
                                                 </td>
                                        @php $aux = $rowspan @endphp
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
                                    <td class="text-center">{{ $pys->discount ?? '' }}</td>
                                    <td class="text-center">{{ $pys->sign ?? '' }}</td>
                                    <td class="text-center">{{ $pys->observations ?? '' }}</td> 
                                    <td class="text-center align-middle" scope="row">
                                        @if($pys->sign)
                                        <a class="btn btn-success disabled" href="#" role="button" disabled>Revisado</a>
                                        @else
                                        <a class="btn btn-secondary disabled" href="#" role="button" disabled>Sin Revisar</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
    </div>
@endsection