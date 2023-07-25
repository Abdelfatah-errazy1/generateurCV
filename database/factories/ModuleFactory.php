<?php

namespace Database\Factories;

use App\Models\FilliereNiveau;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Module>
 */
class ModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // return [
            'codeMod' => fake()->word(),
            'nomFr' => fake()->name(),
            'nomAr' => fake()->name(),
            'duree' => fake()->randomNumber(2),
            'coef' => fake()->randomNumber(1),
            'descriptionFr' => fake()->paragraphs(2),
            'descriptionAr' => fake()->paragraphs(2),
            'filliereNiveau' => FilliereNiveau::factory(1)->create()->first()[FilliereNiveau::PK],
        ];
      
    }
}
