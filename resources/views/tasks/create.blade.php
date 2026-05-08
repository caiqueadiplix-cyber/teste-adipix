@extends('layouts.app')

@section('title', 'Nova Tarefa - Adiplix')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h1 class="h4 mb-0">Cadastrar Nova Tarefa</h1>
        </div>

        <div class="card-body">
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf

                @include('tasks.form', ['task' => null, 'selectedPeople' => []])

                <div class="d-flex justify-content-between">
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Voltar</a>
                    <button type="submit" class="btn btn-success">Salvar Tarefa</button>
                </div>
            </form>
        </div>
    </div>
@endsection
