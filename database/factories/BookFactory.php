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
            'title_long' => $this->faker->optional(0.6)
            ->text(random_int(1, 100)),
            'isbn' => $this->faker->unique()->numerify('##########'),
            'isbn13' => $this->faker->unique()->numerify('978##########'),
            'dewey_decimal' => $this->faker->
            randomElement(['000', '111', '222', '333', '444', '555', '666', '777', '888', '999']),
            'binding' => $this->faker->sentence(random_int(1, 4)),
            'publisher' => $this->faker->randomElement(['Penguin Random House', 'Hachette Livre', 'HarperCollins', 'Macmillan Publishers', 'Simon & Schuster', 'McGraw-Hill Education', 'Houghton Mifflin Harcourt', 'Pearson Education', 'Grupo Santillana', 'Klett']),
            'language' => $this->faker->randomElement(['Español', 'English', 'Russian', 'Francais', 'German', 'Italian', 'Chinese', 'Japanese']),
            'date_published' => $this->faker->dateTime('now', 'America/La_Paz'),
            'edition' => $this->faker->optional(0.6)
            ->sentence(random_int(1, 5)),
            'pages' => $this->faker->numberBetween(60, 1000),
            'dimensions' => rand(0, 1) ? random_int(100, 400).' x '.
            random_int(100, 400) : null,
            'overview' => $this->faker->optional(0.6)->text(1000),
            'cover' => $this->faker->image('public/storage/images/books',
            640, 480, null,false),
            'back' => $this->faker->optional(0.5)->image('public/storage/images/books',
            640, 480, null,false),
            'excerpt' => $this->faker->optional(0.6)->sentence(rand(1, 5)),
            'synopsys' => $this->faker->text(1000),
            'author' => $this->faker->randomElement(['William Faulkner', 'Oscar Wilde', 'William Shakespeare', 'Franz Kafka', 'James Joyce', 'Philip K. Dick', 'Gabriel García Márquez', 'Paulo Coelho', 'George Orwell', 'William Butler Yeats', 'Charles Dickens', 'Truman Capote']),
            'subject' => $this->faker->randomElement(['Artes', 'Ficción', 'Terror', 'Humor', 'Fantasía', 'Poesía', 'Romántica', 'Edad Antigua', 'Autobiografías', 'Religión', 'Ciencia política', 'Historia']),
            'stock' => $this->faker->numberBetween(0, 50),
        ];
    }
}
