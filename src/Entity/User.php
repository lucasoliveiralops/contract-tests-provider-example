<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\Gender;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING)]
    #[Assert\NotBlank]
    private ?string $name = null;

    #[ORM\Column(type: Types::INTEGER)]
    #[Assert\NotBlank]
    private ?int $age = null;

    #[ORM\Column(enumType: Gender::class)]
    #[Assert\NotBlank]
    private ?Gender $gender = null;

    public static function fromArray(array $data): self
    {
        $user = new self();
        $user->id = $data['id'] ?? null;
        $user->name = $data['name'];
        $user->age = $data['age'];
        $user->gender = Gender::from($data['gender']);

        return $user;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'age' => $this->age,
            'gender' => $this->gender->value,
        ];
    }
}
