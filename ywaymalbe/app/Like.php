<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //
    protected $table='likes';
    protected $fillable=['videos_id','viewers_id','created_at','updated_at'];
}
