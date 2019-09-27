<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    //
    protected $table='videos';
    protected $fillable=['title','image','video_type','link','description','person','uploader_id','active','city','state'];
}
