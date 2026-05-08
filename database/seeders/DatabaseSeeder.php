<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Person;
use App\Models\Task;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $people = Person::factory(10)->create();
        $tasks = Task::factory(30)->create();

        // Associa de 1 a 3 tarefas para cada pessoa.
        $people->each(function ($person) use ($tasks) {
            $person->tasks()->attach(
                $tasks->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
