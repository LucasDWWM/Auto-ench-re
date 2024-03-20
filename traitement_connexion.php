<?php
session_start();

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
$email = $_POST['email'];
$mot_de_passe = $_POST['mot_de_passe'];

// Requête pour récupérer l'utilisateur
$requete = $connexion->prepare("SELECT * FROM utilisateur WHERE Email = ?");
$requete->execute([$email]);
$utilisateur = $requete->fetch(PDO::FETCH_ASSOC);

if ($utilisateur && password_verify($mot_de_passe, $utilisateur['MotDePasse'])) {
    // Authentification réussie, enregistrer les données de l'utilisateur en session
    $_SESSION['id_utilisateur'] = $utilisateur['id_utilisateur'];
    $_SESSION['nom'] = $utilisateur['Nom'];
    $_SESSION['prenom'] = $utilisateur['Prenom'];
    echo "Connexion réussie. Bienvenue, " . $_SESSION['prenom'] . " " . $_SESSION['nom'] . ".";
} else {
    echo "Identifiants invalides.";
}

// Fermeture de la connexion
$connexion = null;
?>
