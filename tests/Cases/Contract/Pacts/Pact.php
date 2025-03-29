<?php

namespace App\Tests\Cases\Contract\Pacts;

use Symfony\Component\DependencyInjection\ContainerInterface;

interface Pact
{
    public static function setUp(ContainerInterface $container): void;
}