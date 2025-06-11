<?php
session_start();
header('Content-Type: application/json');

// Include necessary files
require_once '../connexion/connexion.php';
require_once '../configuration/error_log.php'; // Ensure this path is correct for your error logging
require_once '../configuration/eventManager.php'; // Included but not used in this snippet, keep if needed elsewhere
require_once '../configuration/userDataController.php';

// Initialize the response array
$response = [
    'success' => false,
    'message' => '',
    'data' => [
        'user' => [],
        'favoris' => []
    ]
];

try {
    // Check if the user is logged in (username exists in session)
    if (!isset($_SESSION['username'])) {
        $response['message'] = "User not logged in.";
        echo json_encode($response);
        exit;
    }

    $username = $_SESSION['username'];
    $userData = new UserDataController($conn);

    // Fetch user information
    $users = $userData->getUsersInfos($username);

    // Fetch user favorites
    $usersFavoris = $userData->getFavourites($username);

    // Always set success to true if the fetches didn't throw an exception,
    // even if data is empty. The message can then reflect if data was found.
    $response['success'] = true;

    if (!empty($users)) {
        $response['data']['user'] = $users;
        $response['message'] = "User data retrieved successfully.";
    } else {
        $response['message'] = "User data not found.";
    }

    if (!empty($usersFavoris)) {
        $response['data']['favoris'] = $usersFavoris;
        // Append to message if user data was also found, or set if only favorites were found
        if (!empty($users)) {
            $response['message'] .= "Favorites also retrieved successfully.";
        } else {
            $response['message'] = "Favorites retrieved successfully.";
        }
    } else {
        if (!empty($users)) {
            $response['message'] .= " No favorites found for this user.";
        } else {
            $response['message'] = "No user data or favorites found.";
            // If neither user nor favorites are found, you might consider success as false,
            // or just ensure the message is clear. I'll keep success true here,
            // as the fetch itself succeeded, just returned empty results.
        }
    }

} catch (PDOException $e) {
    // Catch database-related errors
    $response['message'] = "Database error: " . $e->getMessage();
    error_logs("Erreur dans userHome (PDOException): " . $e->getMessage());
    $response['success'] = false; // Explicitly set to false on database error
} catch (Exception $e) {
    // Catch any other unexpected errors
    $response['message'] = "An unexpected error occurred: " . $e->getMessage();
    error_logs("Erreur dans userHome (General Exception): " . $e->getMessage());
    $response['success'] = false; // Explicitly set to false on general error
}

// Encode the response array as JSON and send it
echo json_encode($response);
exit; // Always exit after sending JSON to prevent additional output
?>