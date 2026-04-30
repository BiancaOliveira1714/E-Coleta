<?php
session_start();
include 'conectar.php';

if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'coletor') {
    header("Location: index.php");
    exit;
}

$sql = "SELECT * FROM solicitacoes WHERE status = 'Pendente'";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Painel do Coletor</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<header class="nav">
  <div class="container nav-content">
    <a href="index.php" class="logo">♻️ Ecoleta</a>
  </div>
</header>

<section class="secao">
  <h2>Solicitações Disponíveis</h2>

  <div class="cards-catadores">

    <?php if ($resultado->num_rows > 0) { ?>

      <?php while($s = $resultado->fetch_assoc()) { ?>

        <div class="card-catador">
          <h3><?php echo $s['nome_usuario']; ?></h3>

          <p><strong>WhatsApp:</strong> <?php echo $s['whatsapp']; ?></p>
          <p><strong>Cidade:</strong> <?php echo $s['cidade']; ?></p>
          <p><strong>Bairro:</strong> <?php echo $s['bairro']; ?></p>
          <p><strong>Material:</strong> <?php echo $s['material']; ?></p>
          <p><strong>Quantidade:</strong> <?php echo $s['quantidade']; ?></p>

          <a class="btn" href="aceitar_coleta.php?id=<?php echo $s['id']; ?>">
            Aceitar Coleta
          </a>
        </div>

      <?php } ?>

    <?php } else { ?>
      <p>Nenhuma solicitação disponível.</p>
    <?php } ?>

  </div>
</section>

</body>
</html>