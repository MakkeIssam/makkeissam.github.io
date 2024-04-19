<?php
$servername = "127.0.0.1";
$username = "root";
$password = "Projet!UGA";
$dbname = "messagerie";

// Connexion à la base de données
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Vérification de la connexion
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Récupérer les données d'identification soumises par l'utilisateur
$email = $_POST['email'];
$mdp_connexion = $_POST['mot_de_passe'];
// $mdp_connexion = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);

// Vérifier si les données d'identification sont valides
$query = "SELECT * FROM client WHERE email = '$email'";
$result = mysqli_query($conn, $query);

//$mdp_connexion
//$user['mdp']

if (mysqli_num_rows($result) > 0) {
    // L'utilisateur a été trouvé dans la base de données
    $user = mysqli_fetch_assoc($result);
	

// password_hash($user['mdp'], PASSWORD_DEFAULT))

    // Vérifier le mot de passe
    if (password_verify($mdp_connexion, $user['mdp'])) {
        // Les informations d'identification sont correctes
        // Créer une session utilisateur et rediriger vers la page d'accueil de l'espace membre
		
		echo "ca marche";
        session_start();
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['mail'] = $user['email'];
        header('Location: Page_membre.php');
        exit;
    } else {
        // Le mot de passe est incorrect

		echo "ca marche pas";
		
		$error = 'Mot de passe incorrect';
		header("Location: connexion_html.php?error=$error");

    }
} else {
    // L'utilisateur n'a pas été trouvé dans la base de données
    $error = 'Adresse e-mail inconnue';
	header("Location: connexion_html.php?error=$error");

}

// Afficher l'erreur s'il y en a une
if (isset($error)) {
    echo $error;
}
?>