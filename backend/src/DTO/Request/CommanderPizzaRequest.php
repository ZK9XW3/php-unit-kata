<?php

declare(strict_types=1);

namespace App\DTO\Request;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class CommanderPizzaRequest
{
    /** @param array<int, PizzaRequest>$pizzas */
    public function __construct(
        #[Assert\NotBlank]
        public array $pizzas,
    ) {
    }
}
