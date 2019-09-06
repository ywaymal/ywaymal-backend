@extends('layouts.admin')
@section('body')
    <div class="container body">
        <div class="main_container">

        @include('layouts.menu')

            <!-- top navigation -->
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    @include('layouts.alert.add_edit_delete')
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Videos List</h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_content">
                                    <p class="text-muted font-13 m-b-30">
                                    </p>
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Upload By</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Active</th>
                                            <th>City </th>
                                            <th>State </th>
                                            <th>Created At </th>
                                            <th> </th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                        @foreach($videos as $vd)
                                        <tr>
                                            <td>{{$vd->id}}</td>
                                            <td>
                                                <?php
                                                $upload_user=\Illuminate\Support\Facades\DB::table('users')->where('id',$vd->uploader_id)->first()->name;

                                                ?>
                                                {{$upload_user}}

                                            </td>
                                            <td>{{str_limit($vd->title,10)}}</td>
                                            <td>{{str_limit($vd->description,20)}}</td>
                                            <td>{{$vd->active}}</td>
                                            <td>{{$vd->city}} </td>
                                            <td>{{$vd->state}}  </td>
                                            <td>{{$vd->created_at}} </td>
                                            <td>
                                                <a href="{{url('admin/videoedit/'.$vd->id)}}" class="btn btn-success btn-xs">Edit</a>
                                                <a href="{{url('admin/videodetail/'.$vd->id)}}" type="button" class="btn btn-info btn-xs">Detail</a>
                                            </td>
                                        </tr>
                                       @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <!-- /page content -->


        </div>
    </div>

@endsection
