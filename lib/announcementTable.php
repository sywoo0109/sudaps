<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_DATABASE');

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$page = isset($_GET['page']) ? (int)htmlspecialchars($_GET['page']) : 1;
$start = ($page - 1) * 12;

$sql = "SELECT id, title, activated FROM announcement LIMIT $start, 12";

$result = $conn->query($sql);

$list = '';
if ($result === FALSE) {
    $response = array("success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error);
} else {
    $response = array("success" => true, "message" => "Data exists in the database");
    while ($row = mysqli_fetch_array($result)) {
            $list .= "<tr>
            <td>{$row['title']}</td>
            <td>
            <div class='tableButton' group={$row['id']} data-action='modify'>수정하기</div>
            </td>
            <td>
            <div class='tableButton' group={$row['id']} data-action='delete'>삭제하기</div>
            </td>
            <td>";
            $list .= ($row['activated'] === '1') ? "<div class='tableButton' group={$row['id']} data-action='activate'>활성화</div> </td> </tr>" : "<div class='tableButton' group={$row['id']} data-action='activate'>비활성화</div> </td> </tr>";           
        } 
    }

echo $list;

$conn->close();
?>