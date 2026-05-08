<div class="mb-3">
    <label for="title" class="form-label">Título da Tarefa</label>
    <input
        type="text"
        id="title"
        name="title"
        class="form-control"
        value="{{ old('title', $task->title ?? '') }}"
        required
    >
</div>

<div class="mb-3">
    <label for="description" class="form-label">Descrição</label>
    <textarea id="description" name="description" class="form-control" rows="3">{{ old('description', $task->description ?? '') }}</textarea>
</div>

<div class="form-check form-switch mb-3">
    <input
        type="checkbox"
        id="status"
        name="status"
        value="1"
        class="form-check-input"
        @checked(old('status', $task->status ?? false))
    >
    <label for="status" class="form-check-label">Tarefa concluída</label>
</div>

<div class="mb-4">
    <label class="form-label">Pessoas atribuídas</label>

    <div class="border rounded p-3 bg-light">
        @forelse($people as $person)
            <div class="form-check">
                <input
                    type="checkbox"
                    id="person_{{ $person->id }}"
                    name="people[]"
                    value="{{ $person->id }}"
                    class="form-check-input"
                    @checked(in_array($person->id, old('people', $selectedPeople ?? [])))
                >
                <label for="person_{{ $person->id }}" class="form-check-label">
                    {{ $person->name }} - {{ $person->email }}
                </label>
            </div>
        @empty
            <p class="text-secondary mb-0">Nenhuma pessoa cadastrada.</p>
        @endforelse
    </div>
</div>
