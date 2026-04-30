<?php
session_start();
include 'conectar.php';

if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'admin') {
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);

if ($id == $_SESSION['usuario_id']) {
    echo "<script>
        alert('Você não pode excluir sua própria conta.');
        window.location.href='painel_admin.php';
    </script>";
    exit;
}

$conn->query("DELETE FROM usuarios WHERE id = $id");

header("Location: painel_admin.php");
exit;
?>