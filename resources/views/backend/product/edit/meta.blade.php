<div class="form-group">
    {!! Form::label('meta_title','Meta Title: ') !!}
    {!! Form::text('meta_title',null,['class'=>'form-control', 'placeholder'=>'Enter Meta title']) !!}
    @include('backend.includes.single_field_error',['field'=>'meta_title'])
</div>
<div class="form-group">
    {!! Form::label('meta_description','Meta Description:') !!}
    {!! Form::text('meta_description',null,['class'=>'form-control','id'=>'meta_description','placeholder'=>'Enter Meta Description']) !!}
    @include('backend.includes.single_field_error',['field'=>'meta_description'])
</div>