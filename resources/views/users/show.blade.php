@extends('layout')

@section('title', "Usuario: {$user->id}")

@section('content')
	
	<h1>Usuario #{{ $user->id }}</h1>

	<table class="table table-hover">
		<thead class="thead-dark">
			<tr>
				<th scope="col">Nombres</th>
				<th scope="col">Email</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>{{ $user->name }}</td>
				<td>{{ $user->email }}</td>
			</tr>
		</tbody>
	</table>

	{{-- <p>Nombre: {{ $user->name }}</p>
	<p>Email: {{ $user->email }}</p> --}}

	{{-- <p><a href="{{ action('UserController@index') }}">Volver al listado</a></p> --}}
	<p><a href="{{ route('users') }}">Volver al listado</a></p>

@endsection