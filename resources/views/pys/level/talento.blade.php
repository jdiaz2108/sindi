@extends('layouts.base')

@section('title', 'Procesos activos de Paz y Salvo Talento Humano')

@section('content')
    @php $aux = 0 @endphp

    <div class="row">
        <div class="col-lg-12">
            @foreach($users as $u)
            {{--  {{$u->employee->position->depend_id}} {{$supervisor->position_id}} --}}
                <div class="card mb-5">
                    <div class="card-header">
                        <strong class="card-title">
                        <div class="text-light blooker20-gradient rounded mx-auto shadow" style="margin-top: -25px; max-width: calc(100% - 20px);">
                            <h2 class="p-3">Proceso de Paz  y Salvo: {{$u->name}} {{$u->last_name}}
                                <a target="_blank" class="btn btn-dark float-right my-auto" href="/U/{{$u->slug}}" role="button">Ver Perfil</a>
                            </h2>
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
                                    
                                    @php
                                        $rowspan = $u->registerpys->where('concept.area_id', $pys->concept->area->id)->count('area.id');
                                        $rowspan2 = $pys->concept->area->id;
                                    @endphp
                                    @if(($auth->level < 390 && $auth->level > 370) || 
                                        ($auth->level == 500 && $rowspan2 == 2) || 
                                        (($u->employee->position->depend->employee->user->id ?? '') == $auth->id && $rowspan2 == 1))
                                    <tr>
                                        @if($aux != $rowspan)
                                            <td rowspan="{{$rowspan}}" class="text-center text-white align-middle border-dark border blue-gradient" scope="row">

                                                {{ $pys->concept->area->name ?? '' }}

                                                @if( ($pys->concept->area->id ?? '') == 3 && $talentoHumano)

                                                    <br>
                                                    Responsable: 
                                                    <br>
                                                    {{$talentoHumano->name}} {{$talentoHumano->last_name}}
                                                    <br>
                                                    Correo: 
                                                    <br>
                                                    {{$talentoHumano->employee->email_corporate}}

                                                @elseif( ($pys->concept->area->id ?? '') == 2 && $IT)

                                                    <br>
                                                    Responsable: 
                                                    <br>
                                                    {{$IT->name}} {{$IT->last_name}}
                                                    <br>
                                                    Correo: 
                                                    <br>
                                                    {{$IT->employee->email_corporate}}


                                                @elseif( ($pys->concept->area->id ?? '') == 1 && ($u->employee->position->depend->employee->user->name ?? ''))
                                                  {{--   {{$u}} --}}
                                                    <br>
                                                    Responsable: 
                                                    <br>
                                                    {{$u->employee->position->depend->employee->user->name}} {{$u->employee->position->depend->employee->user->last_name}}
                                                    <br>
                                                    Correo: 
                                                    <br>
                                                    {{$u->employee->position->depend->employee->email_corporate}}

                                                @endif

                                            </td>

                                            

                                        @endif 
                                        {{--      <td class="text-center">{{ $pys->concept->area->name ?? '' }}</td> --}}
                                        <td class="text-center">{{ $pys->concept->concept}}</td>
                                        <td class="text-center">
                                            @if($pys->status == 'si')
                                                <span class="badge badge-success">SI</span>
                                            @elseif($pys->status == 'no')
                                                <span class="badge badge-danger">NO</span>
                                            @else
                                                <span class="badge badge-secondary">N/A</span>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $pys->discount ? '$ '.number_format($pys->discount, 0, ',', '.') : ''}}</td>
                                        <td class="text-center">{{ $pys->sign}}</td>
                                        <td class="text-center">{{ $pys->observations}}</td>

                                        @if(($auth->level < 390 && $auth->level > 370 && $rowspan2 == 3) || 
                                        ($auth->level == 500 && $rowspan2 == 2) || 
                                        (($u->employee->position->depend->employee->user->id ?? '') == $auth->id && $rowspan2 == 1))
                                        <td class="text-center">
                                        @if($pys->signer)
                                        <a class="btn btn-secondary border" href="/pys/{{$pys->slug}}/edit" role="button">Verificado <i class="fa fa-check-square" aria-hidden="true"></i></a>
                                        @else
                                        <a class="btn btn-primary border" href="/pys/{{$pys->slug}}/edit" role="button">Verificar <i class="fa fa-check-square" aria-hidden="true"></i></a>
                                        @endif
                                        </td>
                                        @else
                                        <td class="text-center align-middle" scope="row">
                                        @if($pys->sign)
                                        <a class="btn btn-success disabled" href="#" role="button" disabled>Revisado</a>
                                        @else
                                        <a class="btn btn-secondary disabled" href="#" role="button" disabled>Sin Revisar</a>
                                        @endif
                                        </td>
                                        @endif
                                    </tr>
                                    @endif
                                    @php $aux = $rowspan @endphp
                                {{--                                         @endif --}}
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection