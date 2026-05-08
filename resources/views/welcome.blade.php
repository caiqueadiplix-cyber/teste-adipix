@extends('layouts.app')

@section('title', 'Início - Adiplix')

@section('content')
    <div class="bg-white rounded shadow-sm p-5 border">
        <h1 class="display-6 fw-bold">Projeto de cadastro de pessoas e tarefas</h1>
        <p class="fs-5 text-secondary">
            Projeto Caique, utilizando Laravel
        </p>

        <div class="d-flex gap-2 mt-4">
            <a href="{{ route('people.index') }}" class="btn btn-primary">Gerenciar Pessoas</a>
            <a href="{{ route('tasks.index') }}" class="btn btn-outline-primary">Gerenciar Tarefas</a>
        </div>
    </div>
@endsection
