@extends('layout')

@section('title', "Listado")

@section('content')
	<h1>{{ $title }}</h1>

	{{-- @unless (empty($users))
		<ul>
			@foreach ($users as $user)
				<li>{{ $user->name }} - {{ $user->email }}</li>
			@endforeach
		</ul>
	@else
		<p>No hay usuarios registrados</p>
	@endunless --}}

	{{-- forelse: igual que foreach pero con un valor por defecto --}}
	{{-- <ul> --}}
	<table class="table table-hover">
		<thead class="thead-dark">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Nombres</th>
				<th scope="col">Email</th>
				<th scope="col">Opciones</th>
			</tr>
		</thead>
		@forelse ($users as $user)
			<tbody>
				<tr>
					<th scope="row">{{ $user->id }}</th>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td><a href="{{ route('users.show', ['id' => $user]) }}">Ver detalles</a></td>
				</tr>
			</tbody>

			{{-- <li> --}}
				{{-- {{ $user->name }} ({{ $user->email }}) --}}
				{{-- <a href="{{ url("/usuarios/{$user->id}") }}">Ver detalles</a> --}}
				{{-- <a href="{{ action('UserController@show', ['id' => $user->id]) }}">Ver detalles</a> --}}
				{{-- Si estás pasando como argumento una llave primaria de un modelo de Eloquent, puedes pasar el modelo directamente a route(). El helper extraerá automáticamente dicha llave primaria --}}
				{{-- <a href="{{ route('users.show', ['id' => $user]) }}">Ver detalles</a> --}}
			{{-- </li> --}}
		@empty
			{{-- <li>No hay usuarios registrados.</li> --}}
			<p>No hay usuarios registrados.</p>
		@endforelse
	</table>
	{{-- </ul> --}}

@endsection

{{-- @section('sidebar')
	@parent
	<h2>Nueva barra lateral</h2>
@endsection --}}