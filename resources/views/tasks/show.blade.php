@extends('layouts.app')

@section('title', 'Detalhes da Tarefa - Adiplix')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h1 class="h4 mb-0">{{ $task->title }}</h1>
        </div>

        <div class="card-body">
            <p><strong>Descrição:</strong> {{ $task->description ?: 'Sem descrição' }}</p>
            <p>
                <strong>Status:</strong>
                {{ $task->status ? 'Concluída' : 'Pendente' }}
            </p>

            <h2 class="h5 mt-4">Pessoas atribuídas</h2>
            @forelse($task->people as $person)
                <div class="border rounded p-2 mb-2">
                    {{ $person->name }} - {{ $person->email }}
                </div>
            @empty
                <p class="text-secondary">Nenhuma pessoa atribuída a esta tarefa.</p>
            @endforelse

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Voltar</a>
                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary">Editar</a>
            </div>
        </div>
    </div>
@endsection
