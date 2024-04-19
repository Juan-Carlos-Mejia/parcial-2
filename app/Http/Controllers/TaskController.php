<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $tasks = Task::latest()->paginate(3);
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title'=> 'required',
            'description'=> 'required'
        ]);

        Task::create($request->all());
        return redirect()->route('task.index')->with('sucess','Nueva tarea agregada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task): View
    {
        return view('edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task): RedirectResponse
    {

        $request->validate([
            'title'=> 'required',
            'description'=> 'required'
        ]);

       $task ->update($request->all());
       return redirect()->route('task.index')->with('sucess','Tarea editada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task ->delete();
        return redirect()->route('task.index')->with('sucess','Tarea eliminada correctamente');
    }
}
