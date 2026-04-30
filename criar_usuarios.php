<?php
include 'conectar.php';

$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$whatsapp = $_POST['whatsapp'];
$cidade = $_POST['cidade'];
$bairro = $_POST['bairro'];
$endereco = $_POST['endereco'];
$senha = $_POST['senha'];

$sql = "INSERT INTO usuarios 
(nome, telefone, whatsapp, cidade, bairro, endereco, senha)
VALUES 
('$nome', '$telefone', '$whatsapp', '$cidade', '$bairro', '$endereco', '$senha')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
        alert('Cadastro realizado com sucesso!');
        window.location.href='login.php';
    </script>";
} else {
    echo "Erro: " . $conn->error;
}
?>