<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\UserFilter;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserService extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function getByFilter(UserFilter $filter): array
    {
        $queryBuilder = $this->createQueryBuilder('u');

        if ($filter->age != null) {
            $queryBuilder->andWhere('u.age = :age')->setParameter('age', $filter->age);
        }

        if ($filter->gender != null) {
            $queryBuilder->andWhere('u.gender = :gender')->setParameter('gender', $filter->gender->value);
        }

        return $queryBuilder->getQuery()->getResult();
    }
}
