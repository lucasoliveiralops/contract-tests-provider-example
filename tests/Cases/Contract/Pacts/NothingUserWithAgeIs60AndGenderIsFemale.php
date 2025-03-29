<?php

namespace App\Tests\Cases\Contract\Pacts;

use App\Entity\User;
use App\Enum\Gender;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;

class NothingUserWithAgeIs60AndGenderIsFemale implements Pact
{
    public static function setUp(ContainerInterface $container): void
    {
        $container->get(EntityManagerInterface::class)->createQueryBuilder()
            ->delete(User::class, 'u')
            ->where('u.age = 60')
            ->where('u.gender = :gender')
            ->setParameter(':gender', Gender::Woman->value)
            ->getQuery()
            ->execute();
    }
}