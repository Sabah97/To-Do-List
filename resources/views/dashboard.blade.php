@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <a href="/notes/create/" class="btn btn-primary"> Write Note! &#x1F913;</a>
                    <h3>Your notes</h3>
                    @if(count($notes)>0)
                    <table class="table table-striped">
                        <tr>
                            <th>Title
                                
                            </th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach($notes as $note)
                        <tr>
                            <td><a href="/notes/{{$note->id}}">{{$note->title}}</a></td>
                            {{-- <h3><a href="/notes/{{$note->id}}">{{$note->title}}</a></h3> --}}
             
                            
                            
                            <td><small>Written on {{$note->created_at}} by {{$note->user->name}}</small>
                                <a href="/notes/{{$note->id}}/edit" class="btn btn-primary"> Edit</a></td>
                            <td>{!!Form::open(['action' =>['NotesController@destroy', $note->id], 'method'=>'POST', 'class' =>'float-right'])!!}
                                {{Form::hidden('_method','DELETE')}}
                                {{Form::submit('Delete',['class'=>"btn btn-danger"])}}
                                {!!Form::close()!!}</td>
                        </tr>
                        @endforeach
                        {{-- {{$notes->links()}} --}}
                        
                    </table>
                    @else
                    <p>No Notes yet &#128580;</p>
                    @endif
                   

                {{-- <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}

                    {{-- You are logged in! --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
