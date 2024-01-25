<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_DATABASE');

$conn = new mysqli($host, $user, $password, $database);

$idInputValue = mysqli_real_escape_string($conn, $_POST['idInputValue']);
$groupInputValue = mysqli_real_escape_string($conn, $_POST['groupInputValue']);
$nameInputValue = mysqli_real_escape_string($conn, $_POST['nameInputValue']);
$passwordInputValue = mysqli_real_escape_string($conn, $_POST['passwordInputValue']);
$radioInputValue = mysqli_real_escape_string($conn, $_POST['radioInputValue']);

$salt = bin2hex(random_bytes(16));
$hashed_password = password_hash($passwordInputValue.$salt, PASSWORD_DEFAULT);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO idpw (name, nickname, group_id, pw, salt, activated) VALUES ('{$idInputValue}', '{$nameInputValue}', '{$groupInputValue}', '{$hashed_password}', '{$salt}', '{$radioInputValue}')";

$result = $conn->query($sql);

if ($result === FALSE) {
    $response = array("success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error);
} else {
    $response = array("success" => true, "message" => "Successfully creating a new administrator");
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>