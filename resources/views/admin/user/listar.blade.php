@extends('layouts.base')

@section('content')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Listar Usuarios</strong>
                            </div>
                            <div class="table-stats order-table ov-h card-body ">
                                <table id="myTable" class="table ">
                                    <thead>
                                        <tr>
                                            <th class="serial">id</th>
                                            <th class="serial">ID</th>
                                            <th class="avatar">Avatar</th>
                                            
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Email</th>

                                            <th>Cargo</th>
                                            <th>Ciudad</th>
                                            {{-- <th>Quantity</th> --}}
                                            <th>Ver Perfil</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employees as $employee)
                                        <tr>
                                            <td class="serial">{{$employee->id}}</td>
                                            <td class="serial">{{$employee->user->document ?? ''}}</td>
                                            <td class="avatar">
                                                <div class="round-img">
                                                    <a href="/U/{{$employee->user->slug ?? ''}} ">
                                                        <img  
                                                        @if($employee->user_picture) 
                                                            src="{{ asset('storage/EmployeeImages/'.$employee->user_picture_url) }}" class="rounded-circle"
                                                        @else src="/images/avatar.png" class="rounded-circle blue-gradient p-1" @endif >
                                                    </a>
                                                </div>
                                            </td>
                                            <td>  <span class="name">{{$employee->user->name ?? ''}}</span> </td>
                                            <td>  <span class="name">{{$employee->user->last_name ?? ''}}</span> </td>
                                            <td>  <span class="name">{{$employee->user->email ?? ''}}</span> </td>
                                            <td>  <span class="name">{{$employee->position->name ?? ''}}</span> </td>
                                            <td>  <span class="name">{{$employee->city->name ?? ''}}</span> </td>
                                            {{-- <td><span class="count">250</span></td> --}}
                                            <td>
                                                <a role="button" class="btn btn-success btn-sm" href="/U/{{$employee->user->slug  ?? ''}}"><i class="fa fa-user"></i>&nbsp; Ver Perfil</a>
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
@section('script')
<script>
    $(document).ready( function () {
        $('#myTable').DataTable({
            "order": [[0 , "asc"]],
            "columnDefs": [{
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            }]
        });
    } );
</script>
@endsection