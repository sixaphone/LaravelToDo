@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default form-group" style="padding:30px;">
                    <form action='/tasks/{{$task->id}}'  method="POST" class="form-group">
                    <input type="hidden" value="{{$task->urgency}}" id="oldU">
                    <input type="hidden" value="{{$task->color}}" id="oldC">
                    <input type="hidden" value="PUT" name="_method" id="oldC">
                    {{csrf_field()}}
                    <h1>Update your taks</h1><br>
                    <div class="from-group">
                         <input class="form-control" style="width:96%;" placeholder="Your To Do Task Here..." value="{{$task->task}}" type="text" name="task">     
                    </div>
                    <br>    
                    <h3>How important is this task</h3><br>
                        <div class="text-center form-check form-check-inline">
                            <label class="important" class="form-check-label" id="l1" for="u1" onclick="changeColor(this,'#f1c40f')">Just To remember
                                <input type="radio" name="urgency" class="form-check-input" value="1" style="visibility:hidden;" id="u1">
                            </label>

                            <label class="important" for="u2" class="form-check-label" id="l2" onclick="changeColor(this,'#2ecc71')">Kinda important
                                <input type="radio" name="urgency" class="form-check-input" value="2" style="visibility:hidden;" id="u2">
                            </label>

                            <label class="important" for="u3" class="form-check-label" id="l3" onclick="changeColor(this,'#3498db')">Should do
                                <input type="radio" name="urgency" class="form-check-input" value="3" style="visibility:hidden;" id="u3">
                            </label>

                            <label class="important" for="u4" class="form-check-label" id="l4" onclick="changeColor(this,'#f39c12')">Really important
                                <input type="radio" name="urgency" class="form-check-input" value="4" style="visibility:hidden;" id="u4">
                            </label>

                            <label class="important" for="u5" class="form-check-label" id="l5" onclick="changeColor(this,'#c0392b')">Top on my list
                                <input type="radio" name="urgency"  class="form-check-input" value="5" style="visibility:hidden;" id="u5">
                            </label>
                        </div>
                        <br>
                        <div class="from-group pull-left">
                            <input type="submit" class="btn btn-primary" name="submit" value="Update Tasks">
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
var marked =  document.getElementsByClassName("important");
var idLabel = document.getElementById('oldU').value-1;
marked[idLabel].style.background = document.getElementById('oldC').value;
document.getElementById("u"+marked[idLabel].id.substr(1,2)).setAttribute("checked",true);



    function changeColor(e,color){
        var labels = document.getElementsByClassName("important");
        for(var i = 0 ; i<labels.length;i++){
           labels[i].style.background =  "white";             
        }
       e.style.background =  color;
       }

</script>

@endsection









