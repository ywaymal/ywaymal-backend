<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Videocomments extends Model
{
    //
    protected $table='Videocomments';
    public $fillable=['comments','videos_id','viewers_id','created_at','updated_at'];

}
