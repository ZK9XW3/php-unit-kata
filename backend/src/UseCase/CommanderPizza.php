<?php

declare(strict_types=1);

namespace App\UseCase;

use App\DTO\Request\CommanderPizzaRequest;
use App\DTO\Request\PizzaRequest;
use App\DTO\Response\CommanderPizzaResponse;
use App\Entity\Commande;
use App\Entity\Ingredient;
use App\Entity\Pizza;
use App\Manager\Reduction;

final readonly class CommanderPizza
{
    public function __construct(private Reduction $reduction)
    {
    }

    public function __invoke(CommanderPizzaRequest $request): CommanderPizzaResponse
    {
        $commande = new Commande();

        foreach ($request->pizzas as $pizzaRequest) {
            $pizzaBase = $this->creerPizzaBase($pizzaRequest);
            $pizzaAvecIngredients = $this->ajouterIngredients($pizzaBase, $pizzaRequest);
            $pizzaAvecIngredients->calculerPrix();
            $pizzaAvecIngredients->estVegetarienne();

            $commande->ajouterPizza($pizzaAvecIngredients, $pizzaRequest->quantite);
        }

        $commande->calculerPrixTotal();

        $sousTotal = $commande->getPrix();
        $reduction = $this->reduction->calculerReduction($commande);
        $prixTotal = $this->reduction->appliquerReduction($commande);

        $pizzasDetails = $this->prepareCommandeDetails($commande);

        return new CommanderPizzaResponse(
            numeroCommande: $commande->getNumeroCommande(),
            pizzas: $pizzasDetails,
            sousTotal: $sousTotal,
            reduction: $reduction,
            prixTotal: $prixTotal,
        );
    }

    /** Ajoute les ingredients demandée à la pizza de base */
    private function ajouterIngredients(Pizza $pizzaBase, PizzaRequest $request): Pizza
    {
        foreach ($request->ingredients as $ingredient) {
            $newIngredient = new Ingredient(
                nom: $ingredient->nom,
                prix: $ingredient->prix,
                estVegetarien: $ingredient->estVegetarien,
            );

            $pizzaBase->ajouterIngredient(
                ingredient: $newIngredient,
                quantite: $ingredient->quantite,
            );
        }

        return $pizzaBase;

    }

    private function creerPizzaBase(PizzaRequest $request): Pizza
    {
        return new Pizza(
            nom: $request->nom,
            taille: $request->taille,
        );
    }

    /**
     * @param Commande $commande
     * @return array
     */
    public function prepareCommandeDetails(Commande $commande): array
    {
        $pizzasDetails = [];
        foreach ($commande->getPizzas() as $index => $pizza) {
            $pizzasDetails[$index]['nom'] = $pizza->getNom();
            $pizzasDetails[$index]['taille'] = $pizza->getTaille();
            $pizzasDetails[$index]['prix'] = $pizza->getPrix();
            $pizzasDetails[$index]['vegetarienne'] = $pizza->getEstVegetarien();
        }
        return $pizzasDetails;
    }
}
