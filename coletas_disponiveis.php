<?php
session_start();
include 'conectar.php';

// só coletor pode ver
if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'coletor') {
    header("Location: index.php");
    exit;
}

$sql = "SELECT * FROM solicitacoes WHERE status = 'Pendente' ORDER BY data_criacao DESC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Coletas Disponíveis - Ecoleta</title>
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
  <h2>Coletas Disponíveis</h2>
  <p class="sub">Veja pedidos próximos e aceite uma coleta</p>

  <div class="cards-catadores">

    <?php if ($resultado->num_rows > 0) { ?>

      <?php while($s = $resultado->fetch_assoc()) { ?>

        <div class="card-catador">
          <h3><?php echo htmlspecialchars($s['material']); ?></h3>

          <p><strong>Cidade:</strong> <?php echo htmlspecialchars($s['cidade']); ?></p>
          <p><strong>Bairro:</strong> <?php echo htmlspecialchars($s['bairro']); ?></p>
          <p><strong>Quantidade:</strong> <?php echo htmlspecialchars($s['quantidade']); ?></p>

          <?php if (!empty($s['observacao'])) { ?>
            <p><strong>Obs:</strong> <?php echo htmlspecialchars($s['observacao']); ?></p>
          <?php } ?>

          <a class="btn" href="aceitar_coleta.php?id=<?php echo $s['id']; ?>">
            Aceitar Coleta
          </a>
        </div>

      <?php } ?>

    <?php } else { ?>
      <p>Nenhuma coleta disponível no momento 😢</p>
    <?php } ?>

  </div>
</section>

</body>
</html>
