<?php

namespace App\Tests\Cases\Contract\Pacts;

use App\Entity\User;
use App\Enum\Gender;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Psr\Container\ContainerInterface;

class ExistsUserWithAgeIs14AndGenderIsMale implements Pact
{
    public static function setUp(ContainerInterface $container): void
    {
        $faker = Factory::create('pt_BR');

        $user = User::fromArray([
            'name' => $faker->name(),
            'age' => 14,
            'gender' => Gender::Man->value,
        ]);

       $entityManager = $container->get(EntityManagerInterface::class);
       $entityManager->persist($user);
       $entityManager->flush();
    }
}