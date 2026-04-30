<?php
session_start();
include 'conectar.php';

$sql = "SELECT * FROM catadores ORDER BY criado_em DESC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Coletores - Ecoleta</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<header class="nav">
  <div class="container nav-content">

    <a href="index.php" class="logo">♻️ Ecoleta</a>

 <?php $pagina_atual = basename($_SERVER['PHP_SELF']); ?>

<nav>

  <!-- PRINCIPAIS -->
  <?php if ($pagina_atual != 'index.php') { ?>
    <a href="index.php">Início</a>
  <?php } ?>

  <?php if ($pagina_atual != 'solicitar_coleta.php') { ?>
    <a href="solicitar_coleta.php">Solicitar Coleta</a>
  <?php } ?>

  <?php if ($pagina_atual != 'catadores.php') { ?>
    <a href="catadores.php">Coletores</a>
  <?php } ?>

  <?php if ($pagina_atual != 'suporte.php') { ?>
    <a href="suporte.php">Suporte</a>
  <?php } ?>

  <!-- NÃO LOGADO -->
  <?php if (!isset($_SESSION['usuario_nome'])) { ?>

    <?php if ($pagina_atual != 'login.php') { ?>
      <a href="login.php">Login</a>
    <?php } ?>

    <?php if ($pagina_atual != 'cadastro_usuarios.php') { ?>
      <a href="cadastro_usuarios.php">Cadastro</a>
    <?php } ?>

    <?php if ($pagina_atual != 'cadastro_catador.php') { ?>
      <a href="cadastro_catador.php">Sou Coletor</a>
    <?php } ?>

  <?php } else { ?>

    <!-- USUÁRIO LOGADO -->
    <span class="usuario-logado">
      👤 <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>
    </span>

    <!-- ADMIN -->
    <?php if ($_SESSION['tipo'] == 'admin' && $pagina_atual != 'painel_admin.php') { ?>
      <a href="painel_admin.php">Admin</a>
    <?php } ?>

    <!-- COLETOR -->
    <?php if ($_SESSION['tipo'] == 'coletor') { ?>

      <?php if ($pagina_atual != 'painel_coletor.php') { ?>
        <a href="painel_coletor.php">Painel Coletor</a>
      <?php } ?>

      <?php if ($pagina_atual != 'coletas_disponiveis.php') { ?>
        <a href="coletas_disponiveis.php">Coletas</a>
      <?php } ?>

    <?php } ?>

    <a href="logout_usuario.php">Sair</a>

  <?php } ?>

</nav>

  </div>
</header>

<section class="secao">
  <h2>Coletores Disponíveis</h2>
  <p class="sub">Veja os coletores disponíveis na sua região</p>

  <div class="cards-catadores">

    <?php if ($resultado && $resultado->num_rows > 0) { ?>

      <?php while($catador = $resultado->fetch_assoc()) { ?>

        <div class="card-catador">
          <h3><?php echo htmlspecialchars($catador['nome']); ?></h3>

          <p><strong>Status:</strong> Disponível para solicitações</p>
          <p><strong>Cidade:</strong> <?php echo htmlspecialchars($catador['cidade']); ?></p>
          <p><strong>Bairro de atuação:</strong> <?php echo htmlspecialchars($catador['bairro']); ?></p>
          <p><strong>Materiais aceitos:</strong> <?php echo htmlspecialchars($catador['materiais']); ?></p>

          <?php if (!empty($catador['observacao'])) { ?>
            <p><strong>Disponibilidade:</strong> <?php echo htmlspecialchars($catador['observacao']); ?></p>
          <?php } else { ?>
            <p><strong>Disponibilidade:</strong> A combinar pela solicitação</p>
          <?php } ?>

          <a class="btn" href="solicitar_coleta.php">
            Solicitar Coleta
          </a>
        </div>

      <?php } ?>

    <?php } else { ?>

      <p style="text-align:center; margin-top:20px;">
        Nenhum coletor disponível no momento 😢
      </p>

    <?php } ?>

  </div>
</section>

<footer>
  Ecoleta © 2026
</footer>

</body>
</html>