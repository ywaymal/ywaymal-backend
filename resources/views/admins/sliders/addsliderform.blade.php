@extends('layouts.admin')
@section('body')
    <div class="container body">
        <div class="main_container">
        @include('layouts.menu')
        <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Slider Upload</h3>
                        </div>


                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_content">
                                    {!! Form::open(array('method'=>'POST','url'=>'admin/addslider','class'=>'form-horizontal form-label-left','enctype'=>"multipart/form-data")) !!}

                                    </p>

                                    <div class="item form-group">
                                        {!! Form::label('id-input-file-2','Description',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}

                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            {!! Form::text('description',old('description'),['class'=>'form-control col-md-7 col-xs-12','data-validate-length-range'=>"6",'placeholder'=>'Title','data-validate-words'=>"2",'id'=>'form-field-1','required'=>'required/']) !!}
                                            <br>
                                            <br>
                                            @if ($errors->has('description'))
                                                <strong style="color:indianred;">Something Wrong!</strong>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        {!! Form::label('id-input-file-2','Images',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                                        <span class="required">*</span>

                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            {!!Form::file('images',null,['class'=>'form-control col-md-7 col-xs-12','data-validate-length-range'=>"6",'placeholder'=>'File Upload','data-validate-words'=>"2",'id'=>'form-field-1','required'=>'required/']) !!}
                                        </div>
                                    </div>


                                    <div class="item form-group">
                                        {!! Form::label('id-input-file-2','Videos',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                                        <span class="required">*</span>

                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            {!!Form::file('videos',null,['class'=>'form-control col-md-7 col-xs-12','data-validate-length-range'=>"6",'placeholder'=>'File Upload','data-validate-words'=>"2",'id'=>'form-field-1','required'=>'required/']) !!}
                                        </div>
                                    </div>




                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">
                                            <button type="reset" class="btn btn-primary">Cancel</button>
                                            <button id="send" type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}

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
