<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_DATABASE');

$conn = new mysqli($host, $user, $password, $database);

$idInputValue = mysqli_real_escape_string($conn, $_POST['inputValue']);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT activated FROM idpw WHERE name = '$idInputValue'";

$result = $conn->query($sql);

if ($result === FALSE) {
    $response = array("success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error);
} else {
    $row = mysqli_fetch_array($result);
    if ($row['activated'] === "1") {
        $response = array("success" => true, "message" => "Activated user");
        $_SESSION['id'] = $idInputValue;
    } else {
        $response = array("success" => false, "message" => "Deactivated user");
    }
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>