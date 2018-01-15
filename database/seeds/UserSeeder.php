<?php

use App\Profession;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	// $professions = DB::select('SELECT id FROM professions WHERE title = ?', ['Desarrollador back-end']);

    	// $profession = DB::table('professions')->select('id')->take(10)->get(); //take limitar registros
    	// $profession = DB::table('professions')->where('title', '=', 'Desarrollador front-end')->first();
    	// $profession = DB::table('professions')->where(['title' => 'Desarrollador front-end'])->first();
    	// $professionId = DB::table('professions')->where('title', 'Desarrollador front-end')->value('id'); //Obtener el valor solamente
        // $professionId = DB::table('professions')->whereTitle('Desarrollador front-end')->value('id'); //con metodos magicos de php

        /*DB::table('users')->insert([
            'name' => 'Jose Gregorio',
            'email' => 'jose@gregorio.com',
            'password' => bcrypt('secret'),
            'profession_id' => $professionId,
        ]);*/

        // Con el modelo
    	$professionId = Profession::whereTitle('Desarrollador back-end')->value('id'); //con metodos magicos de php
        
        User::insert([
            'name' => 'Jose Gregorio',
            'email' => 'jose@gregorio.com',
            'password' => bcrypt('secret'),
            'profession_id' => $professionId,
            'is_admin' => true,
        ]);

        factory(User::class)->times(9)->create();


    }
}
