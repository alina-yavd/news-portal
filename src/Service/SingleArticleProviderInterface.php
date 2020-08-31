<?php

declare(strict_types=1);

namespace App\Service;

use App\ViewModel\SingleArticle;

/*
 * SingleArticleProviderInterface defines the interface to be implemented by providers of article info.
 *
 * Provides the article data to be used in the single article templates.
 */
interface SingleArticleProviderInterface
{
    public function getById(int $id): SingleArticle;
}
