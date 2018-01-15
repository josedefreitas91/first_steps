<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeUserController extends Controller
{
	// __invoke cuando usamos un solo metodo
    public function __invoke($nombre, $nickname = null){
    	$nombre = ucfirst($nombre);

		if ($nickname){
			return "Bienvenido {$nombre}, tu apodo es {$nickname}";
		} else {
	    	return "Bienvenido {$nombre}";
		}
    }
}
