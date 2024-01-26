<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_DATABASE');

$conn = new mysqli($host, $user, $password, $database);

$idValue = mysqli_real_escape_string($conn, $_POST['idValue']);
$groupInputValue = mysqli_real_escape_string($conn, $_POST['groupInputValue']);
$nameInputValue = mysqli_real_escape_string($conn, $_POST['nameInputValue']);
$passwordInputValue = mysqli_real_escape_string($conn, $_POST['passwordInputValue']);
$radioInputValue = mysqli_real_escape_string($conn, $_POST['radioInputValue']);

$salt = bin2hex(random_bytes(16));
$hashed_password = password_hash($passwordInputValue.$salt, PASSWORD_DEFAULT);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE idpw SET 
group_id = '{$groupInputValue}', 
nickname = '{$nameInputValue}', 
pw = '{$hashed_password}', 
salt = '{$salt}', 
activated = '{$radioInputValue}' 
WHERE id = '{$idValue}'";

$result = $conn->query($sql);

if ($result) {
    $affectedRows = mysqli_affected_rows($conn);

    if ($affectedRows > 0) {
        $response = array("success" => true, "message" => "Update success");
    } else {
        $response = array("success" => false, "message" => "No corresponding row");
    }
} else {
    $response = array("success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error);
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>