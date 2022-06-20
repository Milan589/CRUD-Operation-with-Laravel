@extends('layouts.backend')
@section('title', 'Brand')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Brands </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Brand</li>
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
            <form action="{{ route('backend.brand.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Title:</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}"
                        placeholder="Enter title">


                    @error('title')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Slug:</label>
                    <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}"
                        placeholder="Enter slug">
                    @error('slug')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Image:</label>
                    <input type="file" class="form-control" name="image" id="image" value="{{ old('image') }}"
                        placeholder="Enter image">
                </div>
                <div class="form-group">
                    <label for="">Meta_title:</label>
                    <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{ old('meta_title') }}"
                        placeholder="Enter meta_title">
                    @error('meta_title')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Meta_keyword:</label>
                    <input type="text" class="form-control" name="meta_keyword" id="meta_keyword" value="{{ old('meta_keyword') }}"
                        placeholder="Enter meta_keyword">
                    @error('meta_keyword')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Meta_description:</label>
                    <textarea class="form-control" name="meta_description" id="meta_description" value="{{ old('meta_description') }}"
                        placeholder="Enter meta_description"></textarea>
                    @error('meta_description')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Status:</label>
                    <input type="radio" name="status" id="active" value="1">Active
                    <input type="radio" name="status" id="deactive" value="0" checked>Deactive
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary">
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
