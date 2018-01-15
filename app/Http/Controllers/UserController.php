<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
    	$users = User::all();

    	$title = 'Listado de Usuarios';

    	// return view('users', [ 'users' => $users, 'title' => $title ]);
    	// return view('users')->with([ 'users' => $users, 'title' => $title ]);
    	// return view('users.index')
    	// 	->with('users', $users)
    	// 	->with('title', $title);

		return view('users.index', compact('users', 'title'));
    }

    public function show(User $user/*$id*/){

    	// $user = User::findOrFail($id);

    	//findOrFail devuelve excepcion de modelo no encontrado y redirige a una vista 404
    	// if ($user == null) {
    	// 	return response()->view('errors.404', /*datos a enviar*/[], 404);
    	// }

    	return view('users.show', compact('user'));
    }

	public function create(){
    	return 'Crear nuevo usuario';
    }

    public function edit($id){
    	return "Editando detalles del usuario: {$id}";
    }

}
