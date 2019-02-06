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

                            <table class="table shadow rounded table-sm">
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
                                    echo $rowspan;
                                    @endphp

                                <tr class="border border-danger">
                                    @if($aux != $rowspan)
                                        <td rowspan="{{$rowspan}}" class="text-center align-middle border-dark border" scope="row">{{$pys->concept->area->name}}</td>
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

                            holaa
                        </table>


@foreach($registerpys2 as $key => $pys)
<table class="table my-5 shadow rounded table-sm">
      <thead class="thead-dark my-5">
        <tr>
{{-- {{$pys->first()}} --}}
            <th colspan="6" scope="col" class="border-0">
<h3 class="card-header text-white text-center shadow py-2 blue-gradient rounded mx-auto w-100" style="margin-top: -25px; max-width: calc(100% - 40px);">
            Area: {{$pys->first()->concept->area->name}}
             - @if($pys->first()->concept->area->id == 1) Responsable Firma: {{$user->employee->position->depend->employee->user->name}} {{$user->employee->position->depend->employee->user->last_name}} - Correo: {{$user->employee->position->depend->employee->email_corporate}} @else Responsable Firma: Diana - Correo: diana@correo.com @endif
        </h3>
                
            </th>
        </tr>
      </thead>
  <tbody class="border border-dark">

@foreach($pys as $py)
                                    @php
                                    // $rowspan = $registerpys->where('concept.area_id', $pys->concept->area->id)->count('area.id');
                                    // echo $rowspan;
                                    // echo $key;
                                    @endphp

                                <tr class="border border-dark">
                                    
                                    <td>{{$py->concept->concept}}</td>
                                    <td class="text-center">@if($py->status == 'si')
                                            <span class="badge badge-success">SI</span>
                                        @elseif($py->status == 'no')
                                            <span class="badge badge-danger">NO</span>
                                        @else
                                            <span class="badge badge-secondary">N/A</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $py->discount ?? '' }}</td>
                                    <td class="text-center">{{ $py->sign ?? '' }}</td>
                                    <td class="text-center">{{ $py->observations ?? '' }}</td> 
                                    <td class="text-center align-middle" scope="row">
                                        @if($py->sign)
                                        <a class="btn btn-success disabled" href="#" role="button" disabled>Revisado</a>
                                        @else
                                        <a class="btn btn-secondary disabled" href="#" role="button" disabled>Sin Revisar</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                

  </tbody>
</table>
@endforeach

                    </div>
                </div>
            </div>
    </div>
@endsection