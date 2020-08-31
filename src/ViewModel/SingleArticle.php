<?php

declare(strict_types=1);

namespace App\ViewModel;

final class SingleArticle
{
    private int $id;
    private string $title;
    private string $categoryTitle;
    private \DateTimeImmutable $publicationDate;
    private ?string $body;

    public function __construct(
        int $id,
        string $title,
        string $categoryTitle,
        \DateTimeImmutable $publicationDate,
        ?string $body
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->categoryTitle = $categoryTitle;
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

    public function getCategoryTitle(): string
    {
        return $this->categoryTitle;
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
