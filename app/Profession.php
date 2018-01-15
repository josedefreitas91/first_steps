<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    // protected $table = 'my_new_table';

    // public $timestamps = false;

    protected $fillable = ['title'];

    public function users(){
    	return $this->hasMany(User::class);
    }

}
