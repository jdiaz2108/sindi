@extends('layouts.base')

@section('content')
{{-- <list-pys></list-pys> --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Pas y Salvo</strong>
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

                                <hr class="w-75 text-center py-3">

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
                                        <small class="form-text text-muted">No Requerido.</small>
                                    </div>
                                </div>

                                <hr class="w-75 text-center py-3">

                                <div class="row form-group">
                                    <div class="col col-md-3"></div>
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                        {!! Form::button('<i class="fa fa-check" aria-hidden="true"></i> Firmar y Aprobar', ['class' => 'btn btn-success', 'data-target' => '#exampleModal' , 'data-toggle' => 'modal']) !!}
                                        {!! Form::button('<i class="fa fa-times" aria-hidden="true"></i> Cancelar', ['class' => 'btn btn-danger'])!!}

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Ventana de Confirmación</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    ...
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                     {!! Form::submit('Firmar y Aprobar', ['class' => 'btn btn-lg btn-success']) !!}
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                    </div>
                                </div>

                            



                            {!! Form::close() !!}
                        </div>
            </div>
        </div>
    </div>

@endsection