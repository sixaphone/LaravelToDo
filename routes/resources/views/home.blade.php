@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default ">
                <div class="panel-heading text-center">{{Auth::user()->username}}'s ToDos</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1 class="text-center">{{auth()->user()->firstname}} {{auth()->user()->lastname}}</h1>
                        <div class="container-fluid text-center">
                         <div class="btn-group">
                            <a href="/tasks/create"><button type="button" class="btn btn-primary">Add New Task</button></a>
                            <a href="/tasks/filter/date"><button type="button" class="btn btn-primary">Order By Date</button></a>
                            <a href="/tasks/filter/urgency"><button type="button" class="btn btn-primary">Order By Importance</button></a>
                            <a href="/tasks/finished/get"><button type="button" class="btn btn-primary">Show Finished Tasks</button></a>
                        </div> 
                        <h2>Filter by Urgency</h2>
                        <br>
                        <div class="btn-group">
                            <a href="/tasks/"><button type="button" class="btn btn-default">All of it</button></a>
                        
                            <a href="/tasks/get/1"><button type="button" class="btn" style="color:white;background-color:#f1c40f;">Just To Remember</button></a>
                            <a href="/tasks/get/2"><button type="button" class="btn btn-success">Kinda Important</button></a>
                            <a href="/tasks/get/3"><button type="button" class="btn btn-primary">Should do</button></a>
                            <a href="/tasks/get/4"><button type="button" class="btn" style="color:white; background-color:#f39c12;">Really important</button></a>
                            <a href="/tasks/get/5"><button type="button" class="btn btn-danger">Top on my List</button></a>
                        </div> 
                        </div> 
                    <br>                    
                    @if(count($tasks)>0)
                        @foreach ($tasks as $task )
                                <div class="well">
                            <a href="/tasks/{{$task->id}}" style="text-decoration:none; color:#aaaaaa;">
                                    <h3>{{$task->task}}</h3>
                                    <div class="btn pull-right" style="border:2px solid {{$task->color}};color:{{$task->color}};background-color:white;"> {{$task->desc}}</div>
                                    <small style="color:#d2d2d2;">Created at: {{$task->created_at}} </small>
                            </a>
                            @if(!$task->finished)
                                    <button onclick="confirm(this)" type="button" class="btn btn-success pull-right" data-value="{{$task->id}}" style="margin-right:10px;">Mark Finished</button>
                                    <a href="/tasks/complete/{{$task->id}}" class="btn btn-success pull-right hidden" id="markFinished{{$task->id}}" style="margin-right:10px;"> Click Again If you are sure</a>                                    
                                    <a href="/tasks/{{$task->id}}/edit" class="btn btn-default pull-right" style="margin-right:10px;"> Edit</a>                                    
                                  @endif  
                                </div>
                        @endforeach
                        <div class="text-center">
                             {{$tasks->links()}}
                        </div>
                    @else
                        <h2>You are taskless</h2>
                    @endif
                </div>      
            </div>
        </div>
    </div>
</div>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    
    function confirm(e){
        e.style.visibility = "hidden";
        e.style.display = "none";
        $("#markFinished"+e.getAttribute('data-value')).removeClass('hidden');
    }
</script>
@endsection
