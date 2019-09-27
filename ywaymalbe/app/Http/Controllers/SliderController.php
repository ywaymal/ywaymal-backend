<?php

namespace App\Http\Controllers;

use App\News;
use App\Sliders;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function SliderDetail($id)
    {
        //detail page of video
        $slider = Sliders::where('id', $id)->first();
        return view('admins.sliders.sliderdetail', ['slider' => $slider]);
    }

    public function SlidersList()
    {
        //showing video list page
        $sliders = Sliders::orderBy('created_at', 'desc')->get();
        return view('admins.sliders.sliderslist', ['sliders' => $sliders]);
    }

    public function SliderEdit($id)
    {

        $slider = Sliders::where('id', $id)->first();
        return view('admins.sliders.slideredit', ['slider' => $slider]);
    }

    public function SliderEditSave(Request $request, $id)
    {
        $validator = Validator::make($request->all(), ['images'=>'mimetypes:image/jpeg','description'=>'min:5|max:2000',
            'videos' => 'mimetypes:video/x-fl,video/mp4,video/x-ms-asf,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv']);

        if ($validator->fails()) {
            //if fail redirect back with errors and old data
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->except(['_token', 'images','videos']);
        $old_data = Sliders::where('id', $id)->first();
        if ($request->file('videos') == null) {
            //if use did not set new video we take this user old video link
            $input['videos'] = $old_data->videos;
            $input['videos_type'] = $old_data->videos_type;
        } else {
            //if user has new video input
            if (File::exists('backend/admin/news/', $old_data->videos)) {
                //if file exists
                File::delete('backend/admin/news/', $old_data->videos);
            }
            $videos = Carbon::now()->timestamp . $request->file('videos')->getClientOriginalName();//create file name
            $request->file('videos')->move(base_path() . '/public/backend/admin/news', $videos);//store video in public folder
            $input['videos'] = $videos;
            $input['videos_type'] = $request->file('videos')->getClientMimeType();

        }



        if ($request->file('images') == null) {
            //if use did not set new video we take this user old video link
            $input['images'] = $old_data->images;
        } else {
            //if user has new video input
            if (File::exists('backend/admin/news/', $old_data->images)) {
                //if file exists
                File::delete('backend/admin/news/', $old_data->images);
            }
            $images = Carbon::now()->timestamp . $request->file('images')->getClientOriginalName();//create file name
            $request->file('images')->move(base_path() . '/public/backend/admin/news', $images);//store video in public folder
            $input['images'] = $images;

        }


        $input['updated_at'] = Carbon::now();

        $input['uploader_id'] = Auth::user()->id;
        if (Sliders::where('id', $id)->update($input)) {
            Session::flash('Updated', 'Slider was Successfully updated');
            return redirect('admin/sliderdetail/' . $id);
        } else {
            return 'error';
        }
    }

    public function DeleteSlider(Request $request)
    {
        //delete data
        $slider = Sliders::find($request->id);

        $images = 'backend/admin/news/' ;
        $videos ='backend/admin/news/';
        if (File::exists($images, $slider->images)) {
            if(File::exists($videos,$slider->videos)) {
                //if file exists
                File::delete($images, $slider->images);
                File::delete($videos,$slider->videos);
                //delete this file
                if ($slider->delete()) {
                    Session::flash('Deleted', 'Slider was Successfully deleted');
                    return redirect('admin/sliderslist');
                }
            }

        }
    }

    public function AddSliderform()
    {
        return view('admins.sliders.addsliderform');
    }

    public function SaveSlider(Request $request)
    {
        $validator = Validator::make($request->all(), ['images'=>'required|mimetypes:image/jpeg','description'=>'required|min:5|max:2000',
            'videos' => 'required|mimetypes:video/x-fl,video/mp4,video/x-ms-asf,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv']);

        if ($validator->fails()) {
            //if fail redirect back with errors and old data
//            return redirect()->back()->withErrors($validator)->withInput();
            return dd($validator->errors());
        } else {
            $input = $request->except('_token');
            $input['created_at'] = Carbon::now();
            $input['updated_at'] = Carbon::now();
            $input['uploader_id'] = Auth::user()->id;
            //for images
            $images = Carbon::now()->timestamp . $request->file('images')->getClientOriginalName();
            $request->file('images')->move(base_path() . '/public/backend/admin/news', $images);

            $input['images'] = $images;
            //end for images

            //for videos

            $videos = Carbon::now()->timestamp . $request->file('videos')->getClientOriginalName();
            $request->file('videos')->move(base_path() . '/public/backend/admin/news', $videos);

            $input['videos'] = $videos;
            //end for videos

            $input['videos_type'] = $request->file('videos')->getClientMimeType();
            if (Sliders::create($input)) {
                Session::flash('Added', 'Slider was Successfully added');
                return redirect('admin/sliderslist');
            }

        }
    }
}
