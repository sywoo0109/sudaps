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

$sql = "SELECT * FROM idpw WHERE name = '$inputValue'";

$result = $conn->query($sql);

if ($result === FALSE) {
    $response = array("success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error);
} else {
    if ($result->num_rows > 0) {
        $response = array("success" => true, "message" => "ID exists in the database");
    } else {
        $response = array("success" => false, "message" => "ID does not exist in the database");
    }
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>
