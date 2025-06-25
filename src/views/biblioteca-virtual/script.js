function carregarLivros() {
  fetch("http://localhost/FullStack_MVC/livros")
    .then((response) => response.json())
    .then((data) => {
      const lista = document.getElementById("lista-livros");
      lista.innerHTML = "";

      data.data.forEach((livro) => {
        const li = document.createElement("li");
        li.innerHTML = `
              <span><strong>${livro.titulo}</strong> - ${livro.autor} (${livro.ano})</span>
              <div>
                <button class="editar-livro" data-id="${livro.id}" data-titulo="${livro.titulo}" data-autor="${livro.autor}" data-ano="${livro.ano}">
                <span class="material-symbols-outlined">Editar</span>
              </button>
              <button class="remover-livro" data-id="${livro.id}">
                <span class="material-symbols-outlined">Deletar</span>
              </button>
              </div>
            `;
        lista.appendChild(li);
      });

      document.querySelectorAll(".remover-livro").forEach((botao) => {
        botao.addEventListener("click", function () {
          const id = this.getAttribute("data-id");
          removerLivro(id);
        });
      });

      document.querySelectorAll(".editar-livro").forEach((botao) => {
        botao.addEventListener("click", function () {
          const formEdicao = document.getElementById("form-edicao");
          const form = document.getElementById("editar-livro-form");

          form.id.value = this.dataset.id;
          form.titulo.value = this.dataset.titulo;
          form.autor.value = this.dataset.autor;
          form.ano.value = this.dataset.ano;

          formEdicao.style.display = "flex";
          form.scrollIntoView({ behavior: "smooth" });
        });
      });
    });
}

function removerLivro(id) {
  fetch(`http://localhost/FullStack_MVC/livros/${id}`, { method: "DELETE" })
    .then((response) => response.json())
    .then((data) => {
      carregarLivros();
    });
}

function atualizarLivro(id, titulo, autor, ano) {
  fetch(`http://localhost/FullStack_MVC/livros/${id}`, {
    method: "PUT",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ titulo, autor, ano }),
  })
    .then((response) => response.json())
    .then((data) => {
      document.getElementById("form-edicao").style.display = "none";
      carregarLivros();
    });
}

document.getElementById("form-livro").addEventListener("submit", function (e) {
  e.preventDefault();
  const formData = new FormData(this);

  fetch("http://localhost/FullStack_MVC/livros", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      titulo: formData.get("titulo"),
      autor: formData.get("autor"),
      ano: parseInt(formData.get("ano")),
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      this.reset();
      carregarLivros();
    });
});

document
  .getElementById("editar-livro-form")
  .addEventListener("submit", function (e) {
    e.preventDefault();
    const id = this.id.value;
    const titulo = this.titulo.value;
    const autor = this.autor.value;
    const ano = parseInt(this.ano.value);

    atualizarLivro(id, titulo, autor, ano);
  });

carregarLivros();
