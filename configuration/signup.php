<?php

use Google\Service\OSConfig\CancelPatchJobRequest;
header('Content-Type:application/json');
require_once '../connexion/connexion.php';
require_once 'error_log.php';
require_once 'eventManager.php';

session_start();

$response = [
    'success'=> false,
    'message'=> '',
    'redirect' => ''
];


try {

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $email = trim($_POST['email']) ?? '';
        $username = trim($_POST['username']) ?? '';
        $password = $_POST['password'] ?? '';

        if(empty($email) || empty($password)){
            $response['message'] = "Les champs Email & Mot de passes sont obligatoires";
            exit;
        }

        function createSlug($string){
            $slug = strtolower(trim($string));
            $slug = preg_replace('/[^a-z0-9]/', '-', $slug);
            $slug = preg_replace('/-+/', '-', $slug);
            return $slug;

        }

        $slug = createSlug($email);

        try {

            //vérification des email existants 
            $checkEmail = $conn->prepare("SELECT email from users where email = :email");
            $checkEmail->execute([':email'=> $email]);

            if($checkEmail->rowCount() > 0){
                $response['message'] = 'Un utilisateur existe déjà avec cet email';
                exit;
            }

            $password_hash = password_hash($password, PASSWORD_DEFAULT);


            //insertion dans la bdd
            $sql = "INSERT INTO users (email,username,password,slug) VALUES (:email, :username, :password, :slug)";
            $stmnt = $conn->prepare($sql);
            $stmnt->execute([':email'=> $email, ':username'=> $username, ':password'=>$password_hash, ':slug'=>$slug]);

            $response['message']="Enregistré avec succès";
            $response['success']=true;
            $response['redirect']="../pagesLogged/home.php";
            $_SESSION['name'] = $username;
            $_SESSION['slug'] = $slug;
            logActivity($conn,null,'compte_cree',"création d'un comptre pour" . $email, null);
            
        }catch(PDOException $e){
            $response['message'] = "Erreur innatendue" . $e->getMessage();
            error_logs("Erreur lors de l'insertion des données de journalisation" . $e->getMessage());
        }

    }

}catch(PDOException $e){
    $response ['message'] = "Erreur innatendue";
    error_logs('Erreur unnatendue' . $e->getMessage());
}

echo json_encode($response);
exit;


?>