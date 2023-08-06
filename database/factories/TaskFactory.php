<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $projects = Project::pluck('id')->toArray();
        return [
            'name' => $this->faker->sentence,
            'project_id' => $this->faker->randomElement($projects),
            'priority' => $this->faker->unique()->numberBetween(1, 100),
            'description' => $this->faker->text(50),
        ];
    }
}
