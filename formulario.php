<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('config.php');

$sucesso = false; // variável para mostrar a mensagem de sucesso

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome       = $_POST['nome'];
    $email      = $_POST['email'];
    $telefone   = $_POST['telefone'];
    $sexo       = $_POST['genero'];
    $data_nasc  = $_POST['data_nascimento'];
    $cidade     = $_POST['cidade'];
    $estado     = $_POST['estado'];
    $endereco   = $_POST['endereco'];

    $stmt = mysqli_prepare(
        $conexao,
        "INSERT INTO usuarios 
        (nome, email, telefone, sexo, data_nasc, cidade, estado, endereco) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "ssssssss",
        $nome,
        $email,
        $telefone,
        $sexo,
        $data_nasc,
        $cidade,
        $estado,
        $endereco
    );

    if (mysqli_stmt_execute($stmt)) {
        $sucesso = true; // marca que deu certo
    }

    mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Formulário | GN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
        }
        .box{
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            background-color: rgba(0, 0, 0, 0.6);
            padding: 15px;
            border-radius: 15px;
            width: 20%;
        }
        fieldset .inputBox:first-of-type{
            margin-top: 10px;
        }

        legend{
            border: 1px solid dodgerblue;
            padding: 10px;
            text-align: center;
            background-color: dodgerblue;
            border-radius: 4px;
        }

        .inputBox{
            position: relative;
        }
        .inputUser{
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: white;
            font-size: 15px;
            width: 100%;
            letter-spacing: 2px;
        }
        .labelInput{
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none;
            transition: .5s;
        }
        .inputUser:focus ~ .labelInput,
        .inputUser:valid ~ .labelInput{
            top: -14px;
            font-size: 12px;
            color: dodgerblue;
        }
        #data_nascimento{
            border: none;
            padding: 8px;
            border-radius: 10px;
            outline: none;
            font-size: 15px;
        }
        #submit{
            background-image: linear-gradient(to right,rgb(0, 92, 197), rgb(90, 20, 220));
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
        }
        #submit:hover{
            background-image: linear-gradient(to right,rgb(0, 80, 172), rgb(80, 19, 195));
        }
        .mensagem-sucesso{
            color: lime;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

<div class="box">

    <?php
    if ($sucesso) {
        echo "<p class='mensagem-sucesso'>Dados cadastrados com sucesso!</p>";
    }
    ?>

    <form method="POST" action="">
        <fieldset>
            <legend><b>Formulário de Clientes</b></legend>

            <div class="inputBox">
                <input type="text" name="nome" class="inputUser" required>
                <label class="labelInput">Nome completo</label>
            </div><br>

            <div class="inputBox">
                <input type="email" name="email" class="inputUser" required>
                <label class="labelInput">Email</label>
            </div><br>

            <div class="inputBox">
                <input type="tel" name="telefone" class="inputUser" required>
                <label class="labelInput">Telefone</label>
            </div><br>

            <p>Sexo:</p>
            <input type="radio" name="genero" value="feminino" required> Feminino<br>
            <input type="radio" name="genero" value="masculino"> Masculino<br>
            <input type="radio" name="genero" value="outro"> Outro<br><br>

            <label><b>Data de Nascimento:</b></label><br>
            <input type="date" name="data_nascimento" id="data_nascimento" required><br><br>

            <div class="inputBox">
                <input type="text" name="cidade" class="inputUser" required>
                <label class="labelInput">Cidade</label>
            </div><br>

            <div class="inputBox">
                <input type="text" name="estado" class="inputUser" required>
                <label class="labelInput">Estado</label>
            </div><br>

            <div class="inputBox">
                <input type="text" name="endereco" class="inputUser" required>
                <label class="labelInput">Endereço</label>
            </div><br>

            <input type="submit" id="submit" value="Cadastrar">
        </fieldset>
    </form>
</div>

</body>
</html>
