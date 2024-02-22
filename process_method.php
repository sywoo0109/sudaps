<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_DATABASE');

$conn = new mysqli($host, $user, $password, $database);

$id = mysqli_real_escape_string($conn, $_POST['methodInputValue']);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE donation_method SET activated = CASE WHEN activated = 1 THEN 0 ELSE 1 END WHERE id = {$id}";

$result = $conn->query($sql);

if ($result === FALSE) {
    $response = array("success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error);
} else {
    $response = array("success" => true, "message" => "Successfully change active status");
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>