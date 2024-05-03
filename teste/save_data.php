<?php
session_start();

// Connexion à la base de données (à adapter selon votre configuration)
// $servername = "localhost";
// $username = "black";
// $password = "black";
// $dbname = "mariage";

$servername = "localhost";
$username = "id22114064_black";
$password = "Azerty12345#";
$dbname = "id22114064_black";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];

// Vérifier si l'adresse e-mail existe déjà
$sql_check_email = "SELECT * FROM personne WHERE email = '$email'";
$result_check_email = $conn->query($sql_check_email);

if ($result_check_email->num_rows > 0) {
    // L'adresse e-mail existe déjà, afficher un message d'erreur
    echo "Votre email existe déjà.";
} else {
    // Insérer les données dans la base de données
    $sql_insert_user = "INSERT INTO personne (nom, prenom, email) VALUES ('$nom', '$prenom', '$email')";
    if ($conn->query($sql_insert_user) === TRUE) {
        echo "Votre inscription a été enregistrée avec succès.";

        // Fermer la fenêtre après 2 secondes
    //     echo "<script>";
    //     echo "setTimeout(function() { window.close(); }, 2000);";
    //     echo "</script>";
    } else {
        echo "Error: " . $sql_insert_user . "<br>" . $conn->error;
    }
}

// Fermer la connexion
$conn->close();
?>