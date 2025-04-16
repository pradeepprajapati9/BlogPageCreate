<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json; charset=UTF-8');

include '../connection.php'; // Use existing database connection

// Check if the 'id' field is present in the POST data
if (!isset($_POST['id']) || empty($_POST['id'])) {
    echo json_encode(["status" => false, "error" => "Missing required field: id"]);
    exit();
}

// Get the POST data
$id = (int)$_POST['id']; // Ensure it's an integer
$title = isset($_POST['title']) ? trim($_POST['title']) : null;
$url = isset($_POST['url']) ? trim($_POST['url']) : null;
$short_description = isset($_POST['short_description']) ? trim($_POST['short_description']) : null;
$description = isset($_POST['description']) ? trim($_POST['description']) : null;

// Check if a new thumbnail is uploaded
$thumbnail = null;
if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
    $thumbnailTmpName = $_FILES['thumbnail']['tmp_name'];
    $thumbnailName = basename($_FILES['thumbnail']['name']);
    $thumbnailDir = './images/blog/';
    $thumbnailPath = $thumbnailDir . $thumbnailName;

    if (!is_dir($thumbnailDir)) {
        mkdir($thumbnailDir, 0777, true);
    }

    if (move_uploaded_file($thumbnailTmpName, $thumbnailPath)) {
        $thumbnail = $thumbnailPath;
    } else {
        echo json_encode(["status" => false, "error" => "Failed to upload thumbnail image"]);
        exit();
    }
}

// Prepare SQL query based on thumbnail presence
if ($thumbnail === null) {
    $sql = "UPDATE blog SET title = ?, url = ?, short_description = ?, description = ? WHERE id = ?";
    $stmt = $con->prepare($sql);
    if (!$stmt) {
        echo json_encode(["status" => false, "error" => "SQL prepare failed: " . $con->error]);
        exit();
    }
    $stmt->bind_param("ssssi", $title, $url, $short_description, $description, $id);
} else {
    $imageUrl = "images/blog/" . basename($thumbnail); // Full URL to the uploaded image

    $sql = "UPDATE blog SET title = ?, url = ?, short_description = ?, description = ?, thumbnail = ? WHERE id = ?";
    $stmt = $con->prepare($sql);
    if (!$stmt) {
        echo json_encode(["status" => false, "error" => "SQL prepare failed: " . $con->error]);
        exit();
    }
    $stmt->bind_param("sssssi", $title, $url, $short_description, $description, $imageUrl, $id);
}

if ($stmt->execute()) {
    echo json_encode(["status" => true, "message" => "Data updated successfully"]);
} else {
    echo json_encode(["status" => false, "error" => "Database error: " . $stmt->error]);
}

$stmt->close();
$con->close();
?>
