<?php
include 'conectar.php';

$endereco = $_POST['endereco'];
$material = $_POST['material'];

$sql = "INSERT INTO pedidos (endereco, material) VALUES ('$endereco', '$material')";

if ($conn->query($sql)) {
    echo "Pedido enviado com sucesso!";
} else {
    echo "Erro!";
}
?>