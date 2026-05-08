<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = fake('pt_BR');

        $titles = [
            'Atualizar cadastro de cliente',
            'Revisar documentação do projeto',
            'Enviar relatório semanal',
            'Conferir dados da planilha',
            'Agendar reunião com a equipe',
            'Corrigir informações do sistema',
            'Organizar tarefas pendentes',
            'Validar cadastro de pessoas',
            'Preparar apresentação interna',
            'Responder chamados em aberto',
            'Testar fluxo de cadastro',
            'Revisar permissões de acesso',
            'Cadastrar nova demanda',
            'Finalizar ajuste solicitado',
            'Verificar status das tarefas',
        ];

        return [
            'title' => $faker->randomElement($titles),
            'description' => $faker->randomElement([
                'Tarefa criada para simular uma demanda comum do dia a dia.',
                'Atividade cadastrada para acompanhamento e controle interno.',
                'Item usado para testar o relacionamento entre pessoas e tarefas.',
                'Demanda fictícia gerada automaticamente pelo seeder do sistema.',
                'Registro de exemplo para validar o funcionamento do CRUD.',
            ]),
            'status' => $faker->boolean(),
        ];
    }
}
