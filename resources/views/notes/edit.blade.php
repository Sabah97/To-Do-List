@extends('layouts.app')
@section('content')
<h1>Edit Note!</h1>
{!! Form::open(['action' => ['NotesController@update', $note->id], 'method'=>'POST' , 'enctype' =>'multipart/form-data']) !!}
   <div class="form-group">
    {{Form::label('title','Title')}}
    {{Form::text('title',$note->title,['class'=>'form-control', 'placeholder'=>'Title'])}}
</div> 
<div class="form-group">
    {{Form::label('body','Body')}}
    {{Form::textarea('body',$note->body,['id'=>'article-ckeditor', 'class'=>'form-control', 'placeholder'=>'Body Text'])}}
</div>
<div class="form-group">
    {{Form::file('cover_image')}}
</div>
{{Form::hidden('_method', 'PUT')}} 
{{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
{!! Form::close() !!}

@endsection