@extends('layouts.app')

@section('title', 'Editar Pessoa - Adiplix')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h1 class="h4 mb-0">Editar Pessoa</h1>
        </div>

        <div class="card-body">
            <form action="{{ route('people.update', $person) }}" method="POST">
                @csrf
                @method('PUT')

                @include('people.form')

                <div class="d-flex justify-content-between">
                    <a href="{{ route('people.index') }}" class="btn btn-secondary">Voltar</a>
                    <button type="submit" class="btn btn-success">Atualizar Pessoa</button>
                </div>
            </form>
        </div>
    </div>
@endsection
