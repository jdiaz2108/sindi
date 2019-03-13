@extends('layouts.base')
@section('title', 'Perfil Administrador')
@section('content')
<div class="container-fluid">
<div class="row">
        <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-flat-color-3 shadow">
                            <div class="card-body">
                                <div class="card-left pt-1 float-left">
                                    <h3 class="mb-0 fw-r">
                                        <span class="count">6569</span>
                                    </h3>
                                    <p class="text-light mt-1 m-0">Total Colaboradores</p>
                                </div><!-- /.card-left -->

                                <div class="card-right float-right text-right">
                                    <i class="icon fade-5 icon-lg pe-7s-users"></i>
                                </div><!-- /.card-right -->

                            </div>

                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-flat-color-3">
                            <div class="card-body">
                                <div class="card-left pt-1 float-left">
                                    <h3 class="mb-0 fw-r">
                                        <span class="count">6569</span>
                                    </h3>
                                    <p class="text-light mt-1 m-0">Total clients</p>
                                </div><!-- /.card-left -->

                                <div class="card-right float-right text-right">
                                    <i class="icon fade-5 icon-lg pe-7s-users"></i>
                                </div><!-- /.card-right -->

                            </div>

                        </div>
                    </div>
</div>
<div class="row">
    <div class="col-md-12 col-lg-4 col-xl-3">
        <form method="POST" action="/Em/{{$user->id}}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card" style="margin-top: 25px">
                <img style="margin-top: -25px; max-width: calc(100% - 32px); min-height: 150px" 
                @if($user->employee->user_picture ?? '' != '') 
                    src="{{ asset('storage/EmployeeImages/'.$user->employee->user_picture_url) }}" class="card-img-top mx-auto shadow rounded"
                @else src="/images/avatar.png" class="card-img-top mx-auto shadow rounded blue-gradient p-5" @endif  
                alt="Card image cap">

                <div class="card-body">
                <h5 class="text-sm-center mt-2 mb-1">{{$user->name}}</h5>
                <div class="location text-sm-center"><i class="fa fa-id-card-o"></i> {{$user->email}}</div>
                <hr>
                    <div class="card-text text-sm-center">
                        <a href="#"><i class="fa fa-facebook pr-1"></i></a>
                        <a href="#"><i class="fa fa-twitter pr-1"></i></a>
                        <a href="#"><i class="fa fa-linkedin pr-1"></i></a>
                        <a href="#"><i class="fa fa-pinterest pr-1"></i></a>
                    </div>

                    @if(Auth::user()->level >= 355)
                        <hr>
                        <div class="card-text text-sm-center">
                            <label for="file" class="btn btn-primary">Seleccionar Archivo</label>

                            <input id="file" type="file" name="file" hidden="" required=""/>
                            <hr>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-cloud-upload fa-lg" aria-hidden="true"></i> Subir</button>
                        </div>
                    @endif
                </div>
            </div>
        </form>

        <perfil-edit-user :level="{{Auth::user()->level}}" :user="{{$user}}"></perfil-edit-user>
@if(Auth::user()->level > 200)
    <div class="card">
        <div class="card-header">
            <label class="label label-default align-baseline font-weight-bold">Acciones Admin</label>
        </div>
        <div class="row">
            <div class="col-lg-12">

                <div class="card-body">

                    @if(Auth::user()->id != $user->id)
                        @if($user->status == 6)
                            <form class="py-1 form-group" action="/pys/{{$user->slug}}/create">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#exampleModal">Desvincular usuario</button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header sincityred-gradient text-white">
                                        <h5 class="modal-title" id="exampleModalLabel">Confirmación de Desvinculación</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true" class="text-white">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        En esta sección podrás dar inicio al proceso de desvinculación de uno de nuestros colaboradores. 
                                        Al hacer clic en continuar, darás inicio y serás el responsable del proceso de desvinculación del usuario. 
                                      </div>
                                      <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Continuar</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </form>
                        @elseif($user->status == 5)
                            <button type="button" class="btn btn-info btn-block text-light disabled">Desvinculando Usuario</button>
                        @endif
                    @endif
                    <div class="progress-box progress-1">
                        <h4 class="por-title">Visits</h4>
                        <div class="por-txt">96,930 Users (40%)</div>
                        <div class="progress mb-2" style="height: 5px;">
                            <div class="progress-bar bg-flat-color-1" role="progressbar" style="width: 40%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="progress-box progress-2">
                        <h4 class="por-title">Bounce Rate</h4>
                        <div class="por-txt">3,220 Users (24%)</div>
                        <div class="progress mb-2" style="height: 5px;">
                            <div class="progress-bar bg-flat-color-2" role="progressbar" style="width: 24%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="progress-box progress-2">
                        <h4 class="por-title">Unique Visitors</h4>
                        <div class="por-txt">29,658 Users (60%)</div>
                        <div class="progress mb-2" style="height: 5px;">
                            <div class="progress-bar bg-flat-color-3" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="progress-box progress-2">
                        <h4 class="por-title">Targeted  Visitors</h4>
                        <div class="por-txt">99,658 Users (90%)</div>
                        <div class="progress mb-2" style="height: 5px;">
                            <div class="progress-bar bg-flat-color-4" role="progressbar" style="width: 90%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div> <!-- /.card-body -->
            </div>
        </div> <!-- /.row -->
        <div class="card-body"></div>
    </div>
@endif

    </div>

    <div class="col-md-12 col-lg-8 col-xl-9">
        <personal-edit-user :level="{{Auth::user()->level}}" :personal="{{$user->employee}}" ></personal-edit-user>
        <laboral-edit-user :level="{{Auth::user()->level}}" :personal="{{$user->employee}}" ></laboral-edit-user>
    </div>

</div>
</div>
@endsection