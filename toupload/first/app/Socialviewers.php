<?php
//this model for social users data
namespace App;

use Illuminate\Database\Eloquent\Model;

class Socialviewers extends Model
{
    //
    protected $table='social_viewers_data';
    protected $fillable=['user_id','provider_user_id','provider','profile_picture'];

}
