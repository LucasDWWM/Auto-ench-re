<?php
// Connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "";
$base_de_donnees = "auto-enchère";

try {
    $connexion = new PDO("mysql:host=$serveur;dbname=$base_de_donnees", $utilisateur, $mot_de_passe);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Récupération des données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$mot_de_passe = $_POST['mot_de_passe'];

// Hashage du mot de passe
$mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

// Préparation de la requête d'insertion
$requete = $connexion->prepare("INSERT INTO utilisateur (Nom, Prenom, Email, MotDePasse) VALUES (?, ?, ?, ?)");

// Exécution de la requête
$resultat = $requete->execute([$nom, $prenom, $email, $mot_de_passe_hash]);

if ($resultat) {
    echo "Inscription réussie. Vous pouvez maintenant vous connecter.";
} else {
    echo "Erreur lors de l'inscription.";
}

// Fermeture de la connexion
$connexion = null;
?>
