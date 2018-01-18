@extends('layout')

@section('title', "Crear Usuario")

@section('content')
	
	<h1>Crear Usuario</h1>

	<form method="POST" action="{{ route('users.store') }}">
		{{ csrf_field() }}

		<label for="name">Nombre: </label>
		<input class="form-control" type="text" name="name" id="name" placeholder="Pedro Pérez">
		<br>
		<label for="email">Correo electrónico: </label>
		<input class="form-control" type="email" name="email" id="email" placeholder="pedro@perez.com">
		<br>
		<label for="password">Contraseña: </label>
		<input class="form-control" type="password" name="password" id="password" placeholder="Mayor a 6 carácteres">
		<br>

		<button type="submit" class="btn btn-primary mb-4">Crear usuario</button>
	</form>

	<p><a href="{{ route('users') }}">Volver al listado</a></p>

@endsection