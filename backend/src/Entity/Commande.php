<?php

declare(strict_types=1);

namespace App\Entity;

final class Commande
{
    private array $pizzas;

    private string $numeroCommande;

    private ?float $prix;

    public function __construct()
    {
        $this->pizzas = [];
        $this->numeroCommande = new \DateTime('now')->format('YmdHis');
        $this->prix = null;
    }

    public function ajouterPizza(Pizza $pizza, int $quantite): void
    {
        for ($i = 0; $i < $quantite; $i++) {
            $this->pizzas[] = $pizza;
        }
    }

    public function calculerPrixTotal(): void
    {
        $prixTotal = 0;
        foreach ($this->pizzas as $pizza) {
            $prixTotal += $pizza->getPrix();
        }

        $this->prix = $prixTotal;
    }

    public function getPizzas(): array
    {
        return $this->pizzas;
    }

    public function getNumeroCommande(): string
    {
        return $this->numeroCommande;
    }

    public function getPrix(): float
    {
        return $this->prix;
    }
}
