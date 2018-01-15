<?php

namespace Tests\Feature;

use App\Profession;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UsersModuleTest extends TestCase
{

    use RefreshDatabase;
    
    /** @test */
    // function it_loads_the_users_list_page()
    // {
    //     factory(User::class)->create([
    //         'name' => 'Pedro'
    //     ]);

    //     factory(User::class)->create([
    //         'name' => 'Jose'
    //     ]);

    // 	$this->get('/usuarios')
    // 		->assertStatus(200)
    //         ->assertSee('Pedro')
    //         ->assertSee('Jose');
    // }

    /** @test */
    function it_loads_show_no_found_users(){
        // DB::table('users')->truncate();

        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('No hay usuarios registrados.');
    }

    /** @test */
    function it_display_the_users_details_page()
    {
        factory(Profession::class)->times(18)->create();

        $user = factory(User::class)->create([
            'name' => 'Jose Gregorio',
        ]);

        $this->get('/usuarios/'.$user->id)
            ->assertStatus(200)
            ->assertSee('Jose Gregorio');
    }

	// /** @test */
	// function it_loads_the_users_details_page()
 //    {
 //    	$this->get('/usuarios/5')
 //    		->assertStatus(200)
 //    		->assertSee('Mostrando detalle del usuario: 5');
 //    }

    /** @test */
	function it_loads_the_new_users_page()
    {
    	$this->get('/usuarios/nuevo')
    		->assertStatus(200)
    		->assertSee('Crear nuevo usuario');
    }

    /** @test */
    function it_show_404_error_if_not_found_page(){
        $this->get('/usuarios/999')
            ->assertStatus(404)
            ->assertSee('Página no encontrada');
    }

    /** @test */
    function it_creates_a_new_user(){
        // Mostrar todos los errores
        $this->withoutExceptionHandling();

        $this->post('/usuarios/crear',[
            'name' => 'Jose Gregorio',
            'email' => 'jose@gregorio.com',
            'password' => '123456'
        ])
            ->assertRedirect(route('users'));

        $this->assertDatabaseHas('users', [
            'name' => 'Jose Gregorio',
            'email' => 'jose@gregorio.com',
            // 'password' => '123456'
        ]);
    }

}
