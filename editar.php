<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}

include_once './config/config.php';
include_once './classes/Usuario.php';

$usuario = new Usuario($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id    = $_POST['id'];
    $nome  = $_POST['nome'];
    $sexo  = $_POST['sexo'];
    $fone  = $_POST['fone'];
    $email = $_POST['email'];
    $usuario->atualizar($id, $nome, $sexo, $fone, $email);
    header('Location: portal.php');
    exit();
}

if (isset($_GET['id'])) {
    $id  = $_GET['id'];
    $row = $usuario->lerPorId($id);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
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
        input[type="email"] {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            margin-bottom: 18px;
            transition: border-color 0.2s;
        }
        input[type="text"]:focus,
        input[type="email"]:focus {
            outline: none;
            border-color: #f39c12;
        }
        .radio-group { margin-bottom: 18px; }
        .radio-group label { display: inline; margin-right: 20px; font-weight: normal; }
        .radio-group input { margin-right: 5px; }
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background: #f39c12;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.2s;
        }
        input[type="submit"]:hover { background: #d68910; }
        .voltar { text-align: center; margin-top: 16px; }
        .voltar a { color: #4a90e2; text-decoration: none; }
        .voltar a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Usuário</h1>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($row['nome']); ?>" required>

            <label>Sexo:</label>
            <div class="radio-group">
                <label>
                    <input type="radio" id="masculino_editar" name="sexo" value="M"
                        <?php echo ($row['sexo'] === 'M') ? 'checked' : ''; ?> required> Masculino
                </label>
                <label>
                    <input type="radio" id="feminino_editar" name="sexo" value="F"
                        <?php echo ($row['sexo'] === 'F') ? 'checked' : ''; ?>> Feminino
                </label>
            </div>

            <label for="fone">Fone:</label>
            <input type="text" id="fone" name="fone" value="<?php echo htmlspecialchars($row['fone']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>

            <input type="submit" value="Atualizar">
        </form>
        <div class="voltar">
            <a href="portal.php">← Voltar para portal</a>
        </div>
    </div>
</body>
</html>