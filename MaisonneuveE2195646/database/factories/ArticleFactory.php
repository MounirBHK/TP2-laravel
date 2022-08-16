<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Ville;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence($nbWords = rand(1, 7), $variableNbWords = true),
            'title_fr' => $this->faker->sentence($nbWords = rand(1, 7), $variableNbWords = true),
            'body' => $this->faker->paragraph($nbSentences = rand(1, 12), $variableNbSentences = true),
            'body_fr' => $this->faker->paragraph($nbSentences = rand(1, 12), $variableNbSentences = true),
            'userId' => $this->faker->numberBetween(1, 20),
        ];
    }
}
