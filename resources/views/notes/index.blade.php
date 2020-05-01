@extends('layouts.app')
@section('content')
<h1>Notes</h1>
@if(count($notes)>0)
@foreach($notes as $note)
<div class="card card-body bg-light">
    <h3><a href="/notes/{{$note->id}}">{{$note->title}}</a></h3>
    <small>Written on {{$note->created_at}}</small>
</div>
@endforeach

{{$notes->links()}}
@else 
<p>No Notes found</p>
@endif

@endsection