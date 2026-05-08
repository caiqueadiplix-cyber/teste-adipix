@extends('layouts.app')

@section('title', 'Pessoas - Adiplix')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Pessoas</h1>
        <a href="{{ route('people.create') }}" class="btn btn-success">Nova Pessoa</a>
    </div>

    <div class="table-responsive bg-white rounded shadow-sm">
        <table class="table table-striped table-bordered align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Tarefas atribuídas</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($people as $person)
                    <tr>
                        <td>{{ $person->id }}</td>
                        <td>{{ $person->name }}</td>
                        <td>{{ $person->email }}</td>
                        <td>
                            {{ $person->tasks->pluck('title')->join(', ') ?: 'Nenhuma tarefa' }}
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('people.show', $person) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('people.edit', $person) }}" class="btn btn-primary btn-sm">Editar</a>

                                <form action="{{ route('people.destroy', $person) }}" method="POST" onsubmit="return confirm('Deseja excluir esta pessoa?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Nenhuma pessoa encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
