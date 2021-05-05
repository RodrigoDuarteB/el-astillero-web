<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(random_int(1, 5)),
            'summary' => $this->faker->text(random_int(60, 200)),
            'genre' => $this->faker->sentence(3),
            'author' => $this->faker->name(),
            'publish_year' => $this->faker->date('Y'),
            'publisher' => $this->faker->sentence(random_int(1, 2)),
            'front_image' => $this->faker->
            image('public/storage/images/books',640, 480,
            null,false),
            'back_image' => $this->faker->
            image('public/storage/images/books',640, 480,
            null,false),
            'isbn' => $this->faker->unique()->numerify('978##########')
        ];
    }
}
