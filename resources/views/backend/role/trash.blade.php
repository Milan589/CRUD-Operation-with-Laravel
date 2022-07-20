@extends('layouts.backend')
@section('title', $module . ' List')
@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
@endsection
@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <a href="{{ route('backend.role.create') }}" class="btn btn-info">Create {{ $module }}</a>
                    <a href="{{ route('backend.role.index') }}" class="btn btn-danger">List {{ $module }}</a>
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h5 class="card-title">List {{ $module }}</h5>
                            <br>
                            @include('backend.common.flash_message')
                            <table class="table-bordered table" id="ecommerce1">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Name</th>
                                        <th>Key</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @foreach ($data['records'] as $record)
                                    <tbody>
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $record->name }}</td>
                                            <td>{{ $record->key }}</td>
                                            <td>
                                                @if ($record->status == 1)
                                                    <span class="text-success">Active</span>
                                                @else
                                                    <span class="text-danger">Deactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route($base_route . 'restore', $record->id) }}"
                                                    method="post" style="display: inline-block">
                                                    @csrf
                                                    <input type="submit" value="Restore" class='btn btn-success'>
                                                </form>
                                                <form action="{{ route($base_route . 'force_delete', $record->id) }}"
                                                    method="post" style="display: inline-block">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="submit" value="Delete" class='btn btn-danger'>
                                                </form>
                                            </td>
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /.card -->
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#ecommerce1').DataTable({
                "paging": true,
                "ordering": true,
                "info": true
            });

        });
    </script>
@endsection
