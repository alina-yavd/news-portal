<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\SingleArticleProviderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ArticleController extends AbstractController
{
    private SingleArticleProviderInterface $articlesProvider;

    public function __construct(SingleArticleProviderInterface $articlesProvider)
    {
        $this->articlesProvider = $articlesProvider;
    }

    /**
     * @Route("/article/{id}", methods={"GET"}, name="article_page", requirements={"page"="\d+"})
     */
    public function article(int $id): Response
    {
        $article = $this->articlesProvider->getItem($id);

        return $this->render('articles/single.html.twig', [
            'article' => $article,
        ]);
    }
}
