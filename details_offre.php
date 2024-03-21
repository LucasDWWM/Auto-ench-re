<?php
session_start();

// Vérification de la session pour s'assurer que l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: traitement_connexion.php");
    exit();
}

// Connexion à la base de données (simulée)
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "";
$base_de_donnees = "auto-enchère";

// Fonction pour obtenir les détails d'une offre à partir de l'ID
function getOffreDetails($id) {
    // Simulation de la récupération des détails depuis la base de données
    $offres = [
        1 => [
            'marque' => 'Toyota',
            'modele' => 'Corolla',
            'annee' => 2018,
            'puissance' => '120 ch',
            'description' => 'Belle Toyota Corolla en excellent état.',
            'date_fin' => '2024-03-25 12:00:00' // Date limite des enchères
        ],
        2 => [
            'marque' => 'BMW',
            'modele' => 'Series 3',
            'annee' => 2020,
            'puissance' => '180 ch',
            'description' => 'Superbe BMW Series 3, parfait pour les amateurs de conduite sportive.',
            'date_fin' => '2024-03-30 18:00:00' // Date limite des enchères
        ],
        3 => [
            'marque' => 'Honda',
            'modele' => 'Civic',
            'annee' => 2020,
            'puissance' => '150 ch',
            'description' => 'Superbe Honda Civic avec un moteur puissant.',
            'date_fin' => '2024-04-01 15:30:00' // Date limite des enchères
        ],
        4 => [
            'marque' => 'Volkswagen',
            'modele' => 'Golf',
            'annee' => 2019,
            'puissance' => '110 ch',
            'description' => 'Volkswagen Golf en très bon état, idéale pour la conduite quotidienne.',
            'date_fin' => '2024-04-05 10:00:00' // Date limite des enchères
        ],
    ];

    // Vérifier si l'offre existe dans notre simulation
    if (array_key_exists($id, $offres)) {
        return $offres[$id];
    } else {
        return false; // Retourner false si l'offre n'existe pas
    }
}

// Vérifier si l'identifiant de l'offre est passé dans l'URL et est un nombre valide
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $annonceId = $_GET['id'];

    // Obtenir les détails de l'offre à partir de son ID
    $offre = getOffreDetails($annonceId);

    // Vérifier si l'offre existe
    if ($offre) {
        // Afficher les détails de l'offre
        echo "<h1>Détails de l'offre</h1>";
        echo "<p>Marque: {$offre['marque']}</p>";
        echo "<p>Modèle: {$offre['modele']}</p>";
        echo "<p>Année: {$offre['annee']}</p>";
        echo "<p>Puissance: {$offre['puissance']}</p>";
        echo "<p>Description: {$offre['description']}</p>";

        // Vérifier si la date limite d'enchère est dépassée
        if (strtotime($offre['date_fin']) < time()) {
            echo "<p>La date limite d'enchère est dépassée.</p>";
        } else {
            echo "<p>Enchères en cours jusqu'à {$offre['date_fin']}</p>";
        }
    } else {
        echo "<p>Aucune offre trouvée pour l'identifiant donné.</p>";
    }
} else {
    echo "<p>Identifiant d'offre non valide.</p>";
}

// Logique pour supprimer une offre
if (isset($_POST['delete_offer']) && isset($_POST['offer_id']) && is_numeric($_POST['offer_id'])) {
    $offer_id = $_POST['offer_id'];

    // Ajoutez ici la logique pour supprimer l'offre avec l'ID $offer_id de la base de données
    // Vous devez remplacer cette partie avec votre propre logique de suppression
    echo "L'offre avec l'ID {$offer_id} a été supprimée avec succès.";
}
?>
