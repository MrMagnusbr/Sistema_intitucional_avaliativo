<?php
include 'db.php'; // Conecta ao banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lê os dados da requisição
    $data = json_decode(file_get_contents('php://input'), true);

    $form_id = $data['form_id'];
    $user_id = $data['user_id']; // Caso queira identificar quem respondeu
    $answers = $data['answers']; // Array de respostas

    try {
        // Inicia uma transação
        $pdo->beginTransaction();

        // Insere uma nova resposta no formulário
        $stmt = $pdo->prepare("INSERT INTO form_responses (form_id, user_id) VALUES (?, ?)");
        $stmt->execute([$form_id, $user_id]);

        // Pega o ID da resposta recém-criada
        $response_id = $pdo->lastInsertId();

        // Insere cada resposta na tabela `question_responses`
        foreach ($answers as $answer) {
            $stmt = $pdo->prepare("INSERT INTO question_responses (response_id, question_id, answer) VALUES (?, ?, ?)");
            $stmt->execute([$response_id, $answer['question_id'], $answer['answer']]);
        }

        // Confirma a transação
        $pdo->commit();

        // Retorna uma resposta de sucesso
        echo json_encode(['status' => 'success']);

    } catch (Exception $e) {
        // Em caso de erro, desfaz a transação
        $pdo->rollBack();
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
?>
