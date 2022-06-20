@extends('layouts.backend')
@section('title','Brand list')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Brand</h1>
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
                <h3 class="card-title">List Brand</h3>

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
                @include('backend.includes.flash')
                 <table class="table table-bordered">
                     <thead>
                         <tr>
                             <th>SN</th>
                             <th>Title</th>
                             <th>Slug</th>
                             <th>Rank</th>
                             <th>Status</th>
                             <th>Image</th>
                             <th>Meta title</th>
                             <th>Meta Keyword</th>
                             <th>Meta Description</th>
                             <th>Created By</th>
                             <th>Updated By</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($data['records'] as $record )
                             <tr>
                                 <td>{{$loop -> index +1 }}</td>
                                 <td>{{$record->title}}</td>
                                 <td>{{$record->slug}}</td>
                                 <td>{{$record->rank}}</td>
                                 <td>
                                    @include('backend.includes.status',['status'=>$record->status])
                                 </td>
                                 <td>{{$record->image}}</td>
                                 <td>{{$record->meta_title}}</td>
                                 <td>{{$record->meta_keyword}}</td>
                                 <td>{{$record->meta_description}}</td>
                                 
                                 {{-- <td>{{$record->created_by}}</td> --}}
                                 <td>
                                     {{$record->createdBy->name}}
                                     {{-- {{\App\Models\User::find($record->created_by)->name}} --}}
                                 </td>
                                 <td>{{$record->updated_by}}</td>
                                 <td>
                                     <a href="{{route('backend.brand.show', $record->id)}}" class="btn btn-primary">View</a>
                                 </td>
                             </tr> 
                         @endforeach
                     </tbody>
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
