@section('title', $module .' Meta')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Meta Title</th>
                            <td>{{ $data['record']->meta_title }}</td>
                        </tr>
                        <tr>
                            <th>Meta Description</th>
                            <td>{{ $data['record']->meta_description }}</td>
                        </tr>
                        <tr>
                            <th>Created_at</th>
                            <td> {{ $data['record']->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Updated_at</th>
                            <td> {{ $data['record']->updated_at }}</td>
                        </tr>
                        <tr>
                            <th>Created_By</th>

                        <td>
                            {{$data['record']->createdBy->name}}
                        </td>
                        <tr>
                            <th>Updated_By</th>
                            <td>
                                @if(!empty($data['record']->updated_by))
                                    {{ $data['record']->updatedBy->name }}
                                @endif
                            </td>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->

