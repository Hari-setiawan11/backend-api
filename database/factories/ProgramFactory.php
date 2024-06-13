<?php

namespace Database\Factories;

use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProgramFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Program::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_program' => $this->faker->sentence,
            'deskripsi' => $this->faker->date,
            'file' => $this->faker->image('public/file/program', 640, 480, null, false), // generates a placeholder image
        ];
    }
}
