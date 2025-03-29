<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\UserFilter;
use App\Entity\User;
use App\Services\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractController
{
    public function __construct(
        private readonly UserService $service,
    ) {
    }

    #[Route('/users', name: 'User Index', methods: ['GET'])]
    public function index(
        #[MapQueryString]
        UserFilter $filter
    ): JsonResponse {
        $users = $this->service->getByFilter($filter);

        if (count($users) == 0) {
            $this->json([]);
        }

        return $this->json(
            array_map(
                fn (User $user) => $user->toArray(),
                array_values($users),
            )
        );
    }
}
