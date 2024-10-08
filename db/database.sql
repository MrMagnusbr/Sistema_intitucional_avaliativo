CREATE DATABASE form_system;

USE form_system;

-- Tabela para armazenar formulários
CREATE TABLE formularios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela para armazenar perguntas de um formulário
CREATE TABLE perguntas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    formulario_id INT,
    tipo VARCHAR(50),  -- texto, múltipla escolha, etc.
    pergunta TEXT,
    FOREIGN KEY (formulario_id) REFERENCES formularios(id) ON DELETE CASCADE
);
-- Tabela para armazenar respostas de formulários
CREATE TABLE form_responses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    form_id INT,
    user_id INT, -- Opcional, caso queira registrar quem respondeu
    response_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (form_id) REFERENCES formularios(id) ON DELETE CASCADE
);

-- Tabela para armazenar respostas de perguntas individuais
CREATE TABLE question_responses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    response_id INT,
    question_id INT,
    answer TEXT,
    FOREIGN KEY (response_id) REFERENCES form_responses(id) ON DELETE CASCADE,
    FOREIGN KEY (question_id) REFERENCES perguntas(id) ON DELETE CASCADE
);
