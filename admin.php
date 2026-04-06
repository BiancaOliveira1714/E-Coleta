<?php
include("conexao.php");

$sql = "SELECT * FROM solicitacoes";

$resultado = mysqli_query($conexao,$sql);
?>

<!DOCTYPE html>
<html>

<head>

<title>Painel Admin</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<h1>Painel Administrativo</h1>

<table>

<tr>

<th>ID</th>
<th>Nome</th>
<th>Endereço</th>
<th>Tipo</th>
<th>Descrição</th>
<th>Ação</th>

</tr>

<?php

while($linha = mysqli_fetch_assoc($resultado)){

echo "<tr>";

echo "<td>".$linha['id']."</td>";

echo "<td>".$linha['nome']."</td>";

echo "<td>".$linha['endereco']."</td>";

echo "<td>".$linha['tipo_lixo']."</td>";

echo "<td>".$linha['descricao']."</td>";

echo "<td>

<a href='excluir.php?id=".$linha['id']."'>Excluir</a>

</td>";

echo "</tr>";

}

?>

</table>

</body>

</html>