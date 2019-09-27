<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sliders extends Model
{
    //
    protected $table='sliders';
    protected $fillable=['description','videos','images','uploader_id','videos_type','created_at','updated_at'];
}
