@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default form-group" style="padding:30px;">
                 <h1> The Task</h1>
                 <h2> {{$task->task}}</h2>
                 <hr>
                 <h1>The Urgency</h1>
                 <br>
                 <div class="btn btn-urgency" style="border:1px solid {{$task->color}}; color:{{$task->color}}; background-color:white;">{{$task->desc}}</div>
                 <br>
                 <hr>

                 @if(auth()->user()->id == $task->user_id && !$task->finished)
                    <a href="/tasks/{{$task->id}}/edit" class="btn btn-primary pull-left" style="margin:0 5px 0 0 ;">Edit Task</a>
                    <form action="/tasks/{{$task->id}}" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="submit" class="btn btn-danger" style="margin:0 0 0 5px;" value="Remove Task">
                    </form>
                 @endif
            </div>
        </div>
    </div>
</div>
  
@endsection









