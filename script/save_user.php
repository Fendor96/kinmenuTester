<?php
// Connexion à la base
$pdo = new PDO('mysql:host=localhost;dbname=kinmenudb', 'root', '');
$input = json_decode(file_get_contents('php://input'), true);

// Sécurisation des entrées
$uid = htmlspecialchars($input['uid']);
$name = htmlspecialchars($input['name']);
$email = htmlspecialchars($input['email']);

// Vérifier si l'utilisateur existe déjà
$stmt = $pdo->prepare("SELECT * FROM user WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if (!$user) {
    // Insérer le nouvel utilisateur
    $insert = $pdo->prepare("INSERT INTO user (google_id, name, email) VALUES (?, ?, ?)");
    $insert->execute([$uid, $name, $email]);
    echo "Utilisateur ajouté.";
} else {
    echo "Utilisateur déjà existant.";
}
?>
