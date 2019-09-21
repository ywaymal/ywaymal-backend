<?php

namespace App\Http\Controllers;

use App\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function NewsDetail($id)
    {
        //detail page of video
        $news = News::where('id', $id)->first();
        return view('admins.news.newsdetail', ['news' => $news]);
    }

    public function NewsList()
    {
        //showing video list page
        $news = News::where('slider','no')->orderBy('created_at', 'desc')->get();
        return view('admins.news.newslist', ['news' => $news]);
    }

    public function NewsEdit($id)
    {

        $news = News::where('id', $id)->first();
        return view('admins.news.newsedit', ['news' => $news]);
    }

    public function NewsEditSave(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
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
            $input['title']='';

        }
        $input['updated_at'] = Carbon::now();

        $input['uploader_id'] = Auth::user()->id;
        if (News::where('id', $id)->update($input)) {
            Session::flash('Updated', 'News was Successfully updated');
            return redirect('admin/newsdetail/' . $id);
        } else {
            return 'error';
        }
    }

    public function DeleteNews(Request $request)
    {
        //delete data
        $news = News::find($request->id);

        $files = 'backend/admin/news/' . $news->file;
        if (File::exists($files, $news->file)) {
            //if file exists
            File::delete($files, $news->file);
            //delete this file
            if ($news->delete()) {
                Session::flash('Deleted', 'News was Successfully deleted');

                return redirect('admin/newslist');
            }

        }
    }

    public function AddNewsform()
    {
        return view('admins.news.addnewsform');
    }

    public function SaveNews(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimetypes:image/jpeg,video/x-fl,video/mp4,video/x-ms-asf,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv']);

        if ($validator->fails()) {
            //if fail redirect back with errors and old data
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $input = $request->except('_token');
            $input['created_at'] = Carbon::now();
            $input['updated_at'] = Carbon::now();
            $input['uploader_id'] = Auth::user()->id;
            $input['title']='';
            $file = Carbon::now()->timestamp . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(base_path() . '/public/backend/admin/news', $file);
            $input['file'] = $file;
            $input['slider'] = 'no';
            $input['file_type'] = $request->file('file')->getClientOriginalName();
            if (News::create($input)) {
                Session::flash('Added', 'News was Successfully added');
                return redirect('admin/newslist');
            }
        }
    }
}
