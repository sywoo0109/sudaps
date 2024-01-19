<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_DATABASE');

$conn = new mysqli($host, $user, $password, $database);

$inputValue = mysqli_real_escape_string($conn, $_POST['inputValue']);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// $sql = "INSERT INTO group_name (name) VALUES ('{$inputValue}')";
$sql = "SELECT * FROM group_name WHERE name = '$inputValue'";

$result = $conn->query($sql);

if ($result === FALSE) {
    $response = array("success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error);
} else {
    if ($result->num_rows > 0) {
        $response = array("success" => false, "message" => "Group name already exists in the database");
    } else {
        $sql = "INSERT INTO group_name (name) VALUES ('{$inputValue}')";

        $result = $conn->query($sql);

        if ($result === FALSE) {
            $response = array("success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error);
        } else {
            $response = array("success" => true, "message" => "Group created successfully");
        }
    }
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>
