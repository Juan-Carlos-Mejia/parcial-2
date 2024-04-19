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
    public function index(Request $request)
{
    $query = Task::query();

    // Filtrar por estado si se proporciona
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Filtrar por título si se proporciona
    if ($request->filled('title')) {
        $query->where('title', 'like', '%' . $request->title . '%');
    }

    // Filtrar por fecha si se proporciona
    if ($request->filled('due_date')) {
        $query->whereDate('due_date', $request->due_date);
    }

    // Obtener las tareas paginadas
    $tasks = $query->latest()->paginate(10);

    return view('index', compact('tasks'));
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
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'description' => 'required'
    ]);

    Task::create($request->all());

    // Redirigir a la ruta correcta después de crear la tarea
    return redirect()->route('tasks.index')->with('success', 'Nueva tarea agregada correctamente');
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
    public function edit(Task $task)
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

   $task->update($request->all());
   return redirect()->route('tasks.index')->with('success', 'Tarea editada correctamente');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
{
    $task->delete();
    return redirect()->route('tasks.index')->with('success', 'Tarea eliminada correctamente');
}

}
