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
                            <h3>Video Upload</h3>
                        </div>


                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_content">
                                    {!! Form::open(array('method'=>'POST','url'=>'admin/addvideo','class'=>'form-horizontal form-label-left','enctype'=>"multipart/form-data")) !!}

                                    </p>

                                    <div class="item form-group">
                                        {!! Form::label('id-input-file-2','Title',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}

                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            {!! Form::text('title',old('title'),['class'=>'form-control col-md-7 col-xs-12','data-validate-length-range'=>"6",'placeholder'=>'Title','data-validate-words'=>"2",'id'=>'form-field-1','required'=>'required/']) !!}
                                            <br>
                                            <br>
                                            @if ($errors->has('title'))
                                            <strong style="color:indianred;">Something Wrong!</strong>
                                                @endif
                                        </div>
                                        </div>








                                    <div class="item form-group">
                                        {!! Form::label('id-input-file-2','Person Name',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                                        <span class="required">*</span>

                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            {!! Form::text('person',old('person'),['class'=>'form-control col-md-7 col-xs-12','data-validate-length-range'=>"6",'placeholder'=>'Person Name','data-validate-words'=>"2",'id'=>'form-field-1','required'=>'required/']) !!}
                                            <br>
                                            <br>
                                            @if ($errors->has('person'))
                                                <strong style="color:indianred;">Something Wrong!</strong>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="item form-group">
                                        {!! Form::label('id-input-file-2','City',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                                        <span class="required">*</span>

                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            {!! Form::text('city',old('city'),['class'=>'form-control col-md-7 col-xs-12','data-validate-length-range'=>"6",'placeholder'=>'City','data-validate-words'=>"2",'id'=>'form-field-1','required'=>'required/']) !!}
                                            <br>
                                            <br>
                                            @if ($errors->has('city'))
                                                <strong style="color:indianred;">Something Wrong!</strong>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="item form-group">
                                        {!! Form::label('id-input-file-2','State',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                                        <span class="required">*</span>

                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            {!! Form::text('state',old('state'),['class'=>'form-control col-md-7 col-xs-12','data-validate-length-range'=>"6",'placeholder'=>'State','data-validate-words'=>"2",'id'=>'form-field-1','required'=>'required/']) !!}
                                            <br>
                                            <br>
                                            @if ($errors->has('state'))
                                                <strong style="color:indianred;">Something Wrong!</strong>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="item form-group">
                                        {!! Form::label('id-input-file-2','Active',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                                        <span class="required">*</span>

                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            {!! Form::select('active',[true =>'Yes',false=>'No'],true,['class'=>'form-control col-md-7 col-xs-12','data-validate-length-range'=>"6",'data-validate-words'=>"2",'id'=>'form-field-1','required'=>'required/']) !!}
                                            <br>
                                            <br>
                                            @if ($errors->has('active'))
                                                <strong style="color:indianred;">Something Wrong!</strong>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="item form-group">
                                        {!! Form::label('id-input-file-2','Description',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                                        <span class="required">*</span>

                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            {!! Form::textarea('description',null,['rows'=>'5','class'=>'form-control col-md-7 col-xs-12','data-validate-length-range'=>"6",'placeholder'=>'Description','data-validate-words'=>"2",'id'=>'form-field-1','required'=>'required/']) !!}
                                            <br>
                                            <br>
                                            @if ($errors->has('description'))
                                                <strong style="color:indianred;">Something Wrong!</strong>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="item form-group">
                                        {!! Form::label('id-input-file-2','Video',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                                        <span class="required">*</span>

                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            {!!Form::file('video',null,['class'=>'form-control col-md-7 col-xs-12','data-validate-length-range'=>"6",'placeholder'=>'Description','data-validate-words'=>"2",'id'=>'form-field-1','required'=>'required/']) !!}
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        {!! Form::label('id-input-file-2','Thumbnail Image',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                                        <span class="required">*</span>

                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            {!!Form::file('image',null,['class'=>'form-control col-md-7 col-xs-12','data-validate-length-range'=>"6",'placeholder'=>'Thumbnail','data-validate-words'=>"2",'id'=>'form-field-1','required'=>'required/']) !!}
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
