<?php

declare(strict_types=1);

namespace App\Repository;

use App\DataFixtures\CategoryFixture;
use App\Entity\Category;
use App\Exception\EntityNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    /*
     * @throws EntityNotFoundException
     */
    public function getById($id): Category
    {
        $query = $this
            ->createQueryBuilder('c')
            ->andWhere('c.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

        $category = $query->getOneOrNullResult();

        if (null == $category) {
            throw new EntityNotFoundException('Category', $id);
        }

        return $category;
    }

    public function getRandom(): ?Category
    {
        $query = $this
            ->createQueryBuilder('c')
            ->setMaxResults(1)
            ->orderBy('c.id', 'ASC')
            ->getQuery();

        $category = $query->getOneOrNullResult();
        $firstCategoryId = $category ? $category->getId() : 1;
        $lastCategoryId = $firstCategoryId + CategoryFixture::CATEGORIES_COUNT - 1;
        $randomId = \random_int($firstCategoryId, $lastCategoryId);

        return $this->find($randomId);
    }
}
