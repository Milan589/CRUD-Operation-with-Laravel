@extends('layouts.backend')
@section('title', 'Brand list')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Brand Management</h1>
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
            <div class="card-header">
                <h3 class="card-title">Brand Tag</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
      
                <table class="table table-bordered">
                    <thead>
                        <tr>

                            <th>Title</th>
                            <td>{{ $data['record']->title }}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>{{ $data['record']->slug }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>@include('backend.includes.status',['status'=> $data['record']->status])</td>
                        </tr>
                        <tr>
                            <th>Created_at</th>
                                <td> {{$data['record']->created_at}}</td> 
                        </tr>
                        <tr>
                            <th>Updated_at</th>
                                <td>{{$data['record']->updated_at}}</td> 
                        </tr>
                    </thead>
                </table>
            </div>
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
