<?php
session_start();

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

// Récupérer les données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];

// Vérifier si le nom et le prénom existent dans la base de données
$sql_check_user = "SELECT * FROM personne2 WHERE nom = '$nom' AND prenom = '$prenom'";

$result_check_user = $conn->query($sql_check_user);

if ($result_check_user->num_rows > 0) {
    $row = $result_check_user->fetch_assoc(); // Extraire les données de la première ligne
    $e = $row['email']; // Récupérer l'email de la ligne
    $s = $row['statut']; // Récupérer le statut de la ligne

    // Nom et prénom existent dans la base de données
    if ($s == 0 && $e != '') {
        $response = array(
            "success" => false,
            "message" => "Vous êtes déjà enregistré."
        );
    } elseif ($s == 1 && $e == '') {
        $_SESSION['email'] = $email; // Stocker l'email dans la session pour y accéder plus tard
        $_SESSION['nom'] = $nom; // Stocker le nom dans la session pour y accéder plus tard
        $_SESSION['prenom'] = $prenom; // Stocker le nom dans la session pour y accéder plus tard
        $response = array(
            "success" => true,
            "message" => "Confirmez votre présence.",
            "email" => $email,
            "nom" => $nom
        );
    } else {
        $response = array(
            "success" => false,
            "message" => "Désolé, votre nom et prénom ne font pas partie des invités de la liste. Veuillez contacter les mariés s'il y a une erreur."
        );
    }
} else {
    // Nom et prénom ne correspondent pas à ceux de la liste des invités
    $response = array(
        "success" => false,
        "message" => "Désolé, votre nom et prénom ne font pas partie  de la liste. Mais nous alons vous ajoute sur une liste provisoire.",
        "email" => $email,
        "nom" => $nom,
        "prenom" => $prenom
    );
}

// Retourner la réponse au format JSON
echo json_encode($response);

// Fermer la connexion
$conn->close();
?>
