<?php
$dbUrl = getenv("CLEARDB_DATABASE_URL");

if (empty($dbUrl)) {
    // Se a variável de ambiente não estiver disponível, você está localmente
    // Configure manualmente as configurações do banco de dados localmente
    $dbUrl = "mysql://bd71fb312c2cf1:6208da57@us-cluster-east-01.k8s.cleardb.net/heroku_8926797d9d59cea?reconnect=true";
}

$dbParams = parse_url($dbUrl);

$host = $dbParams["host"];
$user = $dbParams["user"];
$password = $dbParams["pass"];
$db = substr($dbParams["path"], 1);

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
