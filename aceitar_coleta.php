<?php
session_start();
include 'conectar.php';

if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'coletor') {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

$sql = "UPDATE solicitacoes 
        SET status = 'Em andamento' 
        WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: coletas_disponiveis.php");
} else {
    echo "Erro ao aceitar coleta";
}
?>