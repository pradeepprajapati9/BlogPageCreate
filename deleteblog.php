<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json; charset=UTF-8');
 
include '../connection.php'; // Use existing database connection
// Check if the 'id' is passed in the POST data
if (!isset($_POST['id']) || empty($_POST['id'])) {
    echo json_encode(["status" => false, "error" => "Missing required field: id"]);
    exit();
}

// Get the 'id' from the POST data
$id = (int)$_POST['id']; // Ensure it's an integer

// Prepare SQL query to delete the blog post
$sql = "DELETE FROM blog WHERE id = ?";

$stmt = $con->prepare($sql);
if (!$stmt) {
    echo json_encode(["status" => false, "error" => "SQL prepare failed: " . $con->error]);
    exit();
}

// Bind the 'id' parameter to the query
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    // Check if any row was affected (this indicates a successful deletion)
    if ($stmt->affected_rows > 0) {
        echo json_encode(["status" => true, "message" => "Blog post deleted successfully"]);
    } else {
        echo json_encode(["status" => false, "message" => "No blog post found with the given ID"]);
    }
} else {
    echo json_encode(["status" => false, "error" => "Database error: " . $stmt->error]);
}

$stmt->close();
$con->close();
?>
