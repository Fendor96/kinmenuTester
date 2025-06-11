<?php
require_once '../connexion/connexion.php';
require_once '../configuration/error_log.php';
require_once '../configuration/eventManager.php';


class restauDataController {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function searchRestaurants($criteria) {
        $sql = "SELECT * FROM restaurants WHERE 1=1"; // Start with a true condition
        $params = [];

        // Apply filters based on criteria
        if (!empty($criteria['name'])) {
            $sql .= " AND name LIKE :name";
            $params[':name'] = '%' . $criteria['name'] . '%';
        }
        if (!empty($criteria['commune'])) {
            $sql .= " AND commune LIKE :commune";
            $params[':commune'] = '%' . $criteria['commune'] . '%';
        }
        if (!empty($criteria['restaurantType'])) {
            $sql .= " AND type_restaurant LIKE :restaurantType";
            $params[':restaurantType'] = '%' . $criteria['restaurantType'] . '%';
        }
        if (!empty($criteria['rankType'])) {
            // Assuming rankType is an exact match for A, B, C, S
            $sql .= " AND rank_type = :rankType";
            $params[':rankType'] = $criteria['rankType'];
        }

        // Budget filter (price per person <= budget per person)
        // Ensure budget is set and is a valid number
        if (isset($criteria['budgetPerPerson']) && is_numeric($criteria['budgetPerPerson']) && $criteria['budgetPerPerson'] > 0) {
            $sql .= " AND prix_moyen <= :budgetPerPerson";
            $params[':budgetPerPerson'] = $criteria['budgetPerPerson'];
        }

        // Datable filter
        if (isset($criteria['isDatable']) && $criteria['isDatable'] === true) {
            $sql .= " AND isDatable = 1"; // Assuming 1 for true, 0 for false
        }

        // Order results if desired (e.g., by average price, name)
        $sql .= " ORDER BY name ASC"; // Example ordering

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_logs("Database Error in searchRestaurants: " . $e->getMessage());
            // In a real application, you might throw a custom exception or return an error flag
            return false; // Indicate failure
        }
    }
}
// --- END restauDataController Class Definition ---
?>