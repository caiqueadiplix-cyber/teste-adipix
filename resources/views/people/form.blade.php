<div class="mb-3">
    <label for="name" class="form-label">Nome</label>
    <input
        type="text"
        id="name"
        name="name"
        class="form-control"
        value="{{ old('name', $person->name ?? '') }}"
        required
    >
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input
        type="email"
        id="email"
        name="email"
        class="form-control"
        value="{{ old('email', $person->email ?? '') }}"
        required
    >
</div>

<div class="mb-4">
    <label class="form-label">Tarefas atribuídas</label>

    <div class="border rounded p-3 bg-light">
        @forelse($tasks as $task)
            <div class="form-check">
                <input
                    type="checkbox"
                    id="task_{{ $task->id }}"
                    name="tasks[]"
                    value="{{ $task->id }}"
                    class="form-check-input"
                    @checked(in_array($task->id, old('tasks', $selectedTasks ?? [])))
                >
                <label for="task_{{ $task->id }}" class="form-check-label">
                    {{ $task->title }}
                </label>
            </div>
        @empty
            <p class="text-secondary mb-0">Nenhuma tarefa cadastrada.</p>
        @endforelse
    </div>
</div>
