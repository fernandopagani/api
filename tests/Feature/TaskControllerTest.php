<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_it_can_create_task_with_description_and_due_date()
    {
        // Dados da tarefa para criar
        $data = [
            'title' => 'New Task',
            'description' => 'This is a task description',
            'due_date' => '31/12/2024',
        ];
    
        $response = $this->post('/api/tasks', $data);
    
        $response->assertStatus(200);
    
        $response->assertJson([
            'message' => 'task adicionada!',
            'tarefa' => [
                'title' => 'New Task',
                'description' => 'This is a task description',
                'due_date' => '31/12/2024',
            ]
        ]);
    
        $this->assertDatabaseHas('tasks', [
            'title' => 'New Task',
            'description' => 'This is a task description',
            'due_date' => '2024-12-31', // No banco de dados, geralmente está no formato YYYY-MM-DD
        ]);
    }
}
