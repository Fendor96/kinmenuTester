<?php
// apiRestau.php
session_start(); // If you need session data for user context
header('Content-Type: application/json');

require_once '../configuration/restauDataController.php';
require_once '../connexion/connexion.php'; // Your PDO connection
require_once '../configuration/error_log.php'; // Your custom error logger

// Assume restauDataController.php is where your class is defined
// If restauDataController is in the same file, you don't need this include.
// For better organization, it's good practice to have classes in separate files.
// For this example, I'll put the class definition directly in this file for simplicity,
// but you should move it to restauDataController.php if you intend to include it.

/*
// If you want to keep the class in a separate file (recommended):
require_once 'restauDataController.php'; // Adjust path if necessary
*/

// --- restauDataController Class Definition (Move to restauDataController.php) ---

$response = [
    'success' => false,
    'message' => 'An unknown error occurred.',
    'restaurants' => []
];

// Get raw JSON POST data
$input = file_get_contents('php://input');
$data = json_decode($input, true); // Decode as associative array

// Validate input data
if (!isset($data)) {
    $response['message'] = 'Invalid JSON input.';
    echo json_encode($response);
    exit;
}

// Initialize criteria with defaults or nulls
$criteria = [
    'name' => $data['name'] ?? null,
    'commune' => $data['commune'] ?? null,
    'restaurantType' => $data['restaurantType'] ?? null,
    'rankType' => $data['rankType'] ?? null,
    'budgetInput' => $data['budgetInput'] ?? null, // Raw budget from user
    'numberOfPeople' => $data['numberOfPeople'] ?? null, // Number of people
    'isDatable' => $data['isDatable'] ?? false // Boolean for datable filter
];

// Calculate budget per person if budget and number of people are provided
$budgetPerPerson = null;
if (is_numeric($criteria['budgetInput']) && $criteria['budgetInput'] > 0 &&
    is_numeric($criteria['numberOfPeople']) && $criteria['numberOfPeople'] > 0) {
    $budgetPerPerson = $criteria['budgetInput'] / $criteria['numberOfPeople'];
}
$criteria['budgetPerPerson'] = $budgetPerPerson; // Add to criteria for the SQL query

try {
    $restauController = new restauDataController($conn); // $conn should be your PDO instance from connexion.php

    $restaurants = $restauController->searchRestaurants($criteria);

    if ($restaurants === false) {
        // searchRestaurants returned false, indicating a DB error
        $response['message'] = 'Could not fetch restaurants due to a database error.';
    } elseif ($restaurants === null) {
        // searchRestaurants returned null, indicating no matching restaurants
        $response['message'] = 'No restaurants found matching your criteria.';
    } else {
        $response['success'] = true;
        $response['restaurants'] = $restaurants;
        if (empty($restaurants)) {
            $response['message'] = 'No restaurants found matching your criteria.';
        } else {
            $response['message'] = 'Restaurants retrieved successfully.';
        }
    }

} catch (PDOException $e) {
    // Catch any PDO connection errors or other unexpected DB issues
    error_logs("API Connection Error: " . $e->getMessage());
    $response['message'] = 'Database connection error. Please try again later.';
} catch (Exception $e) {
    // Catch any other unexpected errors
    error_logs("API General Error: " . $e->getMessage());
    $response['message'] = 'An unexpected error occurred on the server.';
}

echo json_encode($response);
exit;

?>