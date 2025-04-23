# Sistema BibliotecaMVC

O sistema **BibliotecaMVC** é uma solução desenvolvida em **C#** com padrão arquitetural **MVC (Model-View-Controller)** para o gerenciamento de bibliotecas. A proposta é oferecer um controle eficiente sobre o acervo, usuários, empréstimos e devoluções, facilitando o trabalho de bibliotecários e garantindo um acesso organizado às informações pelos leitores.

---

## Principais Funcionalidades

📚 `**Cadastrar**` livros, autores e usuários  
🔍 `**Consultar**` acervo e histórico de empréstimos  
📤 `**Registrar**` empréstimos e devoluções  
✏️ `**Editar**` informações de livros e usuários  
🗑️ `**Excluir**` registros desatualizados ou incorretos

---

## Arquitetura do Sistema



### Tecnologias Utilizadas

- 💻 **C# (.NET)** – Para o desenvolvimento da aplicação
- 🗃️ **SQL** – Como banco de dados relacional para persistência dos dados
- 🧩 **MVC (Model-View-Controller)** – Como padrão arquitetural
- 🛠️ **Entity Framework** – Para integração entre C# e SQL (ORM)

---

### Instruções para inicialização

- Abra a pasta App no VS Code e via terminal inicialize o servidor do PHP
- Se necessário, edite os dados de conexão com MySQL no PHP (host, porta, usuário e senha)
- php -S localhost:8000
- Acesse no seu navegador: http://localhost:8000

## Diagrama de Arquitetura Simplificado

```plaintext
+------------------------+
|    Interface Gráfica   |
|      (View)            |
+-----------+------------+
            |
            v
+-----------+------------+
|        Controller       |  <- Processa ações do usuário
+-----------+------------+
            |
            v
+-----------+------------+
|          Model          |  <- Contém regras de negócio e lógica de dados
+-----------+------------+
            |
            v
+------------------------+
|      Banco de Dados     |  <- Armazena livros, usuários e registros
|         (SQL)           |
+------------------------+
'''

