# Sistema de Gerenciamento de Vendas para uma Mercearia

## 📌 Descrição do Projeto
Este sistema foi desenvolvido para automatizar o registro de vendas e o controle de estoque de uma mercearia, reduzindo erros manuais e melhorando a organização. Ele permite a autenticação de usuários com diferentes níveis de acesso, gestão de produtos, e gera relatórios para facilitar a tomada de decisão.

## 🚀 Funcionalidades
- Login com diferentes níveis de acesso (Administrador e Vendedor)
- Registro de vendas e atualização automática do estoque
- Cadastro, edição e exclusão de produtos
- Consulta e gerenciamento de estoque
- Geração de relatórios de vendas e estoque
- Administração de usuários (criar, editar e remover contas)
- Logs de atividade para auditoria

## 🛠 Tecnologias Utilizadas
- **Frontend:** HTML, CSS, JavaScript (jQuery, jQuery Validate)
- **Backend:** PHP (com PDO para conexão segura à base de dados)
- **Base de Dados:** MySQL
- **Servidor:** XAMPP (Apache, MySQL, PHP)

## 📥 Instalação e Configuração
### 1️⃣ Requisitos
- PHP 7+ instalado
- MySQL ou MariaDB
- Servidor Apache (XAMPP ou WAMP recomendado)

### 2️⃣ Passos
1. Clone o repositório:
   ```sh
   git clone https://github.com/oliviorui/fullstack-practice.git
   ```
2. Coloque o diretório *mercearia* dentro do diretório do seu servidor local (ex: `htdocs` no XAMPP).
3. Inicie o servidor, crie e configure a base de dados:
   - Importe o arquivo `database/schema.sql` no MySQL.
   - Atualize as credenciais da banco no arquivo `init/add_admin.php`.
4. Acesse o projeto via navegador, indo para `localhost/mercearia/public`.

## 📌 Uso do Sistema
### 🔑 Login
1. Acesse a página de login e entre com suas credenciais.
2. O Administrador tem acesso a todas as funcionalidades.
3. O Vendedor pode apenas registrar vendas e consultar estoque.

### 🛒 Registro de Vendas
1. Selecione os produtos vendidos.
2. Informe a quantidade.
3. Confirme para atualizar o estoque automaticamente.

### 📦 Gerenciamento de Estoque
1. Admin pode cadastrar, editar e excluir produtos.
2. Estoque é atualizado automaticamente após cada venda.

### 📊 Relatórios
- O sistema gera relatórios visuais de vendas e estoque.

## 📂 Estrutura do Projeto
- **app/api/** → Endpoints REST para interação com o banco
- **app/config/** → Arquivos de configuração e autenticação
- **app/controller/** → Lógica dos CRUDs (usuários e produtos)
- **app/views/** → Páginas do sistema
- **database/** → Script SQL para estrutura da base de dados
- **public/** → Arquivos acessíveis pelo navegador (HTML, CSS, JS)

## 🗃️ Banco de Dados
### 📌 Tabelas principais
- `usuarios` → Armazena informações dos administradores e vendedores
- `sessoes` → Gerencia sessões ativas dos usuários
- `produtos` → Contém os itens vendidos na mercearia
- `vendas` → Registra transações de vendas
- `itens_venda` → Relaciona produtos vendidos com suas vendas
- `logs` → Registra atividades dos usuários no sistema

## 🤝 Contribuição
Sugestões e melhorias são bem-vindas! Abra um pull request ou envie uma mensagem.

## 📞 Contato
- Autor: **Olívio Rui Cumbe**
- Email: [oliviorui@gmail.com](mailto:oliviorui@gmail.com)