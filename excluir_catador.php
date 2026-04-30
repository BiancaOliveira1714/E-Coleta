<?php
session_start();
include 'conectar.php';

if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'admin') {
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);

$conn->query("DELETE FROM catadores WHERE id = $id");

header("Location: painel_admin.php");
exit;
?>