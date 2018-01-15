@extends('layout')

@section('title', "Crear Usuario")

@section('content')
	
	<h1>Crear Usuario</h1>

	<form method="POST" action="{{ route('users.store') }}">
		{{ csrf_field() }}

		<button type="submit">Crear usuario</button>
	</form>

	<p><a href="{{ route('users') }}">Volver al listado</a></p>

@endsection