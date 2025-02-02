# El Pizza de tu Papi Chulo

## Regles Metier
- Une pizza à une taille et un prix de base lié à cette taille
- Une pizza peut avoir des ingrédients
- Un ingrédient a un prix et est végétarien ou non
- Un ingrédient peut être ajouté à une pizza en quantité de 0 à 2
- Si un ingrédient n'est pas végétarien la pizza ne peut pas être végétarienne
- Une pizza ne peut pas avoir plus de 10 ingrédients
- Le prix d'une pizza est calculé en fonction du prix de base et du prix des ingrédients

## Regles métier supplémentaires
- Un ingredient peut avoir un nombre de calories défini
- Le nombre de calories d'une pizza est calculé en fonction du nombre de calories de la pizza et du nombre de calories des ingrédients
- On peut ajouter des codes promos de manière optionnelle
    - Si un code promo il doit être appliqué à la commande et le prix de la commande doit être ajustée en fonction
- On peut sélectionner une pizza déjà existante : dans ce cas la liste des ingrédients est définie par défaut

## Tests à mettre en place
### Pizza
- On peut créer une pizza
- On peut ajouter des ingrédients à une pizza
- Chaque ingrédient ajouté peut être de quantité comprise entre 0 et 2
- Si un ingrédient n'est pas végétarien la pizza ne peut pas être végétarienne
- On peut calculer le prix d'une pizza en fonction du prix et de la quantité des ingrédients

### Ingredient
- On peut créer des ingrédients

### Commande
- On peut créer une commande
- On peut calculer le prix total d'une commande en fonction des pizzas contenue dans la commande
- On applique automatiquement une réduction de 10% si le montant total de la commande est supérieur à 50€