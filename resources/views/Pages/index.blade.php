@extends('layouts.app')
@section('content')
    
<div class="jumbotron text-center">
<h1>{{$title}}</h1>
<p>Here you can save things up!</p>
<p><a class="btn btn-primary btn-lg" href="/login" role="button">Login</a> <a class="btn btn-success" href="/register" role="button">Register</a></p>
@endsection
