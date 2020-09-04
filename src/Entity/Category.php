<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CategoryRepository;
use App\ViewModel\CategoryDTO;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
    private Collection $articles;

    public function __construct(string $title)
    {
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

    public function getCategory(): CategoryDTO
    {
        $this->articles = new ArrayCollection();

        return new CategoryDTO(
            $this->id,
            $this->title,
            $this->articles
        );
    }
}
