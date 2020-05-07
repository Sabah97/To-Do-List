@extends('layouts.app')
@section('content')
<a href="/dashboard" class="btn btn-primary"> Go Back</a>
<hr>
<h1>{{$note->title}}</h1>
<img style="width:100%" src="/storage/cover_images/{{$note->cover_image}}">
<br>

<div>
    {!!$note->body!!}
</div>

<hr>
<small>Written on {{$note->created_at}} by {{$note->user->name}}</small>

<hr>
<a href="/notes/{{$note->id}}/edit" class="btn btn-primary"> Edit</a>
{!!Form::open(['action' =>['NotesController@destroy', $note->id], 'method'=>'POST', 'class' =>'float-right'])!!}
{{Form::hidden('_method','DELETE')}}
{{Form::submit('Delete',['class'=>"btn btn-danger"])}}
{!!Form::close()!!}
@endsection