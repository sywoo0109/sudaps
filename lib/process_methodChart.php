<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_DATABASE');

$conn = new mysqli($host, $user, $password, $database);

$methodYearInputValue = mysqli_real_escape_string($conn, $_POST['methodYearInputValue']);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT method, COUNT(*) AS count FROM donation WHERE YEAR(date) = {$methodYearInputValue} GROUP BY method;";

$result = $conn->query($sql);

$methodData = array_fill(1, 6, 0);

if ($result === FALSE) {
    $response = array("success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error);
} else {
    while($row = $result->fetch_assoc()) {
        $method = $row['method'];
        $count = $row['count'];
        $methodData[$method] = $count;
    }
    $response = array("success" => true, "message" => $methodData);
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>