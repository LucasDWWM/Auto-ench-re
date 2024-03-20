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
$modele = $_POST['modele'];
$marque = $_POST['marque'];
$puissance = $_POST['puissance'];
$annee = $_POST['annee'];
$description = $_POST['description'];
$prix_reserve = $_POST['prix_reserve'];
$date_fin = $_POST['date_fin'];

// Insérer le véhicule dans la base de données
$requete_vehicule = $connexion->prepare("INSERT INTO vehicule (Modele, Marque, Puissance, année, description) VALUES (?, ?, ?, ?, ?)");
$requete_vehicule->execute([$modele, $marque, $puissance, $annee, $description]);
$id_vehicule = $connexion->lastInsertId();

// Vérifiez si l'utilisateur est connecté
session_start();
if (!isset($_SESSION['id_utilisateur'])) {
    // Redirigez l'utilisateur vers la page de connexion ou affichez un message d'erreur
    exit("Vous devez être connecté pour ajouter une annonce.");
}

// Récupérez l'ID de l'utilisateur à partir de la session
$id_utilisateur = $_SESSION['id_utilisateur'];

// Insérer l'annonce dans la base de données
$requete_annonce = $connexion->prepare("INSERT INTO annonces (id_utilisateur, id_vehicule, prix_reserve, date_fin) VALUES (?, ?, ?, ?)");
$requete_annonce->execute([$id_utilisateur, $id_vehicule, $prix_reserve, $date_fin]);

echo "Annonce de voiture ajoutée avec succès.";

// Fermeture de la connexion
$connexion = null;
?>
