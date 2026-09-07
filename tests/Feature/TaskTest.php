<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_a_task(): void
    {
        $response = $this->post('/tasks', ['title' => 'Belajar Laravel']);

        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', ['title' => 'Belajar Laravel']);
    }

    public function test_task_list_page_loads(): void
    {
        Task::factory()->create(['title' => 'Contoh Task']);

        $response = $this->get('/tasks');

        $response->assertStatus(200);
        $response->assertSee('Contoh Task');
    }
}