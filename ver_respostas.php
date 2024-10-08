<?php
include 'db.php'; // Conecta ao banco de dados

$form_id = $_GET['form_id']; // Pega o ID do formulário a partir da URL

// Busca as respostas do formulário
$stmt = $pdo->prepare("
    SELECT fr.response_date, qr.question_id, q.question_text, qr.answer 
    FROM form_responses fr
    JOIN question_responses qr ON fr.id = qr.response_id
    JOIN questions q ON q.id = qr.question_id
    WHERE fr.form_id = ?
");
$stmt->execute([$form_id]);
$responses = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respostas do Formulário</title>
</head>
<body>
    <h1>Respostas do Formulário ID: <?= htmlspecialchars($form_id) ?></h1>

    <table border="1">
        <tr>
            <th>Data da Resposta</th>
            <th>Pergunta</th>
            <th>Resposta</th>
        </tr>
        <?php foreach ($responses as $response): ?>
            <tr>
                <td><?= htmlspecialchars($response['response_date']) ?></td>
                <td><?= htmlspecialchars($response['question_text']) ?></td>
                <td><?= htmlspecialchars($response['answer']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
