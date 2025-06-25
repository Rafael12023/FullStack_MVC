document.getElementById('registroForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const username = document.getElementById('username').value;
    const senha = document.getElementById('password').value;
    const confirmar = document.getElementById('confirmPassword').value;

    if (senha !== confirmar) {
        alert('As senhas não coincidem.');
        return;
    }

    const formData = new FormData();
    formData.append('username', username);
    formData.append('password', senha);

    fetch('http://localhost/FullStack_MVC/cadastro', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erro na requisição');
        }
        return response.json();
    })
    .then(data => {
        alert(data.message);
        if (data.success) {
            window.location.href = '../login';
        }
    })
    .catch(error => {
        alert('Erro ao tentar registrar.');
        console.error('Erro:', error);
    });
});
