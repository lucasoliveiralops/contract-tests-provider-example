<?php

namespace App\Tests\Cases\Contract;

use App\Tests\Cases\Contract\Pacts\ExistsUserWithAgeIs14AndGenderIsMale;
use App\Tests\Cases\Contract\Pacts\NothingUserWithAgeIs60AndGenderIsFemale;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PactManager extends KernelTestCase
{
    public static function createPacts(ContainerInterface $container): void
    {
        ExistsUserWithAgeIs14AndGenderIsMale::setUp($container);
        NothingUserWithAgeIs60AndGenderIsFemale::setUp($container);
    }
}