<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\Commande;

final readonly class Reduction
{
    private const int REDUCTION_POURCENTAGE = 10;

    private const int PRIX_COMMANDE_MINI_REDUCTION = 50;

    public function appliquerReduction(Commande $commande): float
    {
        $reduction = $this->calculerReduction($commande);

        if ($reduction === 0) {
            return $commande->getPrix();
        }

        return $commande->getPrix() - $reduction;
    }

    public function calculerReduction(Commande $commande): float
    {
        if ($commande->getPrix() < self::PRIX_COMMANDE_MINI_REDUCTION) {
            return 0;
        }

        return $commande->getPrix() * self::REDUCTION_POURCENTAGE / 100;
    }
}