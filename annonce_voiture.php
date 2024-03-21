<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>
<body>
<form action="traitement_annonce.php" method="post">
    <label for="modele">Modèle :</label>
    <input type="text" id="modele" name="modele" required><br>
    
    <label for="marque">Marque :</label>
    <input type="text" id="marque" name="marque" required><br>
    
    <label for="puissance">Puissance :</label>
    <input type="text" id="puissance" name="puissance" required><br>
    
    <label for="annee">Année :</label>
    <input type="text" id="annee" name="annee" required><br>
    
    <label for="description">Description :</label><br>
    <textarea id="description" name="description" required></textarea><br>
    
    <label for="prix_reserve">Prix de réserve :</label>
    <input type="number" id="prix_reserve" name="prix_reserve" required><br>
    
    <label for="date_fin">Date de fin des enchères :</label>
    <input type="datetime-local" id="date_fin" name="date_fin" required><br>
    
    <input type="submit" value="Ajouter l'annonce">
</form>

</body>
</html>