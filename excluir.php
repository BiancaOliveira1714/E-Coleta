<?php

include("conexao.php");

$id = $_GET['id'];

$sql = "DELETE FROM solicitacoes WHERE id=$id";

mysqli_query($conexao,$sql);

header("Location:admin.php");

?>