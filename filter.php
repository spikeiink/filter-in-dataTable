<?php

require 'conexão.php'; 


header('Content-Type: application/json');


$name = isset($_GET['name']) ? $_GET['name'] : '';
$email = isset($_GET['email']) ? $_GET['email'] : '';
$idade = isset($_GET['idade']) ? $_GET['idade'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';


$sql = "SELECT id, nome, email, idade FROM users";


$conditions = [];
$parameters = [];
$param_types = ''; 


if ($name) {
    $conditions[] = "nome LIKE ?";
    $parameters[] = "%" . $name . "%";
    $param_types .= 's';
}

if ($email) {
    $conditions[] = "email LIKE ?";
    $parameters[] = "%" . $email . "%";
    $param_types .= 's'; 
}

if ($idade) {
    $conditions[] = "idade = ?";
    $parameters[] = (int)$idade;
    $param_types .= 'i'; 
}

if ($id) {
    $conditions[] = "id = ?";
    $parameters[] = (int)$id;
    $param_types .= 'i'; 
}

if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}


$stmt = $sconn->prepare($sql);


if (!empty($parameters)) {
    $stmt->bind_param($param_types, ...$parameters);
}

$stmt->execute();
$result = $stmt->get_result();


$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row; 
    }
}

echo json_encode($data);

$stmt->close();
$sconn->close();
?>
