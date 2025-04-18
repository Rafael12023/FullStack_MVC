# 💻 Projeto Full Stack - Parte 2

Este repositório contém a segunda parte do nosso projeto Full Stack desenvolvido como parte da disciplina do curso de Gestão da Tecnologia da Informação do Professor Igor.

## 🚀 Objetivo do Projeto

- API base implementada em Node.js, Python, Java ou C#.
- Endpoints mínimos:
    - `/auth/login` (Implementação de autenticação segura)
    - `/logs` (Demonstração do sistema de log)
    - `/health` (Verificação de status da aplicação para monitoramento básico)
- Código bem estruturado seguindo boas práticas (modularização, organização por camadas, uso de padrões de projeto quando necessário).

## 🛠️ Tecnologias Utilizadas

### Frontend:
- HTML5
- CSS3
- JavaScript

### Backend:
- PHP
- Sem framework (MVC estruturado manualmente)

### Banco de Dados:
- MySQL

---

## 🧭 Como rodar o projeto localmente

### 🔽 1. Pré-requisitos

Antes de começar, você vai precisar ter as seguintes ferramentas instaladas na sua máquina:

- [Composer](https://getcomposer.org/) (gerenciador de dependências do PHP)
- [XAMPP](https://www.apachefriends.org/pt_br/index.html) ou outro ambiente que rode Apache + PHP + MySQL
- PHP 8.0 ou superior
- MySQL 5.7 ou superior
- Navegador Web (ex: Chrome, Firefox)

### 🔽 2. Instale as dependências

Abra o terminal na raiz do projeto e execute o seguinte comando:

```bash
composer install
```

Esse comando irá instalar automaticamente todas as bibliotecas necessárias descritas no `composer.json`, como o `vlucas/phpdotenv` para gerenciamento de variáveis de ambiente.

### ⚙️ 3. Configure o ambiente e o banco de dados

#### 🔧 Crie o arquivo `.env` na raiz do projeto

Copie o conteúdo do arquivo `.env.example` e cole em um novo arquivo chamado `.env`. Depois, edite com suas configurações locais:

```
DB_HOST=localhost
DB_NAME=seu_banco
DB_USER=root
DB_PASS=sua_senha
```

#### 🗄️ Crie o banco de dados e as tabelas

1. Abra o **phpMyAdmin** ou um cliente de MySQL de sua preferência.
2. Crie um banco de dados com o nome que você colocou na variável `DB_NAME` do `.env`.
3. Execute o script SQL localizado em:

```bash
/src/database/script.sql
```

Esse script cria a tabela de usuários com os dados necessários para o login.

---

## 👨‍💻 Equipe

| Nome                                | RA     |
|-------------------------------------|--------|
| Cauã Lucas de Alcântara Silva       | 15930  |
| Denis Viegas Tomaz                  | 15374  |
| Ismael de Freitas Santiago          | 15448  |
| Jenifer Kelly de Almeida Silva      | 10064  |
| Julia Laysa da Silva Queiroz        | 15965  |
| Larissa Silva Melo                  | 11115  |
| Rafael Teodoro de Resende           | 15933  |
