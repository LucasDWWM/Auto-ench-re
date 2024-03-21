<?php
session_start();

// Vérification de la session pour s'assurer que l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: traitement_connexion.php");
    exit();
}

// Vérification si l'ID de l'annonce est passé dans l'URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p>Identifiant d'offre non valide.</p>";
    exit();
}

// Récupération de l'ID de l'annonce depuis l'URL
$annonceId = $_GET['id'];

// Connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = ""; // Mettez ici le mot de passe de votre base de données
$base_de_donnees = "auto-enchère";

try {
    $connexion = new PDO("mysql:host=$serveur;dbname=$base_de_donnees", $utilisateur, $mot_de_passe);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour récupérer les détails de l'offre
    $requete_offre = "SELECT * FROM annonces WHERE id_annonce = id_annonce";
    $statement = $connexion->prepare($requete_offre);
    $statement->bindParam('id_annonce', $annonceId);
    $statement->execute();

    // Vérifier si l'offre existe
    if ($statement->rowCount() > 0) {
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        echo "<h1>Détails de l'offre</h1>";
        echo "<p>Marque: {$row['Modele']}</p>";
        echo "<p>Modèle: {$row['Modele']}</p>";
        echo "<p>Année: {$row['année']}</p>";
        echo "<p>Puissance: {$row['Puissance']}</p>";
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
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>
