<div class="form-group">
    {{-- <label for="">Category ID:</label> --}}
    {!! Form::label('category_id','Category ID') !!}
    {!! Form::select('category_id',$data['categories'],null,['class'=>'form-control','placeholder'=>'Select Category']) !!}
    {{-- <select name="category_id" id="category_id" @class('form-control')>
        <option value="">Select Category</option>
        @foreach ($data['categories'] as $category)
        <option value="{{$category->id}}">{{$category->title}}</option>    
        @endforeach
    </select> --}}
   @include('backend.includes.single_field_error',['field'=>'category_id'])
</div>
{{-- <div class="form-group">
    {!! Form::label('subcategory_id','Subategory ID') !!}
    {!! Form::select('subcategory_id',$data['subcategories'],null,['class'=>'form-control','placeholder'=>'Select Subategory']) !!}
   @include('backend.includes.single_field_error',['field'=>'subcategory_id'])
</div> --}}
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
    {!! Form::label('price','Price:') !!}
    {!! Form::number('price',null,['class'=>'form-control','id'=>'price']) !!}
    @include('backend.includes.single_field_error',['field'=>'price'])
</div>
<div class="form-group">
    {!! Form::label('discount','Discount:') !!}
    {!! Form::number('discount',null,['class'=>'form-control','id'=>'discount']) !!}
    @include('backend.includes.single_field_error',['field'=>'discount'])
</div>
<div class="form-group">
    {!! Form::label('stock','Stock:') !!}
    {!! Form::number('stock',null,['class'=>'form-control','id'=>'stock']) !!}
    @include('backend.includes.single_field_error',['field'=>'stock'])
</div>
<div class="form-group">
    {!! Form::label('quantity','Quantity:') !!}
    {!! Form::number('quantity',null,['class'=>'form-control','id'=>'quantity']) !!}
    @include('backend.includes.single_field_error',['field'=>'quantity'])
</div>
<div class="form-group">
    {!! Form::label('specification','Specification:') !!}
    {!! Form::textarea('specification',null,['class'=>'form-control','id'=>'specification','rows'=>5]) !!}
    @include('backend.includes.single_field_error',['field'=>'specification'])
</div>
<div class="form-group">
    {!! Form::label('description','Description:') !!}
    {!! Form::textarea('description',null,['class'=>'form-control','id'=>'description','rows'=>5]) !!}
    @include('backend.includes.single_field_error',['field'=>'description'])
</div>
{{-- <div class="form-group">
    {!! Form::label('tag','Tag:') !!}
    {!! Form::select('tag_id[]',$data['tags'],null,['class'=>'form-control','id'=>'tag','placeholder'=>'Select Tag','multiple'=>'multiple']) !!}
</div> --}}
<div class="form-group">
    {!! Form::label('status','Status:') !!}
    {!! Form::radio('status','1',['id'=>'active']) !!}Active
    {!! Form::radio('status','0',true,['id'=>'deactive']) !!}Deactive
</div>
<div class="form-group">
    {!! Form::label('hot_key','Hot Product: ') !!}
    {!! Form::radio('hot_key','1',['id'=>'active']) !!}Active
    {!! Form::radio('hot_key','0',true,['id'=>'deactive']) !!}Deactive
</div>
<div class="form-group">
    {!! Form::label('flash_key','Flash Key: ') !!}
    {!! Form::radio('flash_key','1',['id'=>'active']) !!}Active
    {!! Form::radio('flash_key','0',true,['id'=>'deactive']) !!}Deactive
</div>
{{-- <div class="form-control">
    <textarea name="specification" id="" cols="30" rows="10"></textarea>
</div> --}}
<script src="{{asset('assets/plugins/ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace('specification');
    CKEDITOR.replace('description');
</script>