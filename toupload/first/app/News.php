<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //
    protected $table='news';
    protected $fillable=['title','slider','file','uploader_id','link','file_type','description'];
}
