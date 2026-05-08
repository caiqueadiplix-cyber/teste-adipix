@extends('layouts.app')

@section('title', 'Nova Pessoa - Adiplix')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h1 class="h4 mb-0">Cadastrar Nova Pessoa</h1>
        </div>

        <div class="card-body">
            <form action="{{ route('people.store') }}" method="POST">
                @csrf

                @include('people.form', ['person' => null, 'selectedTasks' => []])

                <div class="d-flex justify-content-between">
                    <a href="{{ route('people.index') }}" class="btn btn-secondary">Voltar</a>
                    <button type="submit" class="btn btn-success">Salvar Pessoa</button>
                </div>
            </form>
        </div>
    </div>
@endsection
