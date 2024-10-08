<?php
$host = 'localhost';
$db = 'form_creator_db';
$user = 'root'; // padrão do XAMPP
$pass = ''; // sem senha, a menos que você tenha definido uma

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}
?>