@extends('layouts.base')

@section('title', 'Proceso Desvinculación')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<strong class="card-title">Inicio de Proceso Desvinculación</strong>
			</div>
			<div class="card-body">
				<div class="card col-8 m-5 mx-auto border-dark">
					<h3 class="card-header text-white text-center shadow py-4 sincityred-gradient rounded mx-auto w-75" style="margin-top: -25px; max-width: calc(100% - 40px);">
					Inicio Proceso de desvinculación
					</h3>
					<div class="card-body px-lg-5 pt-0 mx-auto">
						<form class="border-light p-5 form-group" action="/pys/{{Auth::user()->slug}}/create">
							<label for="textInput">Descripción:</label>
							<p class="py-3">este es un texto de prueba</p>
							
							<!-- Button trigger modal -->
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Continuar</button>
							<input class="btn btn-secondary" type="button" value="Cancelar">

							<!-- Modal -->
							<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							        ...
							      </div>
							      <div class="modal-footer">
							      	<button type="submit" class="btn btn-primary">Acepto</button>
							        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
							      </div>
							    </div>
							  </div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection