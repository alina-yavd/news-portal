<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Persistence\ObjectManager;

final class ArticleFixture extends AbstractFixture
{
    private const ARTICLES_COUNT = 15;

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < self::ARTICLES_COUNT; ++$i) {
            $article = $this->createArticle();

            if ($this->faker->boolean(80)) {
                $article->publish();
            }

            $manager->persist($article);
        }

        $manager->flush();
    }

    private function createArticle(): Article
    {
        $title = $this->faker->words(
            $this->faker->numberBetween(1, 4),
            true
        );
        $title = \ucfirst($title);

        $article = new Article($title);
        $article
            ->addImage($this->faker->imageUrl())
            ->addShortDescription($this->faker->words(
                $this->faker->numberBetween(3, 7),
                true
            ))
            ->addBody($this->faker->realText(1000));

        return $article;
    }
}
