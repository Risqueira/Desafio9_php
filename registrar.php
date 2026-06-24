<?php
include_once './config/config.php';
include_once './classes/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = new Usuario($db);
    $nome  = $_POST['nome'];
    $sexo  = $_POST['sexo'];
    $fone  = $_POST['fone'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $usuario->criar($nome, $sexo, $fone, $email, $senha);
    header('Location: portal.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Usuário</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 420px;
        }
        h1 { text-align: center; color: #333; margin-bottom: 28px; font-size: 1.4rem; }
        label { display: block; margin-bottom: 5px; color: #555; font-weight: 600; }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            margin-bottom: 18px;
            transition: border-color 0.2s;
        }
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #4a90e2;
        }
        .radio-group { margin-bottom: 18px; }
        .radio-group label { display: inline; margin-right: 20px; font-weight: normal; }
        .radio-group input { margin-right: 5px; }
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background: #27ae60;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.2s;
        }
        input[type="submit"]:hover { background: #1e8449; }
        .voltar { text-align: center; margin-top: 16px; }
        .voltar a { color: #4a90e2; text-decoration: none; }
        .voltar a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Adicionar Usuário</h1>
        <form method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label>Sexo:</label>
            <div class="radio-group">
                <label>
                    <input type="radio" id="masculino" name="sexo" value="M" required> Masculino
                </label>
                <label>
                    <input type="radio" id="feminino" name="sexo" value="F"> Feminino
                </label>
            </div>

            <label for="fone">Fone:</label>
            <input type="text" id="fone" name="fone" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <input type="submit" value="Adicionar">
        </form>
        <div class="voltar">
            <a href="index.php">← Voltar ao login</a>
        </div>
    </div>
</body>
</html>