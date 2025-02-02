<?php

declare(strict_types=1);

namespace App\DTO\Request;

use App\Enum\Pizza\TailleType;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class PizzaRequest
{
    /** @param array<int, IngredientRequest> $ingredients */
    public function __construct(
        #[Assert\NotBlank]
        public string $nom,
        #[Assert\NotBlank]
        public int $quantite,
        #[Assert\NotBlank, Assert\Choice(choices: [TailleType::PETITE, TailleType::MOYENNE, TailleType::GRANDE])]
        public TailleType $taille,
        #[Assert\NotBlank]
        public array $ingredients
    ) {
    }
}
