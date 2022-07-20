<div class="form-group">
    {{-- <label for="">Category ID:</label> --}}
    {!! Form::label('category_id','Category ID') !!}
    {!! Form::select('category_id',$data['categories'],null,['class'=>'form-control']) !!}
    {{-- <select name="category_id" id="category_id" @class('form-control')>
        <option value="">Select Category</option>
        @foreach ($data['categories'] as $category)
        <option value="{{$category->id}}">{{$category->title}}</option>    
        @endforeach
    </select> --}}
   @include('backend.includes.single_field_error',['field'=>'category_id'])
</div>
<div class="form-group">
    {!! Form::label('title','Title: ') !!}
    {!! Form::text('title',null,['class'=> 'form-control', 'placeholder'=>'Enter title']) !!}
    @include('backend.includes.single_field_error',['field'=>'title'])
</div>
<div class="form-group">
    {!! Form::label('slug','Slug:') !!}
    {!! Form::text('slug',null,['class'=>'form-control','id'=>'slug','placeholder'=>'Enter slug']) !!}
    @include('backend.includes.single_field_error',['field'=>'slug'])
</div>
<div class="form-group">
    <label for="">Status:</label>
    <input type="radio" name="status" id="active" value="1">Active
    <input type="radio" name="status" id="deactive" value="0" checked>Deactive
</div>
<div class="form-group">
    {!! Form::submit($button.' '.$module,['class'=>'btn btn-success']) !!}

</div>