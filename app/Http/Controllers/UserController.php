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
    	return view('users.create');
    }

    public function store(){

		// devolver los valores de los campos de forma manual cuando hay errores
        // return redirect()->route('users')->withInput();

        $data = request()->validate([
            'name' => 'required',
            // 'email' => 'required|email',
            'email' => ['required', 'email','unique:users,email'],
            'password' => 'required|min:6'
        ], [
        	// para todos los campos
            'required' => 'El campo es obligatorio',
            'password.min' => 'Debe ser mayor a 6 carácteres',
            // un campo en especifico
            // 'email.required' => 'El campo es obligatorio',
            // 'password.required' => 'El campo es obligatorio',
        ]);

        // if(empty($data['name'])){
        //     return redirect()->route('users.create')->withErrors([
        //         'name' => 'El campo es obligatorio'
        //     ]);
        // }

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        // return redirect('/usuarios');
        return redirect()->route('users');
    }

    public function edit(User $user){
    	// return "Editando detalles del usuario: {$id}";
    	return view('users.edit', ['user' => $user]);
    }

    public function update(User $user){

    	$data = request()->all();
    	$data['password'] = bcrypt($data['password']);
    	$user->update($data);
    	return redirect()->route('users.show', ['user' => $user]);
    }

}
