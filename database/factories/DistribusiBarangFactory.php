<?php

namespace Database\Factories;

use App\Models\Distribusi;
use App\Models\DistribusiBarang;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DistribusiBarang>
 */
class DistribusiBarangFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DistribusiBarang::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_barang' => $this->faker->sentence,
            'volume' => $this->faker->randomNumber(),
            'satuan' => $this->faker->randomFloat(2, 1000, 5000),
            'harga_satuan' => $this->faker->randomFloat(2, 500, 3000),
            'file' => $this->faker->image('public/file/distribusi', 640, 480, null, false), // generates a placeholder image
            'distribusi_id' => Distribusi::factory(),
        ];
    }
}
