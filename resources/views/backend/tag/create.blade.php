@extends('layouts.backend')
@section('title', $module .' list')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{$module}} Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{$module}}</li>
                    </ol>
                </div>  
            </div>
                   <!-- Default box -->
        <div class="row">
            <div class="card-header">
                <h3 class="card-title">  Create {{$module}}
                <a href="{{route($base_route .'index')}}" @class("btn btn-success")" >List</a>
            </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            {{-- create form for employee --}}
            {!! Form::open(['route'=> [$base_route .'store'],'method'=>'post']) !!}
            {{-- <form action="{{ route($base_route .'store') }}" method="post"> --}}
                {{-- @csrf --}}
                <div class="form-group">
                  
                {!! Form::label('title','Title: ') !!}
                {!! Form::text('title',null,['class'=> 'form-control', 'placeholder'=>'Enter title']) !!}
                  {{-- <label for="">Title:</label> --}}
                    {{-- <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}"
                        placeholder="Enter title"> --}}
                    @error('title')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {{-- <label for="">Slug:</label> --}}
                    {!! Form::label('slug','Slug:') !!}
                    {!! Form::text('slug',null,['class'=>'form-control','id'=>'slug','placeholder'=>'Enter slug']) !!}
                    {{-- <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}"
                        placeholder="Enter slug"> --}}
                    @error('slug')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {{-- <label for="">Status:</label> --}}
                    {!! Form::label('status','Status: ') !!}
                    {!! Form::radio('status','1',['id'=>'active']) !!}Active
                    {!! Form::radio('status','0',true,['id'=>'deactive']) !!}Deactive
                    {{-- <input type="radio" name="status" id="active" value="1">Active --}}
                    {{-- <input type="radio" name="status" id="deactive" value="0" checked>Deactive --}}
                </div>
                <div class="form-group">
                    {!! Form::submit('Save'.$module,['class'=>'btn btn-success']) !!}
                    {{-- <input type="submit" class="btn btn-success" value="Save {{$module}}"> --}}
                    {!! Form::reset('Reset',['class'=>'btn btn-danger']) !!}
                    {{-- <input type="reset" class="btn btn-danger" value="Reset"> --}}
                </div>
                {!! Form::close() !!}
            {{-- </form> --}}
            <!-- /.card-body -->
            <div class="card-footer">
                Footer
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

        </div><!-- /.container-fluid -->
    </section>



        

@endsection
@section('js')
    <script>
        $("#title").keyup(function() {
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace('/\s/g', '-');
            $("#slug").val(Text);
        });
    </script>
@endsection
