<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Article;
use App\Repository\CategoryRepository;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class ArticleFixture extends AbstractFixture implements DependentFixtureInterface
{
    private const ARTICLES_COUNT = 15;
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        parent::__construct();
        $this->categoryRepository = $categoryRepository;
    }

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
            ->addBody($this->faker->realText(1000))
            ->addCategory($this->categoryRepository->getRandom())
        ;

        return $article;
    }

    public function getDependencies()
    {
        return [
            CategoryFixture::class,
        ];
    }
}
