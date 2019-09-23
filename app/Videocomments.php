<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Videocomments extends Model
{
    //
    protected $table='Videocomments';
    public $fillable=['comments','videos_id','viewers_id','created_at','updated_at'];
    public function getDateAttribute() {
       return Carbon::parse($this->attributes['created_at'])->toDateString();
    }
}
