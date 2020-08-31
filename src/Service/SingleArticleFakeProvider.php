<?php

declare(strict_types=1);

namespace App\Service;

use App\ViewModel\SingleArticle;
use Faker\Factory;
use Faker\Generator;

/*
 * SingleArticleFakeProvider imitates the article info provider using the Faker library.
 * Generates sample data similar to the real article data.
 *
 * Can be used by the view model to test the single article template layout.
 */
final class SingleArticleFakeProvider implements SingleArticleProviderInterface
{
    private const CATEGORIES = [
        'World',
        'Sport',
        'IT',
        'Science',
    ];

    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function getItem($id): SingleArticle
    {
        $title = $this->faker->words(
            $this->faker->numberBetween(1, 4),
            true
        );
        $title = \ucfirst($title);

        return new SingleArticle(
            $id,
            $title,
            $this->faker->randomElement(self::CATEGORIES),
            \DateTimeImmutable::createFromMutable($this->faker->dateTimeThisYear),
            $this->faker->realText(1000)
        );
    }
}
