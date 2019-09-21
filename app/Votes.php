<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Votes extends Model
{
    //
    protected $table='votes';
    protected $fillable=['videos_id','viewers_id','created_at','updated_at'];
}
