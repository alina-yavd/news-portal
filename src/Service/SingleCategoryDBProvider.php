<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\CategoryRepository;
use App\ViewModel\SingleCategory;

final class SingleCategoryDBProvider implements SingleCategoryProviderInterface
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getBySlug(string $slug): SingleCategory
    {
        $category = $this->categoryRepository->getBySlug($slug);

        return $category->getCategory();
    }
}
