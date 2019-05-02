@extends('layouts.base')

@section('title', 'Visualizador Admin')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<strong class="card-title">Visualizador Mapa Admin</strong>
					</div>
					<div class="card-body">
						<div class="col-12 mx-auto">
							<geo-map-admin ></geo-map-admin>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection