<?php

declare(strict_types=1);

namespace App\Entity;

use App\Collection\HomePageArticles;
use App\Repository\CategoryRepository;
use App\ViewModel\SingleCategory;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $title;

    /**
     * One category has many articles.
     *
     * @ORM\OneToMany(targetEntity="Article", mappedBy="category")
     */
    private ?Collection $articles;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(type="string", length=128, unique=true)
     */
    private string $slug;

    public function __construct(string $title)
    {
        $this->articles = new ArrayCollection();
        $this->title = $title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return HomePageArticles[]|null
     */
    public function getArticles(): ?HomePageArticles
    {
        $categoryArticles = $this->articles->filter(fn (Article $article) => $article->isPublished());
        $viewModels = $categoryArticles->map(fn (Article $article) => $article->getHomePageArticle());

        return new HomePageArticles(...$viewModels);
    }

    public function getCategory(): SingleCategory
    {
        return new SingleCategory(
            $this->id,
            $this->title,
            $this->getArticles()
        );
    }
}
