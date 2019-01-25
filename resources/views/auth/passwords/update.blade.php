 <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10 col-12">
                    <div class="card shadow" style="border-radius:25px;">
                        <div class="card-body text-center">
                            <img src="/images/resources/logo_base.svg" class="img-fluid p-3 mx-auto" style="max-width: 300px" />
                            <h3 class="text-primary pb-3">Bienvenido a SINDI</h3>

                            <form method="POST" class="align-middle form-group" action="/U/{{$user->slug}}/updatePassword">
                                @method('PUT')
                                @csrf
                                <div class="row">
<p class="text-secondary mx-auto text-center col-10 pb-3">Antes de ingresar, te invitamos a asignar una nueva contraseña para garantizar mayor seguridad y una experiencia personalizada.</p>
                                            <div class="alert alert-danger alert-dismissible fade mx-auto {{ Session::get('message') ? 'show' : 'd-none' }}" role="alert">
                                              <strong>Mensaje!</strong> {{Session::get('message')}}
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                        
                                            <h5 class="text-secondary mx-auto text-center pb-3 col-12">Contraseña actual</h5>
                                            <div class="form-group col-md-8 mx-auto">
                                                <input name="passwordOld" type="password" class="form-control{{ $errors->has('passwordOld') ? ' is-invalid' : '' }}" required autofocus>
                                                @if ($errors->has('passwordOld'))
                                                    <span class="invalid-feedback">
                                                        @foreach($errors->get('passwordOld') as $error)
                                                       {{--  <strong>{{ $errors->first('password') }} nea</strong> --}}
                                                       <strong>{{$error}}</strong>
                                                        @endforeach
                                                    </span>
                                                @endif
                                            </div>


                                            <h5 class="text-secondary mx-auto text-center pb-3 col-12">Contraseña nueva</h5>
                                            <div class="form-group col-md-8 mx-auto">
                                                <input name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required autofocus>
                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback">
                                                        @foreach($errors->get('password') as $error)
                                                       {{--  <strong>{{ $errors->first('password') }} nea</strong> --}}
                                                       <strong>{{$error}}</strong>
                                                        @endforeach
                                                    </span>
                                                @endif
                                            </div>

                                            <h5 class="text-secondary mx-auto text-center pb-3 col-12">Repetir contraseña nueva</h5>


                                            <div class="form-group col-md-8 mx-auto">
                                                <input name="password_confirmation" type="password" class="form-control" required>
                                            </div>


                                            <div class="col-md-8 text-center mx-auto my-3">
                                                <button type="submit" class="btn btn-primary btn-lg">Actualizar Contraseña</button>
                                            </div>

                                            <div class="col-md-8 text-center mx-auto my-3">
                                                <button type="button" class="btn btn-secondary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button>
                                            </div>
                                </div>
                            </form>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
   </main>