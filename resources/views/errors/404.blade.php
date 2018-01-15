@extends('layout')

@section('title', "Página no encontrada")

@section('content')
	
	<h1 class="display-2">Página no encontrada</h1>
	
	<div class="alert alert-danger" role="alert">
		Error 404
	</div>

	<div class="alert alert-info" role="alert">
  		<a href="{{ url('/usuarios') }}" class="alert-link">Volver al inicio</a>
	</div>

@endsection