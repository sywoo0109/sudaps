<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_DATABASE');

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM group_name";

$result = $conn->query($sql);

$list = '';
if ($result === FALSE) {
    $response = array("success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error);
} else {
    $response = array("success" => true, "message" => "Data exists in the database");
    while ($row = mysqli_fetch_array($result)) {
        $list = $list.
        "<option value='{$row['id']}'>{$row['name']}</option>";
        } 
    }

echo $list;

$conn->close();
?>