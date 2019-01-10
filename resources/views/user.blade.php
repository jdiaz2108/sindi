@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-3">
        <form method="POST" action="/Em/{{$user->id}}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card" style="margin-top: 25px">
                <img style="margin-top: -25px; max-width: calc(100% - 32px); min-height: 150px" 
                @if($user->employee->user_picture) 
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
                    <hr>
                    <div class="card-text text-sm-center">
                        <label for="file" class="btn btn-primary">Seleccionar Archivo</label>

                        <input id="file" type="file" name="file" hidden="" required="" />
                        <hr>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-cloud-upload fa-lg" aria-hidden="true"></i> Subir</button>
                    </div>
                </div>
            </div>
        </form>

        <perfil-edit-user :level="{{Auth::user()->level}}" :user="{{$user}}"></perfil-edit-user>
    </div>

    <div class="col-md-12 col-lg-9">
        <personal-edit-user :level="{{Auth::user()->level}}" :personal="{{$user->employee}}" ></personal-edit-user>
        <laboral-edit-user :level="{{Auth::user()->level}}" :personal="{{$user->employee}}" ></laboral-edit-user>

        <div class="card ">
            <div class="card-header"><strong class="card-title mb-3">Cargo</strong></div>

            <div class="card-body"><p>Descriptor de cargo</p></div>
        </div>

        <div class="card ">
            <div class="card-header"><strong class="card-title mb-3">Historial</strong></div>

            <div class="card-body">

                <p>Últimos registros</p>
                <table id="login_table" style="width:100%" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>

        </div>


        <div class="card ">
                                <div class="card-header"><strong class="card-title mb-3">Actualizar Contraseña</strong></div>

                                <div class="card-body">

                                          <div class="col-md-9">
                                                    <label for="current-password" class="col-sm-4 control-label">Contraseña actual</label>
                                                    <div class="col-sm-8">
                                                        <div class="form-group">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}"> <input type="password" class="form-control" id="current-password"
                                                                                                                                  name="current-password" placeholder="Password" data-placement="right">
                                                        </div>
                                                    </div>
                                                    <label for="password" class="col-sm-4 control-label">Contraseña nueva</label>
                                                    <div class="col-sm-8">
                                                        <div class="form-group">
                                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" data-placement="right">
                                                        </div>
                                                    </div>
                                                    <label for="password_confirmation" class="col-sm-4 control-label">Respita su contraseña</label>
                                                    <div class="col-sm-8">
                                                        <div class="form-group">
                                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" data-placement="right"
                                                                   placeholder="Re-enter Password">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-sm-offset-5 col-sm-6">
                                                        <a href="#" role="button" class="btn btn-info float-right" id="savePass">Guardar</a>
                                                    </div>
                                                </div>

                                        </div>
                                        
        </div>

    </div>

</div>

<p>
    <a href="/" class="mt-2 btn btn-info">Regresar al listado de usuarios</a>
</p>
@endsection