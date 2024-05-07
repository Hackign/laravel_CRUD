<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TaskController extends Controller
 /**
     * Gustavo Adolfo Castillo Paez
     * 858640
     */
{
    /**
     * Display a listing of the resource.
     */
    public function index(): view 
{
    $tasks = Task::latest()->paginate(3);
    return view('index', ['tasks' => $tasks]);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create(): view
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'description'=> 'required'

        ]);
        Task::create($request->all());
        return redirect()->route('tasks.index')->with('success','Bien hecho! la creacion de la tarea ha sido exitosa');
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
        return view('edit',['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'description'=> 'required'

        ]);


        $task->update($request->all());
        return redirect()->route('tasks.index')->with('success','Fue facil verdad? la actualizacion fue un exito total');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success','Es una pena tener que despedir una tarea, sin embargo quedas con la tranquilidad de que se realizo la eliminacion');
    }
}