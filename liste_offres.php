<?php
// Connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "";
$base_de_donnees = "auto-enchère";

$connexion = new mysqli($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données: " . $connexion->connect_error);
}

// Récupérer toutes les offres depuis la base de données
$requete_offres = "SELECT * FROM annonces";
$resultat_offres = $connexion->query($requete_offres);

// Vérifier si des offres sont disponibles
if ($resultat_offres->num_rows > 0) {
    echo "<h1>Liste des offres disponibles :</h1>";
    echo "<ul>";
    // Parcourir les résultats et afficher chaque offre dans une liste
    while ($row = $resultat_offres->fetch_assoc()) {
        echo "<li>";
        // Afficher les détails de l'offre avec un lien vers la page d'offre
       // On crée un lien vers offre.php avec l'ID de l'annonce en tant que paramètre GET
        echo "<strong>Marque:</strong> <a href='offre.php?id={$row['id_annonce']}'>{$row['marque']}</a> - ";
        echo "<strong>Modèle:</strong> {$row['modele']} - ";
        echo "<strong>Année:</strong> {$row['annee']} - ";
        echo "<strong>Puissance:</strong> {$row['puissance']} - ";
        echo "<strong>Description:</strong> {$row['description']}";
        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>Aucune offre disponible pour le moment.</p>";
}

// Fermer la connexion à la base de données
$connexion->close();
?>
