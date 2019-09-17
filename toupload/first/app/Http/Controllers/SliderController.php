<?php

namespace App\Http\Controllers;

use App\News;
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
        $news = News::where('id', $id)->first();
        return view('admins.sliders.sliderdetail', ['news' => $news]);
    }

    public function SlidersList()
    {
        //showing video list page
        $news = News::where('slider', 'yes')->orderBy('created_at', 'desc')->get();
        return view('admins.sliders.sliderslist', ['news' => $news]);
    }

    public function SliderEdit($id)
    {

        $news = News::where('id', $id)->first();
        return view('admins.sliders.slideredit', ['news' => $news]);
    }

    public function SliderEditSave(Request $request, $id)
    {
        $validator = Validator::make($request->all(), ['title' => 'required|min:5|max:120', 'link' => 'min:10|max:2000',
            'file' => 'mimetypes:image/jpeg,video/x-fl,video/mp4,video/x-ms-asf,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv']);
        if ($validator->fails()) {
            //if fail redirect back with errors and old data
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->except(['_token', 'file']);
        $old_data = News::where('id', $id)->first();
        if ($request->file('file') == null) {
            //if use did not set new video we take this user old video link
            $input['file'] = $old_data->file;
            $input['file_type'] = $old_data->file_type;
        } else {
            //if user has new video input
            if (File::exists('backend/admin/news/', $old_data->file)) {
                //if file exists
                File::delete('backend/admin/news/', $old_data->file);
            }
            $file = Carbon::now()->timestamp . $request->file('file')->getClientOriginalName();//create file name
            $request->file('file')->move(base_path() . '/public/backend/admin/news', $file);//store video in public folder
            $input['file'] = $file;
            $input['file_type'] = $request->file('file')->getClientMimeType();

        }
        $input['updated_at'] = Carbon::now();

        $input['uploader_id'] = Auth::user()->id;
        if (News::where('id', $id)->update($input)) {
            Session::flash('Updated', 'Slider was Successfully updated');
            return redirect('admin/sliderdetail/' . $id);
        } else {
            return 'error';
        }
    }

    public function DeleteSlider(Request $request)
    {
        //delete data
        $news = News::find($request->id);

        $files = 'backend/admin/news/' . $news->file;
        if (File::exists($files, $news->file)) {
            //if file exists
            File::delete($files, $news->file);
            //delete this file
            if ($news->delete()) {
                Session::flash('Deleted', 'Slider was Successfully deleted');

                return redirect('admin/sliderslist');
            }

        }
    }

    public function AddSliderform()
    {
        return view('admins.sliders.addsliderform');
    }

    public function SaveSlider(Request $request)
    {
        $validator = Validator::make($request->all(), ['title' => 'required|min:5|max:120',
            'file' => 'required|mimetypes:image/jpeg,video/x-fl,video/mp4,video/x-ms-asf,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv']);

        if ($validator->fails()) {
            //if fail redirect back with errors and old data
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $input = $request->except('_token');
            $input['created_at'] = Carbon::now();
            $input['updated_at'] = Carbon::now();
            $input['uploader_id'] = Auth::user()->id;

            $file = Carbon::now()->timestamp . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(base_path() . '/public/backend/admin/news', $file);
            $input['file'] = $file;
            $input['slider'] = 'yes';
            $input['file_type'] = $request->file('file')->getClientMimeType();
            if (News::create($input)) {
                Session::flash('Added', 'Slider was Successfully added');
                return redirect('admin/sliderslist');
            }

        }
    }
}
