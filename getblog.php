<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json; charset=UTF-8');
include '../connection.php'; // Use existing database connection
// Prepare SQL query to select all blog data
$sql = "SELECT * FROM blog";

$stmt = $con->prepare($sql);
if (!$stmt) {
    echo json_encode(["status" => false, "error" => "SQL prepare failed: " . $con->error]);
    exit();
}

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Fetch all the data as an associative array
    $blogs = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode(["status" => true, "data" => $blogs]);
} else {
    echo json_encode(["status" => false, "message" => "No blog posts found"]);
}

$stmt->close();
$con->close();
?>
