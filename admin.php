<?php
session_start();
include 'conectar.php';

if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'admin') {
    header("Location: index.php");
    exit;
}
?>

if ($tipo == "admin") {

    $sql = "SELECT * FROM administradores WHERE usuario = '$usuario'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $dados = $resultado->fetch_assoc();

        if (password_verify($senha, $dados['senha'])) {

            $_SESSION['admin'] = $usuario;
            header("Location: painel_admin.php");
            exit;

        } else {
            $erro = "Senha incorreta!";
        }

    } else {
        $erro = "Admin não encontrado!";
    }
}