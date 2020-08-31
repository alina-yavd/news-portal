<?php

declare(strict_types=1);

namespace App\Service;

use App\ViewModel\SingleArticle;

interface SingleArticleProviderInterface
{
    public function getItem($id): SingleArticle;
}
