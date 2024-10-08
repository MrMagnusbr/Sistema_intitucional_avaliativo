<?php
require 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $perguntas = $_POST['perguntas'];
    $tipos = $_POST['tipos'];

    // Insere o formulário
    $sql = "INSERT INTO formularios (titulo, descricao) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $titulo, $descricao);
    $stmt->execute();
    $formulario_id = $stmt->insert_id;

    // Insere as perguntas
    foreach ($perguntas as $index => $pergunta) {
        $tipo = $tipos[$index];
        $sql = "INSERT INTO perguntas (formulario_id, tipo, pergunta) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $formulario_id, $tipo, $pergunta);
        $stmt->execute();
    }

    echo "Formulário salvo com sucesso!";
}
?>
