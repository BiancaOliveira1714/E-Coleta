<?php

include "conectar.php";

$nome = $_POST['nome'];
$endereco = $_POST['endereco'];
$tipo = $_POST['tipo_lixo'];
$data = $_POST['data_coleta'];

$sql = "INSERT INTO solicitacoes (nome,endereco,tipo_lixo,data_coleta)
VALUES ('$nome','$endereco','$tipo','$data')";

if(mysqli_query($conexao,$sql)){
echo "Solicitação enviada com sucesso!";
}else{
echo "Erro ao enviar";
}

?>