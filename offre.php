<?php
session_start();

// Vérification de la session pour s'assurer que l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: traitement_connexion.php");
    exit();
}

// Connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = ""; // Mettez ici le mot de passe de votre base de données
$base_de_donnees = "auto-enchère";

$connexion = new mysqli($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données: " . $connexion->connect_error);
}

// Récupérer les détails de l'offre à partir de l'identifiant passé dans l'URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $annonceId = $_GET['id'];

    // Requête pour récupérer les détails de l'offre
    $requete_offre = "SELECT * FROM annonces WHERE id_annonce = $annonceId";
    $resultat_offre = $connexion->query($requete_offre);

    // Vérifier si l'offre existe
    if ($resultat_offre->num_rows > 0) {
        $row = $resultat_offre->fetch_assoc();
        echo "<h1>Détails de l'offre</h1>";
        echo "<p>Marque: {$row['marque']}</p>";
        echo "<p>Modèle: {$row['modele']}</p>";
        echo "<p>Année: {$row['annee']}</p>";
        echo "<p>Puissance: {$row['puissance']}</p>";
        echo "<p>Description: {$row['description']}</p>";

        // Vérifier si la date limite d'enchère est dépassée
        if (strtotime($row['date_fin']) < time()) {
            echo "<p>La date limite d'enchère est dépassée.</p>";
            // Afficher le nom du gagnant de l'enchère
            echo "<p>Gagnant de l'enchère: {$row['id_gagnant']}</p>";
        } else {
            echo "<p>Enchères en cours jusqu'à {$row['date_fin']}</p>";
        }
    } else {
        echo "<p>Aucune offre trouvée.</p>";
    }
} else {
    echo "<p>Identifiant d'offre non valide.</p>";
}

// Fermer la connexion à la base de données
$connexion->close();
?>
