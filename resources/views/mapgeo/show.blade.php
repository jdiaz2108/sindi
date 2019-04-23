@extends('layouts.base')

@section('title', 'Geolocalizador')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<strong class="card-title">Geolocalizador</strong>
					</div>
					<div class="card-body">
						<div class="col-12 m-5 mx-auto">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Estado</th>
                        <th scope="col">Nombres</th>
                        <th scope="col">Latitud</th>
                        <th scope="col">Longitud</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Fecha</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($allGeo as $geo)
                      @php $date = strtotime($geo->created_at) @endphp
                        <tr>
                          <td>@if($geo->status == 1) <button class="btn btn-block pr-3" style="border: 1px solid lime;">Entrada</button> @elseif($geo->status == 2) <button class="btn btn-block pr-3" style="border: 5px solid #000000;" >Salida</button> @endif</td>
                          <td>{{$geo->user->name}} {{$geo->user->last_name}}</td>
                          <td>{{$geo->latitude}}</td>
                          <td>{{$geo->longitude}}</td>
                          <td>{{date('h:i:s a', $date)}}</td>
                          <td>{{date('Y-m-d', $date)}}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection