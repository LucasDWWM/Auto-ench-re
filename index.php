<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de contact</title>
</head>
<body>
    <h1>Contactez-nous</h1>
    <form action="/contact.php" method="POST">
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
            <label for="telephone">Numéro de téléphone :</label>
            <input type="tel" id="telephone" name="telephone" required>
        </div>
        <div>
            <label for="message">Message :</label><br>
            <textarea id="message" name="message" rows="4" cols="50" required></textarea><br><br>
        </div>

        <input type="submit" value="Envoyer">
    </form>
</body>
</html>