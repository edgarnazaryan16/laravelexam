<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $table->id();
        //     $table->string('taskname');
        //     $table->foreignId('created_by')->references('id')->on('users');
        //     $table->foreignId('assigned_to')->references('id')->on('users');
        //     $table->enum('status', ['created', 'assigned', 'in-progress', 'done']);
        //     $table->text('description');
        return [

        ];
    }
}
