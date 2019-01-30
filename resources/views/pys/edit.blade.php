@extends('layouts.base')

@section('content')
{{-- <list-pys></list-pys> --}}
@php $aux = 0 @endphp

    <div class="row">
        <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Paz y Salvo</strong>
                        </div>
                        <div class="card-body">
                            <table class="table">
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