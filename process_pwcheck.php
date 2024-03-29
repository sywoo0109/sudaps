<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_DATABASE');

$conn = new mysqli($host, $user, $password, $database);

$idInputValue = mysqli_real_escape_string($conn, $_POST['idInputValue']);
$pwInputValue = mysqli_real_escape_string($conn, $_POST['pwInputValue']);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT pw, salt FROM idpw WHERE name = '$idInputValue'";

$result = $conn->query($sql);

if ($result === FALSE) {
    $response = array("success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error);
} else {
    $row = mysqli_fetch_array($result);
    if (password_verify($pwInputValue.$row['salt'], $row['pw'])) {
        $response = array("success" => true, "message" => "Password matches");
    } else {
        $response = array("success" => false, "message" => "Password does not match");
    }
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>
