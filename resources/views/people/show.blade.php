@extends('layouts.app')

@section('title', 'Detalhes da Pessoa - Adiplix')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h1 class="h4 mb-0">{{ $person->name }}</h1>
        </div>

        <div class="card-body">
            <p><strong>Email:</strong> {{ $person->email }}</p>

            <h2 class="h5 mt-4">Tarefas atribuídas</h2>
            @forelse($person->tasks as $task)
                <div class="border rounded p-2 mb-2">
                    {{ $task->title }}
                    <span class="text-secondary">
                        - {{ $task->status ? 'Concluída' : 'Pendente' }}
                    </span>
                </div>
            @empty
                <p class="text-secondary">Nenhuma tarefa atribuída a esta pessoa.</p>
            @endforelse

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('people.index') }}" class="btn btn-secondary">Voltar</a>
                <a href="{{ route('people.edit', $person) }}" class="btn btn-primary">Editar</a>
            </div>
        </div>
    </div>
@endsection
