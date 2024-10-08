<?php
include 'db.php';

// Busca todos os formulários
$stmt = $pdo->query("SELECT id, titulo, descricao, criado_em FROM formularios");
$forms = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Ver Formulários</title>
</head>
<body>
    <h1>Formulários Criados</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Descrição</th>
            <th>Criado em</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($forms as $form): ?>
            <tr>
                <td><?= htmlspecialchars($form['id']) ?></td>
                <td><?= htmlspecialchars($form['titulo']) ?></td>
                <td><?= htmlspecialchars($form['descricao']) ?></td>
                <td><?= htmlspecialchars($form['criado_em']) ?></td>
                <td><a href="ver_respostas.php?form_id=<?= $form['id'] ?>">Ver Respostas</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
