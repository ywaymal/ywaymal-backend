<?php

namespace App\Http\Controllers;

use App\Like;
use App\Votes;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SocialapiController extends Controller
{
    //
    public function __construct()
    {
//        $this->middleware('auth:api',['except'=>['register']]);real
    }
    public function addvote(Request $request){
       if(Votes::where([['viewers_id','=',$request->viewers_id],['videos_id','=',$request->videos_id]])->count() == 0){
           $input = $request->all();
           $input['created_at'] = Carbon::now();
           $input['updated_at'] = Carbon::now();
//           $input['viewers_id']= Auth::guard('api')->id();
           $input['viewers_id']= 1;
          if(Votes::create($input)) {
              $total_vote_counts= Votes::where('videos_id',$request->videos_id)->count();

              $input['total_vote_count']=$total_vote_counts;

              return response()->json($input);
          }
       }else{
           return response()->json('already voted');
       }


    }
    public function deletevote(Request $request){
         $input = $request->all();

        if(Votes::where([['viewers_id','=',$request->viewers_id],['videos_id','=',$request->videos_id]])->count() == 0){
            return response()->json('deleted');

        }else{
            if(Votes::where([['viewers_id','=',$request->viewers_id],['videos_id','=',$request->videos_id]])->delete()){
                $total_vote_counts= Votes::where('videos_id',$request->videos_id)->count();
                $input['total_vote_count']=$total_vote_counts;


                return response()->json($input);

            }
        }


    }

}
