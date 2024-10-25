<?php
require_once "config.php";
require_once "check_session.php";

// Ensure user is logged in and has a user_id
session_start();

// Set JSON header
header('Content-Type: application/json');

// Initialize response array
$response = [
    'success' => false,
    'message' => ''
];

// Verify user is logged in and has a user_id
if (!isset($_SESSION['user_id'])) {
    $response['message'] = "User not authenticated";
    echo json_encode($response);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Debug logging
        error_log("User ID from session: " . $_SESSION['user_id']);
        
        // Validate and sanitize inputs
        $website = isset($_POST['website']) ? trim($_POST['website']) : '';
        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $entry_id = isset($_POST['entry_id']) ? filter_var($_POST['entry_id'], FILTER_SANITIZE_NUMBER_INT) : null;
        $user_id = $_SESSION['user_id'];

        // Validate required fields
        if (empty($website) || empty($username) || empty($password)) {
            throw new Exception("All fields are required");
        }

        // Validate user_id
        if (empty($user_id)) {
            throw new Exception("User ID is required");
        }

        $conn->begin_transaction();

        if (!empty($entry_id)) {
            // Update existing password
            $stmt = $conn->prepare("UPDATE passwordtbl SET website = ?, username = ?, password = ? 
                                  WHERE entry_id = ? AND user_id = ?");
            if (!$stmt) {
                throw new Exception("Prepare failed: " . $conn->error);
            }
            $stmt->bind_param("sssii", $website, $username, $password, $entry_id, $user_id);
        } else {
            // Insert new password
            $stmt = $conn->prepare("INSERT INTO passwordtbl (user_id, website, username, password) 
                                  VALUES (?, ?, ?, ?)");
            if (!$stmt) {
                throw new Exception("Prepare failed: " . $conn->error);
            }
            $stmt->bind_param("isss", $user_id, $website, $username, $password);
        }

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $conn->commit();
        $response['success'] = true;
        $response['message'] = !empty($entry_id) ? "Password updated successfully" : "Password saved successfully";
        
        $stmt->close();

    } catch (Exception $e) {
        if (isset($conn)) {
            $conn->rollback();
        }
        $response['success'] = false;
        $response['message'] = "Error: " . $e->getMessage();
        error_log("Error in save_password.php: " . $e->getMessage());
    }
} else {
    $response['message'] = "Invalid request method";
}

echo json_encode($response);
exit;
?>