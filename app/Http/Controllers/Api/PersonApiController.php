<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PersonApiController extends Controller
{
    public function index()
    {
        return Person::with('tasks')->orderBy('name')->get();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:people,email'],
            'tasks' => ['nullable', 'array'],
            'tasks.*' => ['exists:tasks,id'],
        ]);

        $person = Person::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        $person->tasks()->sync($validatedData['tasks'] ?? []);

        return response()->json($person->load('tasks'), 201);
    }

    public function show(Person $person)
    {
        return $person->load('tasks');
    }

    public function update(Request $request, Person $person)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('people', 'email')->ignore($person->id),
            ],
            'tasks' => ['nullable', 'array'],
            'tasks.*' => ['exists:tasks,id'],
        ]);

        $person->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        $person->tasks()->sync($validatedData['tasks'] ?? []);

        return $person->load('tasks');
    }

    public function destroy(Person $person)
    {
        $person->delete();

        return response()->noContent();
    }

    public function tasks(Person $person)
    {
        return $person->tasks()->orderBy('title')->get();
    }

    public function syncTasks(Request $request, Person $person)
    {
        $validatedData = $request->validate([
            'tasks' => ['required', 'array'],
            'tasks.*' => ['exists:tasks,id'],
        ]);

        $person->tasks()->sync($validatedData['tasks']);

        return $person->load('tasks');
    }

    public function detachTask(Person $person, Task $task)
    {
        $person->tasks()->detach($task->id);

        return response()->noContent();
    }
}
