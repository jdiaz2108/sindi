@extends('layouts.base')

@section('title', 'Proceso Desvinculación')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<strong class="card-title">Proceso Desvinculación no iniciado</strong>
			</div>
			<div class="card-body">
				<div class="card col-8 m-5 mx-auto border-dark">
					<h3 class="card-header text-white text-center shadow py-4 sincityred-gradient rounded mx-auto w-75" style="margin-top: -25px; max-width: calc(100% - 40px);">
					Proceso de desvinculación no iniciado
					</h3>
					<div class="card-body px-lg-5 pt-0 mx-auto">
						<div class="border-light p-5 form-group" >
							<label for="textInput">Descripción:</label>
							<p class="pt-3">
							En esta sección podrás hacer seguimiento de tu proceso de desvinculación y de los paz y salvos necesarios para tal fin. 
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection