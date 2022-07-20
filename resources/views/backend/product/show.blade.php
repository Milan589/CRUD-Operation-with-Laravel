@extends('layouts.backend')
@section('title', $module . ' Basic_info')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
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
    </div><!-- /.container-fluid -->
</section>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <a href="{{ route('backend.product.index') }}" class="btn btn-info">List {{ $module }}</a>
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="row mt-4">
                                <nav class="w-100">
                                    <div class="nav nav-tabs" id="product-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="product-basic-tab" data-toggle="tab"
                                            href="#basic_tab" role="tab" aria-controls="product-desc"
                                            aria-selected="true">Basic Product Details</a>
                                        <a class="nav-item nav-link" id="product-meta-tab" data-toggle="tab"
                                            href="#meta_tab" role="tab" aria-controls="product-comments"
                                            aria-selected="false">Meta Information</a>
                                        <a class="nav-item nav-link" id="product-image-tab" data-toggle="tab"
                                            href="#image_tab" role="tab" aria-controls="product-rating"
                                            aria-selected="false">Images</a>
                                        {{-- <a class="nav-item nav-link" id="product-tag-tab" data-toggle="tab" href="#tag_tab" role="tab" aria-controls="product-rating" aria-selected="false">Tag</a> --}}
                                        <a class="nav-item nav-link" id="product-attribute-tab" data-toggle="tab"
                                            href="#attribute_tab" role="tab" aria-controls="product-rating"
                                            aria-selected="false">Attribute</a>
                                    </div>
                                </nav>
                                <div class="tab-content p-3" id="nav-tabContent">
                                    <div class="tab-pane fade active show" id="basic_tab" role="tabpanel"
                                        aria-labelledby="product-desc-tab">
                                        @include('backend.product.shows.basic_info')
                                    </div>
                                    <div class="tab-pane fade" id="meta_tab" role="tabpanel"
                                        aria-labelledby="product-desc-tab">
                                        @include('backend.product.shows.meta')
                                    </div>
                                    <div class="tab-pane fade" id="image_tab" role="tabpanel"
                                        aria-labelledby="product-desc-tab">
                                        @include('backend.product.shows.image')
                                    </div>
                                    {{-- <div class="tab-pane fade" id="tag_tab" role="tabpanel" aria-labelledby="product-desc-tab">
                                        @include('backend.product.shows.tag')
                                    </div> --}}
                                    <div class="tab-pane fade" id="attribute_tab" role="tabpanel"
                                        aria-labelledby="product-desc-tab">
                                        @include('backend.product.shows.attribute')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
            <div class="card-footer">
                Footer
            </div>
            <!-- /.card-footer-->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
