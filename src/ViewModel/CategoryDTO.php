<?php

declare(strict_types=1);

namespace App\ViewModel;

use Doctrine\Common\Collections\Collection;

final class CategoryDTO
{
    private int $id;
    private string $title;
    private Collection $articles;

    public function __construct(
        int $id,
        string $title,
        Collection $articles
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
}
