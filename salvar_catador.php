<?php
include 'conectar.php';

$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$whatsapp = $_POST['whatsapp'];
$cidade = $_POST['cidade'];
$bairro = $_POST['bairro'];
$endereco = $_POST['endereco'];
$materiais = $_POST['materiais'];
$observacao = $_POST['observacao'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

$sql = "INSERT INTO catadores 
(nome, telefone, whatsapp, cidade, bairro, endereco, materiais, observacao)
VALUES 
('$nome', '$telefone', '$whatsapp', '$cidade', '$bairro', '$endereco', '$materiais', '$observacao')";

if ($conn->query($sql) === TRUE) {

    $sql_usuario = "INSERT INTO usuarios 
    (nome, telefone, whatsapp, cidade, bairro, endereco, senha, tipo)
    VALUES 
    ('$nome', '$telefone', '$whatsapp', '$cidade', '$bairro', '$endereco', '$senha', 'coletor')";

    if ($conn->query($sql_usuario) === TRUE) {
        echo "<script>
            alert('Cadastro de coletor realizado com sucesso!');
            window.location.href='login.php';
        </script>";
    } else {
        echo 'Erro ao criar login do coletor: ' . $conn->error;
    }

} else {
    echo 'Erro ao cadastrar coletor: ' . $conn->error;
}
?>