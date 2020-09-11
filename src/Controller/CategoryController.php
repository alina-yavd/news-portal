<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exception\EntityNotFoundException;
use App\Service\SingleCategoryProviderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class CategoryController extends AbstractController
{
    private SingleCategoryProviderInterface $categoriesProvider;

    public function __construct(SingleCategoryProviderInterface $categoriesProvider)
    {
        $this->categoriesProvider = $categoriesProvider;
    }

    /**
     * @Route("/category/{slug}", methods={"GET"}, name="app_category_page")
     */
    public function index(string $slug): Response
    {
        try {
            $category = $this->categoriesProvider->getBySlug($slug);
        } catch (EntityNotFoundException $e) {
            throw $this->createNotFoundException($e->getMessage(), $e);
        }

        return $this->render('categories/single.html.twig', [
            'category' => $category,
        ]);
    }
}
