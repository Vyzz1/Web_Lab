<?php

require_once('connection.php');

if (!isset($_POST['key'])) {
    die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
}

$key = $_POST['key'];

$sql = 'SELECT * FROM app_countries WHERE country_name LIKE ?  OR country_code LIKE ?';
$likeKey = '%' . $key . '%';

try {
    $stmt = $dbCon->prepare($sql);
    $stmt->execute(array($likeKey, $likeKey));
} catch (PDOException $e) {
    die(json_encode(array('status' => false, 'data' => $e->getMessage())));
}

$data = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
}

echo json_encode(array('status' => true, 'data' => $data));
