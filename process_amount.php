<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_DATABASE');

$conn = new mysqli($host, $user, $password, $database);

$amount = mysqli_real_escape_string($conn, $_POST['amountInputValue']);
$DBid = mysqli_real_escape_string($conn, $_POST['DBid']);
$task = mysqli_real_escape_string($conn, $_POST['task']);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($task === "save") {
    $sql = "UPDATE donation_amount SET amount = {$amount}, activated = 1 WHERE id = {$DBid};";
} else if ($task === "deactivate") {
    $sql = "UPDATE donation_amount SET activated = 0 WHERE id = {$DBid};";
}

$result = $conn->query($sql);

if ($result === FALSE) {
    $response = array("success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error);
} else {
    if ($task === "save") {
        $response = array("success" => true, "message" => "Successfully change donation amount");
    } else if ($task === "deactivate") {
        $response = array("success" => true, "message" => "Successfully change activated status");
    }
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>