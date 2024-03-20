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
        // Vérifier si la clé existe avant de l'afficher
        echo "<strong>Marque:</strong> " . (isset($row['marque']) ? $row['marque'] : 'A') . " Test 1 ";
        echo "<strong>Modèle:</strong> " . (isset($row['modele']) ? $row['modele'] : 'B') . " Test 2 ";
        echo "<strong>Année:</strong> " . (isset($row['annee']) ? $row['annee'] : 'C') . " Test 3 ";
        echo "<strong>Puissance:</strong> " . (isset($row['puissance']) ? $row['puissance'] : 'D') . " Test 4 ";
        echo "<strong>Description:</strong> " . (isset($row['description']) ? $row['description'] : 'Voici une description');
        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>Aucune offre disponible pour le moment.</p>";
}

// Fermer la connexion à la base de données
$connexion->close();
?>
