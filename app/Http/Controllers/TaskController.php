<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('people')->latest()->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $people = Person::orderBy('name')->get();

        return view('tasks.create', compact('people'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'boolean'],
            'people' => ['nullable', 'array'],
            'people.*' => ['exists:people,id'],
        ]);

        $task = Task::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'] ?? null,
            'status' => $request->boolean('status'),
        ]);

        $task->people()->sync($validatedData['people'] ?? []);

        return redirect()->route('tasks.index')->with('success', 'Tarefa criada com sucesso!');
    }

    public function show(Task $task)
    {
        $task->load('people');

        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $people = Person::orderBy('name')->get();
        $selectedPeople = $task->people()->pluck('people.id')->toArray();

        return view('tasks.edit', compact('task', 'people', 'selectedPeople'));
    }

    public function update(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'boolean'],
            'people' => ['nullable', 'array'],
            'people.*' => ['exists:people,id'],
        ]);

        $task->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'] ?? null,
            'status' => $request->boolean('status'),
        ]);

        $task->people()->sync($validatedData['people'] ?? []);

        return redirect()->route('tasks.index')->with('success', 'Tarefa atualizada com sucesso!');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tarefa excluída com sucesso!');
    }
}
