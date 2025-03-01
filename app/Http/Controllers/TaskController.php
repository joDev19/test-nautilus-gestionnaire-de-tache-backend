<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTask;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(private TaskService $taskService)
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->taskService->all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTask $request)
    {
        $userId = auth()->user()->id;
        return $this->taskService->store(array_merge($request->validated(), ['user_id' => $userId]));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $task)
    {
        if(in_array( $task, auth()->user()->tasks()->pluck('id')->toArray())){

            return $this->taskService->find($task);
        }
        abort(403, "Ce n'est pas votre tâche");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateTask $request, int $task)
    {
        if(in_array( $task, auth()->user()->tasks()->pluck('id')->toArray())){
            return $this->taskService->update($task, $request->validated());
        }
        abort(403, "Ce n'est pas votre tâche");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $task)
    {
        if(in_array( $task, auth()->user()->tasks()->pluck('id')->toArray())){
            return $this->taskService->delete($task);
        }
        abort(403, "Ce n'est pas votre tâche");

    }
    public function changeStatus($id, $status){
        if(in_array( $id, auth()->user()->tasks()->pluck('id')->toArray())){
            return $this->taskService->changeStatus($id, $status);
        }
        abort(403, "Ce n'est pas votre tâche");
    }
}
