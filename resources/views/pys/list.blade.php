@extends('layouts.base')
@section('title', 'Procesos activos de Paz y Salvo')
@section('content')
{{-- <list-pys></list-pys> --}}
@php $aux = 0 @endphp
    <div class="row">
        <div class="col-lg-12">
            @foreach($users as $u)
                               {{--  {{$u->employee->position->depend_id}} {{$supervisor->position_id}} --}}
                @if($u->employee->position->depend_id == $auth->employee->position_id || $auth->employee->position->area_id == 2 || $auth->employee->position->area_id == 3)
                    <div class="card mb-5">
                        <div class="card-header">
                            <strong class="card-title">
                                <div class="text-light blooker20-gradient rounded mx-auto shadow" style="margin-top: -25px; max-width: calc(100% - 20px);">
                                    <h2 class="p-3">Proceso de Paz  y Salvo: {{$u->name}} {{$u->last_name}} <a target="_blank" class="btn btn-dark float-right my-auto" href="/U/{{$u->slug}}" role="button">Ver Perfil</a></h2>
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
                                        @if($pys->concept->area->id == 1 && $u->employee->position->depend_id == $auth->employee->position_id)
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
                                                <td class="text-center">{{ number_format($pys->discount, 0, ',', '.')}}</td>
                                                <td class="text-center">{{ $pys->sign}}</td>
                                                <td class="text-center">{{ $pys->observations}}</td>
                                                <td class="text-center"><a class="btn btn-primary border" href="/pys/{{$pys->slug}}/edit" role="button">Verificar <i class="fa fa-check-square" aria-hidden="true"></i></a></td>
                                            </tr>
                                        @endif
                                        @if($pys->concept->area->id == $auth->employee->position->area_id)
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
                                                <td class="text-center">{{ $pys->discount ? '$ '.number_format($pys->discount, 0, ',', '.') : ''}}</td>
                                                <td class="text-center">{{ $pys->sign}}</td>
                                                <td class="text-center">{{ $pys->observations}}</td>
                                                <td class="text-center">
                                                    @if($pys->signer)
                                                        <a class="btn btn-secondary border" href="/pys/{{$pys->slug}}/edit" role="button">Verificado <i class="fa fa-check-square" aria-hidden="true"></i></a>
                                                    @else
                                                        <a class="btn btn-primary border" href="/pys/{{$pys->slug}}/edit" role="button">Verificar <i class="fa fa-check-square" aria-hidden="true"></i></a>
                                                    @endif
                                                </td>
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

@endsection