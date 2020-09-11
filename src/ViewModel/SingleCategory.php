<?php

declare(strict_types=1);

namespace App\ViewModel;

use App\Collection\HomePageArticles;

final class SingleCategory
{
    private int $id;
    private string $title;
    private ?HomePageArticles $articles;

    public function __construct(
        int $id,
        string $title,
        ?HomePageArticles $articles
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->articles = $articles;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getArticles(): ?HomePageArticles
    {
        return $this->articles;
    }
}
