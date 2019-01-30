@extends('layouts.base')
@section('title', 'Verificación componente de Paz y Salvo')
@section('content')
{{-- <list-pys></list-pys> --}}
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Paz y Salvo</strong>
            </div>
            <div class="card-body">

            {{-- {{$registerpys}}<br><br>

            {{$registerpys->concept}}
            <br><br>
            {{$responsable}} --}}

                {!! Form::model($registerpys, ['route' => ['pys.update', $registerpys], 'method' => 'PUT', 'files' => 'true' , 'class' => 'form-horizontal form-label-left']) !!}    

                    <div class="row form-group">
                        <div class="col col-md-3">{!! Form::label('nombre', 'Nombres Usuario:' , ['class' => 'form-control-label']) !!}</div>
                        <div class="col-12 col-md-9">
                            {{$registerpys->user->name}} {{$registerpys->user->last_name}}
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">{!! Form::label('nombre', 'Identificación Usuario:' , ['class' => 'form-control-label']) !!}</div>
                        <div class="col-12 col-md-9">
                            {{$registerpys->user->document}}
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">{!! Form::label('nombre', 'Correo Usuario:' , ['class' => 'form-control-label']) !!}</div>
                        <div class="col-12 col-md-9">
                            {{$registerpys->user->email}}
                        </div>
                    </div>

                    <hr class="w-75 mx-auto py-3">

                    <div class="row form-group">
                        <div class="col col-md-3">{!! Form::label('nombre', 'Area Encargada:' , ['class' => 'form-control-label']) !!}</div>
                        <div class="col-12 col-md-9">
                            {{$registerpys->concept->area->name}}
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">{!! Form::label('nombre', 'Concepto:' , ['class' => 'form-control-label']) !!}</div>
                        <div class="col-12 col-md-9">
                            {{$registerpys->concept->concept}}
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">{!! Form::label('status', 'Paz y Salvo:' , ['class' => 'form-control-label']) !!}</div>
                        <div class="col-12 col-md-9">
                            {!! Form::select('status', ['si' => 'Si', 'no' => 'No' , null => 'No Aplica'], $registerpys->status ,['class' => 'form-control']) !!}
                            <small class="form-text text-muted">Estatus es requerido.</small>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">{!! Form::label('nombre', 'Valor a descontar:' , ['class' => 'form-control-label']) !!}</div>
                        <div class="col-12 col-md-9">
                            {!! Form::text('nombre', null , ['class' => 'form-control' , 'placeholder' => 'Valor a descontar.']) !!}
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">{!! Form::label('nombre', 'Firma Responsable:' , ['class' => 'form-control-label']) !!}</div>
                        <div class="col-12 col-md-9">
                            {{$responsable->name}} {{$responsable->last_name}}
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">{!! Form::label('observations', 'Observaciones:' , ['class' => 'form-control-label']) !!}</div>
                        <div class="col-12 col-md-9">
                            {!! Form::textarea('observations', null , ['class' => 'form-control', 'placeholder' => 'Observaciones', 'rows' => 5]) !!}
                        </div>
                    </div>

                    <hr class="w-75 mx-auto py-3">

                    <div class="row form-group">
                        <div class="col col-md-3"></div>
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                        {!! Form::button('<i class="fa fa-check" aria-hidden="true"></i> Firmar y Aprobar', ['class' => 'btn btn-success', 'data-target' => '#exampleModal' , 'data-toggle' => 'modal']) !!}
                        {!! Form::button('<i class="fa fa-times" aria-hidden="true"></i> Cancelar', ['class' => 'btn btn-danger'])!!}

                            {{-- In Modal Confirmación --}}
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header blue-gradient text-white">
                                            <h5 class="modal-title" id="exampleModalLabel">Confirmación de firma</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true" class="text-white">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Acepto firmar este componente de paz y salvo a mi nombre.</div>
                                        <div class="modal-footer">
                                            {!! Form::submit('Acepto', ['class' => 'btn btn-success']) !!}
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Fn Modal Confirmación --}}
                        </div>
                    </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection