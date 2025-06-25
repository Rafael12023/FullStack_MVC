document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Evita o comportamento padrão de envio do formulário

    const formData = new FormData(this); // Pega os dados do formulário

    fetch('http://localhost/FullStack_MVC/login', {  // Faz a requisição para a rota /login
        method: 'POST',  // Usando POST para enviar os dados
        body: formData   // Envia os dados do formulário no corpo da requisição
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erro na requisição');
        }
        return response.json(); // Retorna a resposta em JSON
    })
    .then(data => {
        if (data.success) {
            // Aqui você pode redirecionar para outra página ou fazer algo quando o login for bem-sucedido
            window.location.href = '../home'; // Exemplo: redireciona para uma página de "home" após login
        }
    })
    .catch(error => {
        alert('Erro ao tentar fazer login.');
        console.error('Erro:', error);
    });
});