<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProfilLangue>
 */
class ProfilLangueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cin' => fake()->word(),
            'nom' => fake()->firstName(),
            'prenom' => fake()->lastName(),
            'genre' => fake()->pronoun(),
            'civilite' => fake()->title(),
            'dateNaissance' => fake()->date(),
            'titreFoction' => fake()->name(),
            'type' => fake()->randomElement(['ETB','ECF']),
            'avatar' => fake()->image(),
            'dateCreation' => fake()->date(),
            'dateModification' => fake()->date(),
            'userChange' => fake()->randomElement(['DE','UA','SC']),
            'observation'=>fake()->text(),
            'tel' => fake()->phoneNumber(),
            'fax' => fake()->phoneNumber(),
            'gsm' => fake()->phoneNumber(),
            'siteWeb' => fake()->url(),
            'email' => fake()->email(),
            'adresse'=>fake()->address(),
            'ville' => fake()->city(),
            'codePostal' => fake(),
            'nationalite' => fake()->country(),
            'pays' => fake()->country(),
        ];
    }
}
