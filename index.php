<?php
session_start();
include_once './config/config.php';
include_once './classes/Usuario.php';


$usuario = new Usuario($db);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        // Processar login
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        if ($dados_usuario = $usuario->login($email, $senha)) {
            $_SESSION['usuario_id'] = $dados_usuario['id'];
            header('Location: portal.php');
            exit();
        } else {
            $mensagem_erro = "Credenciais inválidas!";
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>A U T E N T I C A Ç Ã O</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

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
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 1.4rem;
            letter-spacing: 3px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: 600;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            margin-bottom: 20px;
            transition: border-color 0.2s;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #4a90e2;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background: #4a90e2;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.2s;
        }

        input[type="submit"]:hover {
            background: #357abd;
        }

        .link-registro {
            text-align: center;
            margin-top: 18px;
            color: #555;
        }

        .link-registro a {
            color: #4a90e2;
            text-decoration: none;
        }

        .link-registro a:hover {
            text-decoration: underline;
        }

        .mensagem {
            margin-top: 15px;
            color: #e74c3c;
            text-align: center;
            font-weight: 600;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="box">
            <h1>A U T E N T I C A Ç Ã O</h1>

            <form method="POST">
                <label for="email">Email:</label>
                <input type="email" name="email" required>
                <br><br>
                <label for="senha">Senha:</label>
                <input type="password" name="senha" required>
                <br><br>
                <input type="submit" name="login" value="Login">
            </form>
            <p>Não tem uma conta? <a href="./registrar.php">Registre-se aqui</a></p>
            <div class="mensagem">
                <?php if (isset($mensagem_erro))
                    echo '<p>' . $mensagem_erro . '</p>'; ?>
            </div>
        </div>

</body>


</html>