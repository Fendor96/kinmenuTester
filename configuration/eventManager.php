<?php

require_once '../connexion/connexion.php'; 
require_once 'error_log.php';
function logActivity($pdo, $userId, $activityType, $description, $ipAddress = null) {
    if ($ipAddress === null) {
        $ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
    }

    try {
        $sql = "INSERT INTO logs_activites (utilisateur_id, type_activite, description, adresse_ip)
                VALUES (:userId, :activityType, :description, :ipAddress)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':userId' => $userId,
            ':activityType' => $activityType,
            ':description' => $description,
            ':ipAddress' => $ipAddress
        ]);
    } catch (PDOException $e) {
        // Important : ne pas faire échouer l'opération principale si la journalisation échoue
        error_logs("Erreur lors de l'enregistrement de l'activité: " . $e->getMessage());
    }
}



?>