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

// Préparation de la requête d'insertion
$requete = $connexion->prepare("INSERT INTO vehicule (Modele, Marque, Puissance, année, description) VALUES (?, ?, ?, ?, ?)");
$requete->execute([$modele, $marque, $puissance, $annee, $description]);

$id_vehicule = $connexion->lastInsertId(); // Récupérer l'ID de la voiture insérée

// Insérer l'annonce dans la base de données
$requete_annonce = $connexion->prepare("INSERT INTO annonces (id_vehicule, prix_reserve, date_fin) VALUES (?, ?, ?)");
$requete_annonce->execute([$id_vehicule, $prix_reserve, $date_fin]);

echo "Annonce de voiture ajoutée avec succès.";

// Fermeture de la connexion
$connexion = null;
?>
