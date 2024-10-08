let perguntaCount = 0;

function adicionarPergunta() {
    perguntaCount++;
    
    const perguntasDiv = document.getElementById('perguntas');
    const novaPergunta = document.createElement('div');
    
    novaPergunta.innerHTML = `
        <label for="pergunta_${perguntaCount}">Pergunta ${perguntaCount}:</label>
        <input type="text" id="pergunta_${perguntaCount}" name="perguntas[]" required>
        
        <label for="tipo_${perguntaCount}">Tipo:</label>
        <select id="tipo_${perguntaCount}" name="tipos[]">
            <option value="texto">Texto</option>
            <option value="multipla_escolha">Múltipla Escolha</option>
        </select>
    `;

    perguntasDiv.appendChild(novaPergunta);
}
