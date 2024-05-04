<?php
session_start();

// Vérifier si l'e-mail et le nom sont présents dans la session
if (isset($_SESSION['email']) && isset($_SESSION['nom'])) {
    // Récupérer les données de la session
    $email = $_SESSION['email'];
    $nom = $_SESSION['nom'];

    // Connexion à la base de données (à adapter selon votre configuration)
    $servername = "localhost";
    $username = "black";
    $password = "black";
    $dbname = "mariage2";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Mettre à jour le statut dans la table
    $sql_update_status = "UPDATE personne2 SET statut = 0, email = '$email' WHERE nom = '$nom'";

    if ($conn->query($sql_update_status) === TRUE) {
        $response = array(
            "success" => true,
            "message" => "Votre présence a été confirmée avec succès!"
        );
    } else {
        $response = array(
            "success" => false,
            "message" => "Erreur lors de la mise à jour du statut: " . $conn->error
        );
    }

    // Fermer la connexion
    $conn->close();
} else {
    // Si l'e-mail ou le nom ne sont pas présents dans la session, renvoyer un message d'erreur
    $response = array(
        "success" => false,
        "message" => "Erreur: Email ou nom non trouvés dans la session."
    );
}

// Retourner la réponse au format JSON
echo json_encode($response);
?>
