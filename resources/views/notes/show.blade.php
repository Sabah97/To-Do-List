@extends('layouts.app')
@section('content')
<a href="/notes" class="btn btn-primary"> Go Back</a>
<hr>
<h1>{{$note->title}}</h1>

<div>
    {{$note->body}}
</div>

<hr>
<small>Written on {{$note->created_at}}</small>
@endsection