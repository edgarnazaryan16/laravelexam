<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\User;

class TaskController extends Controller
{
    public $statuses = ['created', 'assigned', 'in-progress', 'done'];

    public function __construct()
    {
        $this->middleware('manager', ['only' => ['create', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = $this->statuses;
        $user = auth()->user();
        if($user->role === 'manager') {
            $tasks = Task::with(['created_by_user', 'assigned_to_user'])->where('created_by', $user->id)->where('taskname', 'like', "%" . request()->taskname . "%")->where('created_at', 'like', "%" . request()->date . "%")->paginate(5)->withQueryString();
        } else {
            $tasks = Task::with(['created_by_user', 'assigned_to_user'])->where('taskname', 'like', "%" . request()->taskname . "%")->where('created_at', 'like', "%" . request()->date . "%")->paginate(5)->withQueryString();
        }
        return view('tasks.index', compact('tasks', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $developers = User::where('role', 'developer')->pluck('username', 'id');
        // dd($developers);
        return view('tasks.create', compact('developers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        $request->merge(['created_by' => auth()->user()->id, 'status' => 'created']);
        Task::create($request->all());
        return redirect('tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        if($task->created_by !== auth()->user()->id) {
            return redirect('tasks');
        }
        $developers = User::where('role', 'developer')->pluck('username', 'id');
        return view('tasks.edit', compact('task', 'developers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->all());
        return redirect('tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect('tasks');
    }
}
