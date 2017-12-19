<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param $tasks all the tasks of a user
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = User::find(auth()->user()->id)->tasks()->orderBy('urgency','desc')->get();
        return view('home')->with('tasks',$tasks);
    }

    public function filter($column="urgency"){
        $col = "urgency";
        if($column == "date")
            $col = "created_at";
        $tasks = User::find(auth()->user()->id)->tasks()->orderBy($col,'desc')->get();
        return view('home')->with('tasks',$tasks);
    }

}
