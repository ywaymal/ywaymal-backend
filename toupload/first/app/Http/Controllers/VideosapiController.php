<?php

namespace App\Http\Controllers;

use App\Socialviewers;
use App\Videos;
use App\News;
use App\Viewer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class VideosapiController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api',['except'=>['register']]);
    }
    public function GetVideos(){
        $videos=Videos::orderBy('id','desc')->get();
        return response()->json($videos);
    }
    public function GetSliders(){
        $sliders=News::where('slider','yes')->orderBy('id','desc')->get();
        return response()->json($sliders);
    }
    public function GetNews(){
        $news=News::where('slider','no')->orderBy('id','desc')->limit(6)->get();
        return response()->json($news);
    }
    public function getnewsdetail($id){
        $news=News::where('id',$id)->first();
        return response()->json($news);
    }
    public function getvideosbyid($id){
        $video=Videos::where('id',$id)->first();
        return response()->json($video);

    }



}
