<?php

declare(strict_types=1);

namespace App\Entity;

final class Ingredient
{
    private string $nom;

    private int $prix;

    private bool $estVegetarien;

    public function __construct(string $nom, int $prix, bool $estVegetarien)
    {
        $this->nom = $nom;
        $this->prix = $prix;
        $this->estVegetarien = $estVegetarien;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrix(): int
    {
        return $this->prix;
    }

    public function isEstVegetarien(): bool
    {
        return $this->estVegetarien;
    }
}