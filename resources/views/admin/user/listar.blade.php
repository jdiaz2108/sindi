@extends('layouts.base')

@section('content')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Listar Usuarios</strong>
                            </div>
                            <div class="table-stats order-table ov-h">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th class="serial">ID</th>
                                            <th class="avatar">Avatar</th>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>Quantity</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td class="serial">{{$user->document}}</td>
                                            <td class="avatar">
                                                <div class="round-img">
                                                    <a href="/U/{{$user->slug}} ">
                                                        <img  
                                                        @if($user->employee->user_picture) 
                                                            src="{{ asset('storage/EmployeeImages/'.$user->employee->user_picture_url) }}" class="rounded-circle"
                                                        @else src="/images/avatar.png" class="rounded-circle blue-gradient p-1" @endif >



                                                    </a>
                                                </div>
                                            </td>
                                            <td> #5466 </td>
                                            <td>  <span class="name">{{$user->name}}</span> </td>
                                            <td> <span class="product">{{$user->email}}</span> </td>
                                            <td><span class="count">250</span></td>
                                            <td>
                                                <a role="button" class="btn btn-success btn-sm" href="/U/{{$user->slug}}"><i class="fa fa-user"></i>&nbsp; Ver Perfil</a>
                                            </td>
                                        </tr>
                                        @endforeach





                                    </tbody>
                                </table>
                            </div> <!-- /.table-stats -->
                        </div>
                    </div>

        </div>
@endsection