<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function taskView()
    {
        return view('backend.task.task');
    }

    public function getUserTasks()
    {


        return response()->json(Task::where('user_id',Auth::id())->get());
    }

    public function saveNewTask(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'description'=>'required',
            'start_date_time'=>'required',
            'end_date_time'=>'required',
        ]);

        if ($request->task_id!=null){

            $task=Task::find($request->task_id);
        }else{
            $task=new Task();

        }
        $task->title=$request->title;
        $task->description=$request->description;
        $task->start_date_time=$request->start_date_time;
        $task->end_date_time=$request->end_date_time;
        $task->user_id=Auth::id();
        //default is complete is false
        $task->save();


        return response()->json(Task::where('user_id',Auth::id())->get());

    }

    public function deleteTask(Task $task)
    {
        $task->delete();

        return response()->json(Task::where('user_id',Auth::id())->get());

    }

    public function markAsComplete(Task $task)
    {
        $task->is_completed=true;
        $task->save();
        return response()->json(Task::where('user_id',Auth::id())->get());

    }

    public function getAllTasks()
    {
        return response()->json(Task::all()->load('user'));
    }

    public function tasksView()
    {
        return view('backend.task.all_tasks');
    }

    public function editSingleTask(Task $task)
    {
        return response()->json($task);
    }
}
