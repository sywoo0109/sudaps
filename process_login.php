<?php
$host = 'localhost';
$user = 'root';
$password = 'samwoo96';
$database = 'syadmin';

$conn = new mysqli($host, $user, $password, $database);

$idInputValue = $_POST['idInputValue'];
$pwInputValue = $_POST['pwInputValue'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT activated FROM idpw WHERE name = '$idInputValue' AND pw = '$pwInputValue";

$result = $conn->query($sql);

if ($result === FALSE) {
    $response = array("success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error);
} else {
    $row = mysqli_fetch_array($result);
    if ($row['activated'] === 0) {
        $response = array("success" => true, "message" => "The password matches");
    } else {
        $response = array("success" => false, "message" => "The password does not match");
    }
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>
