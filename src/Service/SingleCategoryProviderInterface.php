<?php

declare(strict_types=1);

namespace App\Service;

use App\ViewModel\SingleCategory;

/*
 * SingleCategoryProviderInterface defines the interface to be implemented by providers of category info.
 *
 * Provides the category data to be used in the single category templates.
 */
interface SingleCategoryProviderInterface
{
    public function getBySlug(string $slug): SingleCategory;
}
