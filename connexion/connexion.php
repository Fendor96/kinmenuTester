<?php 

$host = "localhost";
$dbanme = "resto_kin_db";
$user = "root";
$password = "";

function ErroLogs($message){
    $date =  date("Y-m-d H:i:s");
    file_put_contents('errorsLogs.txt'," [$date] $message" . PHP_EOL, FILE_APPEND);
}


try{

    $conn = new PDO("mysql:host=$host;dbname=$dbanme;charset=utf8", $user, $password);
    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){
    ErroLogs("Erreur lors de la connexion à la base de données: " . $e->getMessage());
}



?>