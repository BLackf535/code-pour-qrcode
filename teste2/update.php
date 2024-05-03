<?php
session_start();

// Vérifier si l'email est présent dans la session
if (isset($_SESSION['email'])) {
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

    // Récupérer l'e-mail de l'utilisateur à mettre à jour
    $email = $_SESSION['email'];
    $nom = $_SESSION['nom'];

    // Mettre à jour le statut dans la table
    $sql_update_status = "UPDATE personne2 SET statut = 0 , email = '$email' WHERE nom = '$nom'";

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

    // Retourner la réponse au format JSON
    echo json_encode($response);
} else {
    // Si l'email n'est pas présent dans la session, renvoyer un message d'erreur
    echo json_encode(array("success" => false, "message" => "Erreur: Email non trouvé dans la session."));
}
?>
