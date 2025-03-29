<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\User;
use App\Enum\Gender;
use App\ValueObject\CPF;
use Faker\Factory;

class UserFactory
{
    public static function make(): User
    {
        $faker = Factory::create('pt_BR');

        return User::fromArray([
            'id' => rand(),
            'name' => $faker->name(),
            'age' => rand(10, 25),
            'gender' => $faker->randomElement([Gender::Woman->value, Gender::Man->value, Gender::Others->value]),
            'cpf' => new CPF($faker->cpf()),
            'address' => [
                'street' => $faker->streetAddress(),
                'neighborhood' => $faker->streetAddress(),
                'city' => $faker->city(),
                'state' => 'state',
                'number' => rand(),
            ],
        ]);
    }

    public static function many(int $quantity = 1): array
    {
        $items = [];

        for ($i = 0; $i < $quantity; ++$i) {
            $items[] = self::make();
        }

        return $items;
    }
}
