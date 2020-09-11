<?php

declare(strict_types=1);

namespace App\ViewModel;

use App\Entity\Category;

final class SingleArticle
{
    private int $id;
    private string $title;
    private ?Category $category;
    private \DateTimeImmutable $publicationDate;
    private ?string $body;

    public function __construct(
        int $id,
        string $title,
        ?Category $category,
        \DateTimeImmutable $publicationDate,
        ?string $body
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->category = $category;
        $this->publicationDate = $publicationDate;
        $this->body = $body;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function getPublicationDate(): \DateTimeImmutable
    {
        return $this->publicationDate;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }
}
