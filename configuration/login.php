<?php
session_start();
header('Content-Type: application/json');
require_once '../connexion/connexion.php';
require_once 'error_log.php';
require_once 'eventManager.php';

$response = [
    'success'=> false,
    'message'=>'',
    'redirect'=>''
];

try {
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $userId = trim($_POST['userId']) ?? '';
        $password = $_POST['password'] ?? '';

        if(empty($userId) || empty($password)){
            $response['message']= "Veuillez remplir les deux champs";
            echo json_encode($response);
            exit;
        }

        $sql = "SELECT id, email, username, password FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':email' => $userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user){
            if(password_verify($password, $user['password'])){
                $_SESSION['username'] = $user['username'];
                session_regenerate_id(true);

                $response['success'] = true;    
                $response['redirect'] = "../pagesLogged/home.php";
                logActivity($conn, $user['id'], 'connexion_reussie', "Connexion réussie pour " . $user['email'], null);
            } else {
                $response['message'] = "Mot de passe incorrect";
                error_logs('Mauvais mot de passe pour ' . $userId);
            }
        } else {
            $response['message'] = "L'utilisateur entré n'existe pas";
            error_logs('Utilisateur introuvable pour : ' . $userId);
        }
    } else {
        $response['message'] = "Requête invalide.";
    }
} catch(PDOException $e){
    $response['message'] = "Une erreur s'est produite";
    error_logs('Erreur PDOEXCEPTION lors du LOGIN : ' . $e->getMessage());
}

echo json_encode($response);
exit;
?>
