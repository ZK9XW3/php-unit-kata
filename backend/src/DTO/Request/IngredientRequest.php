<?php

declare(strict_types=1);

namespace App\DTO\Request;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class IngredientRequest
{
    public function __construct(
        #[Assert\NotBlank]
        public string $nom,
        #[Assert\NotBlank]
        public int $quantite,
        #[Assert\NotBlank]
        public int $prix,
        #[Assert\NotBlank]
        public bool $estVegetarien
    ) {
    }
}
