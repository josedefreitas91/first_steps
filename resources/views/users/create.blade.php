@extends('layout')

@section('title', "Crear Usuario")

@section('content')
	
	<h1>Crear Usuario</h1>

	@if ($errors->any())
		<div class="alert alert-danger">
			<h6>Por favor corrige los errores</h6>
			{{-- <ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul> --}}
		</div>
	@endif

	<form method="POST" action="{{ route('users.store') }}">
		{{ csrf_field() }}

		<label for="name">Nombre: </label>
		<input class="form-control" type="text" name="name" id="name" placeholder="Pedro Pérez" value="{{ old('name') }}">
		
		@if ($errors->has('name'))
			<div class="alert alert-danger">{{ $errors->first('name') }}</div>
		@endif
		<br>
		<label for="email">Correo electrónico: </label>
		<input class="form-control" type="email" name="email" id="email" placeholder="pedro@perez.com" value="{{ old('email') }}">
		@if ($errors->has('email'))
			<div class="alert alert-danger">{{ $errors->first('email') }}</div>
		@endif
		<br>
		<label for="password">Contraseña: </label>
		<input class="form-control" type="password" name="password" id="password" placeholder="Mayor a 6 carácteres">
		@if ($errors->has('password'))
			<div class="alert alert-danger">{{ $errors->first('password') }}</div>
		@endif
		<br>
		<button type="submit" class="btn btn-primary mb-4">Crear usuario</button>
	</form>

	<p><a href="{{ route('users') }}">Volver al listado</a></p>

@endsection