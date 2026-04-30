<?php
$conn = new mysqli("localhost", "root", "", "ecoleta");

if ($conn->connect_error) {
    die("Erro: " . $conn->connect_error);
}
?>