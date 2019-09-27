@extends('layouts.admin')
@section('body')
    <div class="container body">
        <div class="main_container">
        @include('layouts.menu')
        <!-- page content -->
            <div class="right_col" role="main">
                @include('layouts.alert.add_edit_delete')

                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Video Detail </h3>
                        </div>

                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Video Detail</h2>

                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <div class="product-image">
                                            <video width="320" height="240" controls>
                                                <source src="{{url('backend/admin/videos/'.$video->link)}}"
                                                        type="{{$video->video_type}}">
                                            </video>
                                        </div>
                                        @if($video->image !== '')
                                            <div class="product-image">
                                                <image width="320" height="240"
                                                       src="{{url('backend/admin/videos/images/'.$video->image)}}"/>
                                            </div>
                                        @endif

                                    </div>

                                    <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">

                                        <h3 class="prod_title">{{$video->title}}</h3>

                                        <p> {{$video->description}}</p>
                                        <br/>
                                        <p>City: {{$video->city}}</p>
                                        <br/>

                                        <p>State: {{$video->state}}</p>
                                        <br/>
                                        <p>Person: {{$video->person}}</p>

                                        <br/>
                                        <p>Created_at: {{$video->created_at}}</p>

                                        <br/>

                                        <div class="">
                                            @if($video->active == 1)

                                                <ul class="list-inline prod_color">
                                                    <li>
                                                        <p>Active</p>
                                                        <div class="color bg-green"></div>
                                                    </li>
                                                </ul>
                                            @else
                                                <ul class="list-inline prod_color">
                                                    <li>
                                                        <p>Deactive</p>
                                                        <div class="color bg-red"></div>
                                                    </li>
                                                </ul>
                                            @endif
                                        </div>
                                        <br/>


                                    </div>
                                    <div class="col-md-4">


                                    </div>
                                    <div class="col-md-4">


                                    </div>

                                    <div class="col-md-4">


                                        <form id="delete_form" action="{{ url('admin/deletevideo/') }}" method="POST"
                                              style="display: none;">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$video->id}}"/>
                                        </form>
                                        <button onclick="Delete()" type="submit" class="btn btn-danger">Delete</button>
                                        <a type="submit" href="{{url('admin/videoedit/'.$video->id)}}"
                                           class="btn btn-success">Edit</a>


                                        <script>
                                            function Delete() {
                                                if (confirm('Are you sure want to delete this video')) {
                                                    document.getElementById('delete_form').submit();
                                                }
                                            }


                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->

            <!-- footer content -->

            <!-- /footer content -->
        </div>
    </div>

@endsection
