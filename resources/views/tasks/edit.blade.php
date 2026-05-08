@extends('layouts.app')

@section('title', 'Editar Tarefa - Adiplix')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h1 class="h4 mb-0">Editar Tarefa</h1>
        </div>

        <div class="card-body">
            <form action="{{ route('tasks.update', $task) }}" method="POST">
                @csrf
                @method('PUT')

                @include('tasks.form')

                <div class="d-flex justify-content-between">
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Voltar</a>
                    <button type="submit" class="btn btn-success">Atualizar Tarefa</button>
                </div>
            </form>
        </div>
    </div>
@endsection
