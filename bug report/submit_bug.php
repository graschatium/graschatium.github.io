<?php
// Configuration de la base de données
$host = "localhost"; // Nom du serveur
$dbname = "graschatium"; // Nom de la base de données
$username = "root"; // Nom d'utilisateur de la base
$password = ""; // Mot de passe de la base

try {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Vérification que le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les données du formulaire
    $pseudo = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $bugType = htmlspecialchars($_POST['bug-type']);
    $description = htmlspecialchars($_POST['description']);
    $steps = isset($_POST['steps']) ? htmlspecialchars($_POST['steps']) : '';
    $screenshot = isset($_POST['screenshot']) ? htmlspecialchars($_POST['screenshot']) : '';

    try {
        // Insertion des données dans la base
        $stmt = $pdo->prepare("INSERT INTO bug_reports (pseudo, email, bug_type, description, steps, screenshot, submitted_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$pseudo, $email, $bugType, $description, $steps, $screenshot]);

        // Envoi d'un email de confirmation (optionnel)
        $to = "supportgraschatium@.gmail0com"; // Adresse email du support
        $subject = "Nouveau Bug Signalé - $bugType";
        $message = "Un nouveau bug a été signalé par $pseudo.\n\n"
                 . "Type de Bug: $bugType\n"
                 . "Description: $description\n\n"
                 . "Étapes: $steps\n"
                 . "Lien ou Capture: $screenshot\n\n"
                 . "Contact Email: $email";
        $headers = "From: no-reply@graschatium.com";

        mail($to, $subject, $message, $headers);

        // Redirection après succès
        header("Location: thank_you.html");
        exit;
    } catch (Exception $e) {
        echo "Erreur lors de l'enregistrement du rapport : " . $e->getMessage();
    }
} else {
    echo "Méthode non autorisée.";
}
?>
