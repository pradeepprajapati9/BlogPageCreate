<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json; charset=UTF-8');

include '.connection.php'; // Use existing database connection

// Check if required fields are present in the POST data
if (!isset($_POST['title']) || empty($_POST['title'])) {
    echo json_encode(["status" => false, "error" => "Missing required field: title"]);
    exit();
}

if (!isset($_POST['short_description']) || empty($_POST['short_description'])) {
    echo json_encode(["status" => false, "error" => "Missing required field: short_description"]);
    exit();
}

// Get the POST data
$title = trim($_POST['title']);
$url = isset($_POST['url']) ? trim($_POST['url']) : '';
$short_description = trim($_POST['short_description']);
$description = isset($_POST['description']) ? trim($_POST['description']) : null;
$created_at = isset($_POST['created_at']) ? trim($_POST['created_at']) : date('Y-m-d H:i:s'); // Default to current timestamp

// Handle file upload for thumbnail
if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
    $thumbnailTmpName = $_FILES['thumbnail']['tmp_name'];
    $thumbnailName = basename($_FILES['thumbnail']['name']);
    $thumbnailDir = '../../images/blog/';  // Directory where you want to save the image
    $thumbnailPath = $thumbnailDir . $thumbnailName;

    // Check if the upload directory exists, if not, create it
    if (!is_dir($thumbnailDir)) {
        mkdir($thumbnailDir, 0777, true);
    }

    // Move the uploaded file to the desired directory
    if (move_uploaded_file($thumbnailTmpName, $thumbnailPath)) {
        // Construct the full URL for the thumbnail
        $baseUrl = 'domainurl'; // Your base URL
        $thumbnailUrl = $baseUrl . '/images/blog/' . $thumbnailName; // Full URL to be stored

        $thumbnail = $thumbnailUrl;  // Save the full URL to the database
    } else {
        echo json_encode(["status" => false, "error" => "Failed to upload thumbnail image"]);
        exit();
    }
} else {
    echo json_encode(["status" => false, "error" => "No file uploaded or file upload error"]);
    exit();
}

// Prepare SQL query to insert data
$sql = "INSERT INTO blog (title, url, short_description, description, thumbnail, created_at) 
        VALUES (?,?,?,?,?,?)";

$stmt = $con->prepare($sql);
if (!$stmt) {
    echo json_encode(["status" => false, "error" => "SQL prepare failed: " . $con->error]);
    exit();
}

$stmt->bind_param("ssssss", $title, $url, $short_description, $description, $thumbnail, $created_at);

if ($stmt->execute()) {
    echo json_encode(["status" => true, "message" => "Data inserted successfully"]);
} else {
    echo json_encode(["status" => false, "error" => "Database error: " . $stmt->error]);
}

$stmt->close();
$con->close();
?>
