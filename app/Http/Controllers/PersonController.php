<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PersonController extends Controller
{
    public function index()
    {
        $people = Person::with('tasks')->orderBy('name')->get();

        return view('people.index', compact('people'));
    }

    public function create()
    {
        $tasks = Task::orderBy('title')->get();

        return view('people.create', compact('tasks'));
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

        return redirect()->route('people.index')->with('success', 'Pessoa criada com sucesso!');
    }

    public function show(Person $person)
    {
        $person->load('tasks');

        return view('people.show', compact('person'));
    }

    public function edit(Person $person)
    {
        $tasks = Task::orderBy('title')->get();
        $selectedTasks = $person->tasks()->pluck('tasks.id')->toArray();

        return view('people.edit', compact('person', 'tasks', 'selectedTasks'));
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

        return redirect()->route('people.index')->with('success', 'Pessoa atualizada com sucesso!');
    }

    public function destroy(Person $person)
    {
        $person->delete();

        return redirect()->route('people.index')->with('success', 'Pessoa excluída com sucesso!');
    }
}
