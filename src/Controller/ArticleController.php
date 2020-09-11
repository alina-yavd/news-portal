<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exception\EntityNotFoundException;
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
     * @Route("/article/{id}", methods={"GET"}, name="app_article_page", requirements={"page"="\d+"})
     */
    public function article(int $id): Response
    {
        try {
            $article = $this->articlesProvider->getById($id);
        } catch (EntityNotFoundException $e) {
            throw $this->createNotFoundException($e->getMessage(), $e);
        }

        return $this->render('articles/single.html.twig', [
            'article' => $article,
        ]);
    }
}
