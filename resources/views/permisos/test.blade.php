@extends('layouts.base')

@section('title', 'Solicitudes')

@section('content')
<div class="container-fluid">
	<vue-permisos :auth="{{$auth}}"></vue-permisos>
</div>
fortuito
@endsection