<?php
// Connexion à la base de données (à adapter selon votre configuration)
$servername = "localhost";
$username = "black";
$password = "black";
$dbname = "mariage2";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les données du formulaire (par exemple)
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];

// Préparer la requête SQL d'insertion
$sql = "INSERT INTO listpro (nom, prenom, email) VALUES ('$nom', '$prenom', '$email')";

// Exécuter la requête et vérifier si l'insertion a réussi
if ($conn->query($sql) === TRUE) {
    echo "Nouvel enregistrement créé avec succès!";
} else {
    echo "Erreur: " . $sql . "<br>" . $conn->error;
}

// Fermer la connexion
$conn->close();
?>
