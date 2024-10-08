<?php
include 'db.php'; // Conecta ao banco de dados

// Verifica se o método de requisição é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Lê o conteúdo da requisição JSON
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Captura o título e a descrição do formulário
    $form_title = $data['title'];
    $form_description = $data['description'];
    $questions = $data['questions']; // Array com as perguntas do formulário

    try {
        // Inicia uma transação
        $pdo->beginTransaction();
        
        // Insere o formulário na tabela `forms`
        $stmt = $pdo->prepare("INSERT INTO forms (title, description) VALUES (?, ?)");
        $stmt->execute([$form_title, $form_description]);

        // Pega o ID do formulário recém-criado
        $form_id = $pdo->lastInsertId();

        // Insere cada pergunta na tabela `questions`
        foreach ($questions as $question) {
            $stmt = $pdo->prepare("INSERT INTO questions (form_id, question_text, question_type, options) VALUES (?, ?, ?, ?)");
            $options = isset($question['options']) ? json_encode($question['options']) : null;
            $stmt->execute([$form_id, $question['text'], $question['type'], $options]);
        }

        // Confirma a transação
        $pdo->commit();

        // Retorna uma resposta de sucesso
        echo json_encode(['status' => 'success', 'form_id' => $form_id]);

    } catch (Exception $e) {
        // Em caso de erro, desfaz a transação
        $pdo->rollBack();
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
?>
