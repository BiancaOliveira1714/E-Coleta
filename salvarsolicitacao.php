<?php

include("conexao.php");

$nome = $_POST['nome'];
$endereco = $_POST['endereco'];
$tipo = $_POST['tipo_lixo'];
$descricao = $_POST['descricao'];

$sql = "INSERT INTO solicitacoes (nome,endereco,tipo_lixo,descricao)
VALUES ('$nome','$endereco','$tipo','$descricao')";

mysqli_query($conexao,$sql);

header("Location:index.php");

?>