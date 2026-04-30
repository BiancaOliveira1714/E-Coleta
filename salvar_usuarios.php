<?php
include 'conectar.php';

$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$whatsapp = $_POST['whatsapp'];
$cidade = $_POST['cidade'];
$bairro = $_POST['bairro'];
$endereco = $_POST['endereco'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios 
(nome, telefone, whatsapp, cidade, bairro, endereco, senha, tipo)
VALUES 
('$nome', '$telefone', '$whatsapp', '$cidade', '$bairro', '$endereco', '$senha', 'usuario')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
        alert('Cadastro realizado com sucesso!');
        window.location.href='/ecoleta/login.php';
    </script>";
} else {
    echo 'Erro ao cadastrar usuário: ' . $conn->error;
}
?>