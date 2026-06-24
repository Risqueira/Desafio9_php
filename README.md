# Sistema CRUD de Usuários com Autenticação em PHP

## Descrição

Este projeto é um sistema CRUD (Create, Read, Update e Delete) desenvolvido em PHP utilizando Programação Orientada a Objetos (POO), MySQL e PDO para gerenciamento de usuários.

O sistema permite:

* Cadastro de usuários
* Login com autenticação
* Listagem de usuários
* Edição de usuários
* Exclusão de usuários
* Controle de sessão
* Logout do sistema
* Criptografia de senhas utilizando `password_hash()`

---

## Tecnologias Utilizadas

* PHP
* MySQL
* HTML5
* CSS3
* PDO (PHP Data Objects)
* Programação Orientada a Objetos (POO)

---

## Estrutura do Projeto

```text
Projeto_crud/
│
├── index.php
├── registrar.php
├── editar.php
├── deletar.php
├── portal.php
├── logout.php
│
├── classes/
│   ├── Database.php
│   └── Usuario.php
│
├── config/
│   └── config.php
│
└── style.css
```

---

## Banco de Dados

### Criando o banco de dados

```sql
CREATE DATABASE bdcrud;
```

### Selecionando o banco

```sql
USE bdcrud;
```

### Criando a tabela de usuários

```sql
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    sexo CHAR(1) NOT NULL,
    fone VARCHAR(15) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);
```

---

## Configuração da Conexão

Arquivo:

```text
classes/Database.php
```

Configurações padrão:

```php
private $host = "localhost";
private $db_name = "bdcrud";
private $username = "root";
private $password = "";
```

Caso utilize senha no MySQL, altere a variável:

```php
private $password = "sua_senha";
```

---

## Funcionalidades

### Login

* Autenticação através de e-mail e senha.
* Criação de sessão do usuário.
* Redirecionamento para o portal após login.

### Cadastro

* Registro de novos usuários.
* Senha armazenada de forma criptografada.

### Portal

* Exibe saudação personalizada.
* Lista todos os usuários cadastrados.
* Permite editar ou excluir registros.

### Edição

* Atualiza:

  * Nome
  * Sexo
  * Telefone
  * E-mail

### Exclusão

* Remove registros do banco de dados.

### Logout

* Encerra a sessão do usuário.
* Redireciona para a tela de login.

---

## Segurança

O projeto utiliza:

### Prepared Statements

```php
$stmt = $this->conn->prepare($query);
```

### Criptografia de Senhas

```php
password_hash($senha, PASSWORD_BCRYPT);
```

### Verificação de Senha

```php
password_verify($senha, $usuario['senha']);
```

### Controle de Sessão

```php
session_start();
```

Verificação de acesso:

```php
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}
```

---

## Como Executar o Projeto

### 1. Clonar o repositório

```bash
git clone https://github.com/seu-usuario/projeto-crud.git
```

### 2. Acessar a pasta

```bash
cd projeto-crud
```

### 3. Criar o banco de dados

Execute os comandos SQL apresentados anteriormente.

### 4. Configurar a conexão

Abra:

```text
classes/Database.php
```

E configure:

```php
private $host = "localhost";
private $db_name = "bdcrud";
private $username = "root";
private $password = "";
```

### 5. Iniciar o servidor local

Utilizando XAMPP:

* Inicie Apache
* Inicie MySQL

Ou utilizando o servidor embutido do PHP:

```bash
php -S localhost:8000
```

### 6. Acessar o sistema

```text
http://localhost/projeto_crud
```

ou

```text
http://localhost:8000
```

---

## Melhorias Futuras

* Recuperação de senha
* Validação de formulários
* Upload de foto de perfil
* Paginação da tabela
* Busca de usuários
* Controle de permissões
* Dashboard administrativo
* Proteção contra CSRF
* Utilização de Composer
* Arquitetura MVC

---

## Autor

Desenvolvido como projeto acadêmico para prática de:

* PHP Orientado a Objetos
* CRUD
* PDO
* Sessões
* Autenticação de usuários
* Integração com MySQL
