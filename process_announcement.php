<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_DATABASE');

$conn = new mysqli($host, $user, $password, $database);

$title = mysqli_real_escape_string($conn, $_POST['titleInputValue']);
$content = mysqli_real_escape_string($conn, $_POST['contentInputValue']);
$task = mysqli_real_escape_string($conn, $_POST['task']);
$DBid = mysqli_real_escape_string($conn, $_POST['DBid']);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($task === "create") {
    $sql = "INSERT INTO announcement (title, content) VALUES ('{$title}', '{$content}');";
} else if ($task === "modify") {
    $sql = "SELECT title, content FROM announcement WHERE id = '{$DBid}'";
} else if ($task === "delete") {
    $sql = "DELETE FROM announcement WHERE id = '{$DBid}'";
} else if ($task === "activate") {
    $sql = "UPDATE announcement SET activated = CASE WHEN activated = 0 THEN 1 ELSE 0 END WHERE id = '{$DBid}'";
}

$result = $conn->query($sql);

if ($result === FALSE) {
    $response = array("success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error);
} else {
    if ($task === "create") {
        $response = array("success" => true, "message" => "Successfully create new announcement");
    } else if ($task === "modify") {
        $row = mysqli_fetch_array($result);
        $response = array("success" => true, "message" => $row);
    } else if ($task === "delete") {
        $response = array("success" => true, "message" => "Successfully delete announcement");
    } else if ($task === "activate") {
        $response = array("success" => true, "message" => "Successfully change activation status");
    }
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>