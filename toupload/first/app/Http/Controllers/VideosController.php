<?php

namespace App\Http\Controllers;

use App\Videos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class VideosController extends Controller
{
//    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AddVideoform()
    {
        return view('admins.addvideoform');
    }

    public function VideosList()
    {
        //showing video list page
        $videos = Videos::orderBy('created_at', 'desc')->get();
        return view('admins.videoslist', ['videos' => $videos]);
    }

    public function VideoDetail($id)
    {
        //detail page of video
        $video = Videos::where('id', $id)->first();
        return view('admins.videodetail', ['video' => $video]);
    }

    public function DeleteVideo(Request $request)
    {
        //delete data
        $video = Videos::find($request->id);

        $video_file = 'backend/admin/videos/' . $video->link;
        if (File::exists($video_file, $video->link)) {
            //if file exists
            File::delete($video_file, $video->link);
            //delete this file
            if ($video->delete()) {
                Session::flash('Deleted', 'Video was Successfully deleted');

                return redirect('admin/videoslist');
            }
        }
    }

    public function VideoEdit($id)
    {

        $video = Videos::where('id', $id)->first();
        return view('admins.videoedit', ['video' => $video]);
    }

    public function VideoEditSave(Request $request, $id)
    {
        $validator = Validator::make($request->all(), ['title' => 'required|min:5|max:120', 'description' => 'required|min:10|max:2000', 'active' => 'required|boolean',
            'video' => 'mimetypes:video/x-fl,video/mp4,video/x-ms-asf,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv', 'person' => 'required|min:3|max:100', 'city' => 'required|min:4|max:100', 'state' => 'required|min:4|max:1000']);

        if ($validator->fails()) {
            //if fail redirect back with errors and old data
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input = $request->except(['_token', 'video']);
        $old_data = Videos::where('id', $id)->first();

        if ($request->file('video') == null) {
            //if use did not set new video we take this user old video link
            $input['link'] = $old_data->link;
            $input['video_type'] = $old_data->video_type;


        } else {
            //if user has new video input
            if (File::exists('backend/admin/videos/', $old_data->link)) {
                //if file exists
                File::delete('backend/admin/videos/', $old_data->link);
            }
            $video = Carbon::now()->timestamp . $request->file('video')->getClientOriginalName();//create video name
            $request->file('video')->move(base_path() . '/public/backend/admin/videos', $video);//store video in public folder
            $input['link'] = $video;
            $input['video_type'] = $request->file('video')->getClientMimeType();

        }
        $input['updated_at'] = Carbon::now();

        $input['uploader_id'] = Auth::user()->id;
        if (Videos::where('id', $id)->update($input)) {
            Session::flash('Updated', 'Video was Successfully updated');
            return redirect('admin/videodetail/' . $id);
        } else {
            return 'error';
        }
    }

    public function SaveVideo(Request $request)
    {
// check all input data
        $validator = Validator::make($request->all(), ['title' => 'required|min:5|max:120', 'description' => 'required|min:10|max:2000', 'active' => 'required|boolean',
            'video' => 'required|mimetypes:video/x-fl,video/mp4,video/x-ms-asf,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv', 'person' => 'required|min:3|max:100', 'city' => 'required|min:4|max:100', 'state' => 'required|min:4|max:1000']);

        if ($validator->fails()) {
            //if fail redirect back with errors and old data
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input = $request->except('_token');
        $input['created_at'] = Carbon::now();
        $input['updated_at'] = Carbon::now();
        $video = Carbon::now()->timestamp . $request->file('video')->getClientOriginalName();//create video name
        $request->file('video')->move(base_path() . '/public/backend/admin/videos', $video);//store video in public folder
        $input['link'] = $video;
        $input['video_type'] = $request->file('video')->getClientMimeType();
        $input['uploader_id'] = Auth::user()->id;
        if (Videos::create($input)) {
            Session::flash('Added', 'Video was Successfully added');
            return redirect('admin/videoslist');
        }
    }
}
