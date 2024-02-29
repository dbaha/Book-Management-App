<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Author;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $existingAuthor = Author::all()->random();
        return [
            'title' => $this->faker->sentence(3),
            'author_id' => $existingAuthor->id,
            'genre' => $this->faker->randomElement(['Fantasy', 'Science Fiction', 'Mystery', 'Thriller', 'Romance']), 
            'published_date' => $this->faker->date, 
        ];
    }
}
