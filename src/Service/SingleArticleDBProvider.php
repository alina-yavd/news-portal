<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\ArticleRepository;
use App\ViewModel\SingleArticle;

final class SingleArticleDBProvider implements SingleArticleProviderInterface
{
    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function getById(int $id): SingleArticle
    {
        $article = $this->articleRepository->getById($id);

        return $article->getSingleArticle();
    }
}
