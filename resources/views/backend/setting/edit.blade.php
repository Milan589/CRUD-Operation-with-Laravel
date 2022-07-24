@extends('layouts.backend')
@section('title', $module . ' Create')
@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <a href="{{ route('backend.setting.index') }}" class="btn btn-info">List {{ $module }}</a>
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Edit {{ $module }}</h3>
                        </div>
                        <div class="card-body">
                            {!! Form::model($data['record'], ['route' => [$base_route . 'update', $data['record']->id], 'method' => 'put', 'files' => true]) !!}
                            @include($base_view . 'includes.main_form', ['button' => 'Update'])
                            {!! Form::close() !!}
                        </div>
                    </div><!-- /.card -->
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->
@endsection
