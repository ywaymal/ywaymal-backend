<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;

class SocialapiController extends Controller
{
    //
    public function __construct()
    {
//        $this->middleware('auth:api',['except'=>['register']]);real
    }
    public function like(Request $request){
       if(Like::where([['viewers_id','=',$request->viewers_id],['videos_id','=',$request->videos_id]])->count != 0){
           $input = $request->all();
           $input['created_at'] = Carbon::now();
           $input['updated_at'] = Carbon::now();
           $input['viewers_id']= Auth::guard('api')->id();
          if(Like::create($input)) {
              return response()->json('res',$input);
          }


       }else{
           return response()->json('res','liked');
       }


    }

}
