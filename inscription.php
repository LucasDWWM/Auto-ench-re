<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="styles.css">
    <title>Inscription</title>
</head>
<body>
    <h1>Inscription</h1>
    <form action="traitement_inscription.php" method="POST">
        <div>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required><br><br>
        </div>
        <div>
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required><br><br>
        </div>
        <div>
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required><br><br>
        </div>
        <div>
            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required><br><br>
        </div>
        <input type="submit" value="S'inscrire"><br><br>
    </form>
</body>
</html>
