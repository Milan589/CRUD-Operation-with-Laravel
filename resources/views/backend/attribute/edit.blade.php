@extends('layouts.backend')
@section('title', $module .' Edit')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{$module}} Update</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{$module}}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            {{-- create form for employee --}}
            <form action="{{ route($base_route .'update',$data['record']->id) }}" method="post">
                @method('put')
                @csrf
                <div class="form-group">
                    <label for="">Name:</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $data['record']->name }}"
                        placeholder="Enter name">
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Status:</label>
                    @if ($data['record']->status == 1)
                        <input type="radio" name="status" id="active" value="1" checked>Active
                        <input type="radio" name="status" id="deactive" value="0" >Deactive
                    @else
                        <input type="radio" name="status" id="active" value="1" >Active
                        <input type="radio" name="status" id="deactive" value="0" checked>Deactive
                    @endif
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Update {{$module}}">
                    <input type="reset" class="btn btn-danger" value="Reset">
                </div>

            </form>
            <!-- /.card-body -->
            <div class="card-footer">
                Footer
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection
