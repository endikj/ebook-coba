<?php

namespace Database\Factories;

use App\Models\Ulasan;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Ebook;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ulasan>
 */
class UlasanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Ulasan::class;
    public function definition()
    {
        return [
            'id_user' => User::factory(),
            'id_ebook' => Ebook::factory(),
            'komentar' => $this->faker->sentence,
            'penilaian' => $this->faker->numberBetween(1, 5),
        ];
    }
}
