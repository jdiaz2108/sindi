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
							<geo-map ></geo-map>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection