<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Task;

class TasksController extends Controller
{
    /**
     * This does not allow the user to access his tasks until he logs in or registers
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::where('user_id',auth()->user()->id)->where('finished',false)->where('deleted',false)->orderBy('urgency','desc')->paginate(5);
        return view('home')->with('tasks',$tasks);
    }

    /**
     * Filter the tasks by urgency or by date created
     * 
     * @param $column is a optional param set to urgency which if is date will order by date created 
     *          else it wil be ordered by urgency
     * @param $col is the name of the column by which to sort the query, it is by default urgency but if the url sends date
     *          it will be set to created_at  
     * @return \Illuminte\Http\Response
     */
    public function filter($column){
        $col = "urgency";
        if($column == "date")
            $col = "created_at";
        $tasks = Task::where('user_id',auth()->user()->id)->where('deleted',false)->where('finished',false)->orderBy($col,'desc')->paginate(5);
        return view('home')->with('tasks',$tasks);
    }
    
    /**
     * Get All finished tasks
     * 
     * @return \Illuminte\Http\Response
     */
    public function getFinished(){
        $tasks = Task::where('user_id',auth()->user()->id)->where('deleted',false)->where('finished',true)->orderBy('urgency','desc')->paginate(5);
        return view('home')->with('tasks',$tasks);
    }

    public function getByUrgency($urgency){
        $tasks = Task::where('user_id',auth()->user()->id)->where('deleted',false)->where('finished',false)->where('urgency',$urgency)->orderBy('urgency','desc')->paginate(5);
        return view('home')->with('tasks',$tasks);
    }

    public function completeTask($id){
        $task = Task::find($id);
        if($task->user_id != auth()->user()->id)
            return redirect('/tasks');
        $task->finished=true;
        $task->save();
        $task=null;
        return redirect('/tasks')->with('success','Task Completed. Heads up.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'task' => 'required|max:255',
            'urgency' => 'required'
        ]);
        $array = array(1,2,3,4,5);
        if(in_array($request->urgency,$array)){
            $desc = array("Just To Remember","Kinda Important","Should do","Really Important","Top on my List");
            $color = array("#f1c40f","#2ecc71","#3498db","#f39c12","#c0392b");
            $task = new Task();
            $task->task = $request->task;
            $task->urgency = $request->urgency;
            $task->desc = $desc[$request->urgency-1];
            $task->color = $color[$request->urgency-1];
            $task->user_id = auth()->user()->id;
            $task->finished = false;
            $task->save();
            $task = null;
            return redirect('/home')->with('success','Task successfully added');
        }
        return redirect('/home')->with('error','An error occured');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        if($task->user_id == auth()->user()->id)
            return view('tasks.show')->with('task',$task);
        return redirect('/tasks');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        if(auth()->user()->id != $task->user_id)
             return redirect('/tasks');

         return view('tasks.edit')->with('task',$task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        if(auth()->user()->id != $task->user_id)
             return redirect('/tasks');

        $this->validate($request,[
            'task' => 'required|max:255',
            'urgency' => 'required'
        ]);

        $array = array(1,2,3,4,5);

        if(in_array($request->urgency,$array)){
            $desc = array("Just To Remember","Kinda Important","Should do","Really Important","Top on my List");
            $color = array("#f1c40f","#2ecc71","#3498db","#f39c12","#c0392b");
            $task = Task::find($id);
            $task->task = $request->task;
            $task->urgency = $request->urgency;
            $task->desc = $desc[$request->urgency-1];
            $task->color = $color[$request->urgency-1];
            $task->save();
            $task = null;
            return redirect('/home')->with('success','Task successfully updated');
        }
        return redirect('/home')->with('error','An error occured');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        if(auth()->user()->id != $task->user_id)
            return redirect('/tasks');          
        $task->deleted = true;
        $task->save();
        $task=null;

        return redirect('/tasks')->with('success','Task removed');
    }
}
