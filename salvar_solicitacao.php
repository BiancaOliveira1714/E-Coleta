<?php
include 'conectar.php';

$nome_usuario = $_POST['nome_usuario'];
$whatsapp = $_POST['whatsapp'];
$endereco = $_POST['endereco'];
$material = $_POST['material'];
$quantidade = $_POST['quantidade'];
$observacao = $_POST['observacao'];

$sql = "INSERT INTO solicitacoes_coleta
(nome_usuario, whatsapp, endereco, material, quantidade, observacao)
VALUES
('$nome_usuario', '$whatsapp', '$endereco', '$material', '$quantidade', '$observacao')";

if ($conn->query($sql)) {
    echo "<script>
        alert('Solicitação enviada com sucesso!');
        window.location.href='index.php';
    </script>";
} else {
    echo 'Erro ao enviar solicitação!';
}
?>