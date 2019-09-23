<?php

namespace App\Http\Controllers;

use App\Like;
use App\Videocomments;
use App\Votes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocialapiController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api',['except'=>['register']]);
    }

    public function addvote(Request $request)
    {
        if (Votes::where([['viewers_id', '=',  Auth::guard('api')->id()], ['videos_id', '=', $request->videos_id]])->count() == 0) {
            $input = $request->all();
            $input['created_at'] = Carbon::now();
            $input['updated_at'] = Carbon::now();
            $input['viewers_id']= Auth::guard('api')->id();
            if (Votes::create($input)) {
                $total_vote_counts = Votes::where('videos_id', $request->videos_id)->count();

                $input['total_vote_count'] = $total_vote_counts;

                return response()->json($input);
            }
        } else {
            return response()->json('already voted');
        }


    }

    public function deletevote(Request $request)
    {
        $input = $request->all();

        if (Votes::where([['viewers_id', '=', Auth::guard('api')->id()], ['videos_id', '=', $request->videos_id]])->count() == 0) {
            return response()->json('deleted');

        } else {
            if (Votes::where([['viewers_id', '=', Auth::guard('api')->id()], ['videos_id', '=', $request->videos_id]])->delete()) {
                $total_vote_counts = Votes::where('videos_id', $request->videos_id)->count();
                $input['total_vote_count'] = $total_vote_counts;


                return response()->json($input);

            }
        }


    }

    public function addvideocomments(Request $request)
    {
        if (Videocomments::where([['viewers_id', '=', Auth::guard('api')->id()], ['videos_id', '=', $request->videos_id]])->count() < 100) {
            $input = $request->all();
            $input['created_at'] = Carbon::now();
            $input['updated_at'] = Carbon::now();
//           $input['viewers_id']= Auth::guard('api')->id();
            $input['viewers_id'] = 1;
            $current_data=Videocomments::create($input);
            if ($current_data) {
                $current_cmt=Videocomments::where('id',$current_data->id)->first();
                $total_cmd_counts = Videocomments::where('videos_id', $request->videos_id)->count();

                $input['total_cmd_count'] = $total_cmd_counts;

                return response()->json($current_cmt);
            }

        } else {
            return response()->json('Too many comments');
        }

    }

    public function getallcomments(Request $request)
    {
     $all=Videocomments::where('videos_id',$request->videos_id)->get();
     return response()->json($all);


    }

    public function deletevideocomments(Request $request)
    {
        $input = $request->all();
        if (Videocomments::where([['viewers_id', '=', Auth::guard('api')->id()], ['videos_id', '=', $request->videos_id]])->count() == 0) {
            return response()->json('deleted');

        } else {
            if (Videocomments::where([['viewers_id', '=', Auth::guard('api')->id()], ['videos_id', '=', $request->videos_id]])->delete()) {
                $total_cmd_counts = Videocomments::where('videos_id', $request->videos_id)->count();
                $input['total_cmd_count'] = $total_cmd_counts;


                return response()->json($input);

            }
        }


    }
}
