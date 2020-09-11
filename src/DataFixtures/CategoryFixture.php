<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Category;
use App\Repository\ArticleRepository;
use Doctrine\Persistence\ObjectManager;

final class CategoryFixture extends AbstractFixture
{
    public const CATEGORIES_COUNT = 5;

    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        parent::__construct();
        $this->articleRepository = $articleRepository;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < self::CATEGORIES_COUNT; ++$i) {
            $category = $this->createCategory();
            $manager->persist($category);
        }

        $manager->flush();
    }

    private function createCategory(): Category
    {
        $title = $this->faker->words(1, true);
        $title = \ucfirst($title);

        return new Category($title);
    }
}
