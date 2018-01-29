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
    		->assertSee('Crear usuario');
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

    /** @test */
    function the_name_is_required(){
        // $this->withoutExceptionHandling();
        factory(Profession::class)->times(18)->create();

        $this->from(route('users.create'))
            ->post('/usuarios/crear', [
                'name' => '',
                'email' => 'jose@gregorio.com',
                'password' => '123456'
            ])
            ->assertRedirect(route('users.create'))
            ->assertSessionHasErrors(['name' => 'El campo es obligatorio']);

        $this->assertEquals(0, User::count());

        // $this->assertDatabaseMissing('users', [
        //     'email' => 'jose@gregorio.com'
        // ]);
    }

    /** @test */
    function the_email_is_required(){

        $this->from(route('users.create'))
            ->post('/usuarios/crear', [
                'name' => 'Jose',
                'email' => '',
                'password' => '123456'
            ])
            ->assertRedirect(route('users.create'))
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(0, User::count());
    }

    /** @test */
    function the_email_must_be_valid(){

        $this->from(route('users.create'))
            ->post('/usuarios/crear', [
                'name' => 'Jose',
                'email' => 'email-valido',
                'password' => '123456'
            ])
            ->assertRedirect(route('users.create'))
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(0, User::count());
    }

    /** @test */
    function the_email_must_be_unique(){
        // $this->withoutExceptionHandling();

        factory(Profession::class)->times(20)->create();
        factory(User::class)->create([
            'email' => 'jose@gregorio.com'
        ]);

        $this->from(route('users.create'))
            ->post('/usuarios/crear', [
                'name' => 'Jose',
                'email' => 'jose@gregorio.com',
                'password' => '123456'
            ])
            ->assertRedirect(route('users.create'))
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(1, User::count());
    }

    /** @test */
    function the_password_is_required(){

        $this->from(route('users.create'))
            ->post('/usuarios/crear', [
                'name' => 'Jose',
                'email' => 'jose@gregorio.com',
                'password' => ''
            ])
            ->assertRedirect(route('users.create'))
            ->assertSessionHasErrors(['password']);

        $this->assertEquals(0, User::count());
    }

    /** @test */
    function the_password_must_be_greater_than_six_characters(){

        $this->from(route('users.create'))
            ->post('/usuarios/crear', [
                'name' => 'Jose',
                'email' => 'jose@gregorio.com',
                'password' => '123'
            ])
            ->assertRedirect(route('users.create'))
            ->assertSessionHasErrors(['password']);

        $this->assertEquals(0, User::count());
    }

    /** @test */
    function it_loads_the_edit_user_page()
    {
        factory(Profession::class)->times(20)->create();

        $user = factory(User::class)->create();

        $this->get("/usuarios/{$user->id}/editar")
            ->assertStatus(200)
            ->assertViewIs('users.edit')
            ->assertSee('Editar Usuario')
            //que posea dicha variable en la vista
            ->assertViewHas('user', function($viewUser) use ($user){
                return $viewUser->id == $user->id;
            });
    }

    /** @test */
    function it_updates_a_user(){

        $this->withoutExceptionHandling();

        factory(Profession::class)->times(20)->create();
        $user = factory(User::class)->create();

        $this->put("/usuarios/{$user->id}", [
                'name' => 'Jose',
                'email' => 'jose@gregorio.com',
                'password' => '123456'
            ])
            ->assertRedirect("/usuarios/{$user->id}");

        $this->assertCredentials([
            'name' => 'Jose',
            'email' => 'jose@gregorio.com',
            'password' => '123456'
        ]);
    }

    /** @test */
    function the_name_is_required_when_updating_a_user(){
        // $this->withoutExceptionHandling();
        factory(Profession::class)->times(18)->create();
        $user = factory(User::class)->create();

        $this->from("/usuarios/{$user->id}/editar")
            ->put("/usuarios/{$user->id}", [
                'name' => '',
                'email' => 'jose@gregorio.com',
                'password' => '123456'
            ])
            ->assertRedirect("/usuarios/{$user->id}/editar");
            // ->assertSessionHasErrors(['name' => 'El campo es obligatorio']);

        $this->assertEquals(0, User::count());

        $this->assertDatabaseMissing('users', [
            'email' => 'jose@gregorio.com'
        ]);
    }

}
