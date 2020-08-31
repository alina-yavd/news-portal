<?php

declare(strict_types=1);

namespace App\ViewModel;

final class SingleArticle
{
    private int $id;
    private string $title;
    private string $categoryTitle;
    private \DateTimeImmutable $publicationDate;
    private ?string $description;

    public function __construct(
        int $id,
        string $title,
        string $categoryTitle,
        \DateTimeImmutable $publicationDate,
        ?string $description
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->categoryTitle = $categoryTitle;
        $this->publicationDate = $publicationDate;
        $this->description = $description;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getCategoryTitle(): string
    {
        return $this->categoryTitle;
    }

    public function getPublicationDate(): \DateTimeImmutable
    {
        return $this->publicationDate;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
}
