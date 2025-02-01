<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\Pizza\TailleType;

final class Pizza
{
    private string $nom;

    private ?float $prix;

    private ?bool $estVegetarien;

    private ?int $calories;

    private array $ingredients;

    private TailleType $taille;

    private const array PRIX_BASE = [
        TailleType::PETITE->value => 5,
        TailleType::MOYENNE->value => 8,
        TailleType::GRANDE->value => 12
    ];

    private const int QUANTITE_MAX_INGREDIENT = 2;

    private const int QUANTITE_MIN_INGREDIENTS = 0;

    private const int QUANTITE_MAX_TOTAL_INGREDIENTS = 10;

    public function __construct(
        string $nom,
        TailleType $taille
    )
    {
        $this->nom = $nom;
        $this->taille = $taille;
        $this->prix = self::PRIX_BASE[$taille->value];
        $this->estVegetarien = null;
        $this->calories = null;
        $this->ingredients = [];
    }

    public function ajouterIngredient(Ingredient $ingredient, int $quantite): void
    {
        if ($quantite <= self::QUANTITE_MIN_INGREDIENTS) {
            throw new \InvalidArgumentException('La quantité doit être supérieure à '.self::QUANTITE_MIN_INGREDIENTS);
        }

        if ($quantite > self::QUANTITE_MAX_INGREDIENT) {
            throw new \InvalidArgumentException('La quantité d\'un ingredient doit être inférieure ou égale à '.self::QUANTITE_MAX_INGREDIENT);
        }

        if (count($this->ingredients) >= self::QUANTITE_MAX_TOTAL_INGREDIENTS) {
            throw new \InvalidArgumentException('Vous ne pouvez pas ajouter plus de '.self::QUANTITE_MAX_TOTAL_INGREDIENTS.' ingrédients');
        }

        $this->ingredients[] = [
            'ingredient' => $ingredient,
            'quantite' => $quantite
        ];
    }

    public function calculerPrix(): void
    {
        foreach ($this->ingredients as $ingredient) {
            $this->prix += $ingredient['ingredient']->getPrix() * $ingredient['quantite'];
        }
    }

    public function calculerCalories(): void
    {
        $calories = 0;
        foreach ($this->ingredients as $ingredient) {
            $calories += $ingredient['ingredient']->getCalories() * $ingredient['quantite'];
        }
        $this->calories = $calories;
    }

    public function estVegetarienne(): void
    {
        $estVegetarien = true;
        foreach ($this->ingredients as $ingredient) {
            if (!$ingredient['ingredient']->isEstVegetarien()) {
                $estVegetarien = false;
                break;
            }
        }
        $this->estVegetarien = $estVegetarien;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function getEstVegetarien(): ?bool
    {
        return $this->estVegetarien;
    }

    public function getCalories(): ?int
    {
        return $this->calories;
    }

    public function getIngredients(): array
    {
        return $this->ingredients;
    }

    public function getTaille(): TailleType
    {
        return $this->taille;
    }
}