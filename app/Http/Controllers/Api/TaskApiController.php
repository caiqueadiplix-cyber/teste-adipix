<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskApiController extends Controller
{
    public function index()
    {
        return Task::with('people')->latest()->get();
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

        return response()->json($task->load('people'), 201);
    }

    public function show(Task $task)
    {
        return $task->load('people');
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

        return $task->load('people');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response()->noContent();
    }

    public function people(Task $task)
    {
        return $task->people()->orderBy('name')->get();
    }

    public function syncPeople(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'people' => ['required', 'array'],
            'people.*' => ['exists:people,id'],
        ]);

        $task->people()->sync($validatedData['people']);

        return $task->load('people');
    }

    public function detachPerson(Task $task, Person $person)
    {
        $task->people()->detach($person->id);

        return response()->noContent();
    }
}
