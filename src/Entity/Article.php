<?php

declare(strict_types=1);

namespace App\Entity;

use App\Exception\ArticleBodyCannotBeEmptyException;
use App\Repository\ArticleRepository;
use App\ViewModel\HomePageArticle;
use App\ViewModel\SingleArticle;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $title;

    /**
     * Many articles have one category.
     *
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="article")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private ?Category $category;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private ?string $image = null;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private ?string $shortDescription = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $body = null;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private ?\DateTimeImmutable $publicationDate = null;

    /**
     * @ORM\Column(type="date_immutable")
     */
    private \DateTimeImmutable $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private \DateTimeImmutable $updatedAt;

    public function __construct(string $title)
    {
        $this->title = $title;
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function addCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function addImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function addShortDescription(?string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function addBody(?string $body): self
    {
        $this->body = $body;

        return $this;
    }

    private function getCategory(): ?Category
    {
        return $this->category;
    }

    /*
     * @throws ArticleBodyCannotBeEmptyException
     */
    public function publish(): void
    {
        if (null === $this->body) {
            throw new ArticleBodyCannotBeEmptyException();
        }
        $this->publicationDate = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function isPublished(): bool
    {
        return null !== $this->publicationDate;
    }

    public function getHomePageArticle(): HomePageArticle
    {
        return new HomePageArticle(
            $this->id,
            $this->getCategory(),
            $this->title,
            $this->publicationDate,
            $this->image,
            $this->shortDescription
        );
    }

    public function getSingleArticle(): SingleArticle
    {
        return new SingleArticle(
            $this->id,
            $this->title,
            $this->getCategory(),
            $this->publicationDate,
            $this->body
        );
    }
}
