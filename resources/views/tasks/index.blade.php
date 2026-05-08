@extends('layouts.app')

@section('title', 'Tarefas - Adiplix')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Tarefas</h1>
        <a href="{{ route('tasks.create') }}" class="btn btn-success">Nova Tarefa</a>
    </div>

    <div class="table-responsive bg-white rounded shadow-sm">
        <table class="table table-striped table-bordered align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Pessoas atribuídas</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description ?: 'Sem descrição' }}</td>
                        <td>
                            @if($task->status)
                                <span class="badge text-bg-success">Concluída</span>
                            @else
                                <span class="badge text-bg-warning">Pendente</span>
                            @endif
                        </td>
                        <td>
                            {{ $task->people->pluck('name')->join(', ') ?: 'Nenhuma pessoa' }}
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('tasks.show', $task) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary btn-sm">Editar</a>

                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Deseja excluir esta tarefa?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Nenhuma tarefa encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
