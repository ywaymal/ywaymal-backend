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
                            <h3>Slider Detail </h3>
                        </div>

                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Slider Detail</h2>

                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <div class="product-image">
                                            @if(preg_match('/video/',$news->video_type))
                                                <video width="320" height="240" controls>
                                                    <source src="{{url('backend/admin/news/'.$news->file)}}"
                                                            type="{{$news->video_type}}">
                                                </video>
                                            @else
                                                <div class="col-md-7 col-sm-7 col-xs-12">
                                                    <div class="product-image">
                                                        <img src="{{url('backend/admin/news/'.$news->file)}}" alt="...">
                                                    </div>

                                                </div>


                                            @endif
                                        </div>

                                    </div>

                                    <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">

                                        <h3 class="prod_title">{{$news->title}}</h3>

                                        <p> {{$news->link}}</p>
                                        <br/>


                                        <br/>
                                        <p>Created_at: {{$news->created_at}}</p>

                                        <br/>

                                        <br/>


                                    </div>
                                    <div class="col-md-4">


                                    </div>
                                    <div class="col-md-4">


                                    </div>

                                    <div class="col-md-4">


                                        <form id="delete_form" action="{{ url('admin/deleteslider/') }}" method="POST"
                                              style="display: none;">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$news->id}}"/>
                                        </form>
                                        <button onclick="Delete()" type="submit" class="btn btn-danger">Delete</button>
                                        <a type="submit" href="{{url('admin/slideredit/'.$news->id)}}"
                                           class="btn btn-success">Edit</a>


                                        <script>
                                            function Delete() {
                                                if (confirm('Are you sure want to delete this Slide')) {
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
