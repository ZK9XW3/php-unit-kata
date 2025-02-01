<?php

declare(strict_types=1);

namespace App\DTO\Response;

use App\Entity\Pizza;

final readonly class CommanderPizzaResponse
{
    /** @param array<int, Pizza> $pizzas */
    public function __construct(
        public string $numeroCommande,
        public array $pizzas,
        public float $sousTotal,
        public float $reduction,
        public float $prixTotal
    ) {
    }
}
