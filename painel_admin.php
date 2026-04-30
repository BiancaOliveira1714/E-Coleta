<?php
session_start();
include 'conectar.php';

if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'admin') {
    header("Location: index.php");
    exit;
}

$coletores = $conn->query("SELECT * FROM catadores ORDER BY criado_em DESC");
$usuarios = $conn->query("SELECT * FROM usuarios ORDER BY criado_em DESC");
$solicitacoes = $conn->query("SELECT * FROM solicitacoes ORDER BY data_criacao DESC");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Painel Admin - Ecoleta</title>
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
  <h2>Painel Administrativo</h2>
  <p class="sub">Gerencie todo o sistema Ecoleta</p>
</section>

<!-- USUÁRIOS -->
<section class="secao">
  <h2>Usuários</h2>

  <div class="cards-catadores">
    <?php if ($usuarios && $usuarios->num_rows > 0) { ?>
      <?php while ($u = $usuarios->fetch_assoc()) { ?>

        <div class="card-catador">
          <h3><?php echo htmlspecialchars($u['nome']); ?></h3>

          <p><strong>Tipo:</strong> <?php echo htmlspecialchars($u['tipo']); ?></p>
          <p><strong>Telefone:</strong> <?php echo htmlspecialchars($u['telefone']); ?></p>
          <p><strong>WhatsApp:</strong> <?php echo htmlspecialchars($u['whatsapp']); ?></p>
          <p><strong>Cidade:</strong> <?php echo htmlspecialchars($u['cidade']); ?></p>
          <p><strong>Bairro:</strong> <?php echo htmlspecialchars($u['bairro']); ?></p>

          <a class="btn"
             href="excluir_usuario.php?id=<?php echo $u['id']; ?>"
             onclick="return confirm('Excluir este usuário?')">
             Excluir Usuário
          </a>

        </div>

      <?php } ?>
    <?php } else { ?>
      <p>Nenhum usuário cadastrado.</p>
    <?php } ?>
  </div>
</section>

<!-- COLETORES -->
<section class="secao">
  <h2>Coletores</h2>

  <div class="cards-catadores">
    <?php if ($coletores && $coletores->num_rows > 0) { ?>
      <?php while ($c = $coletores->fetch_assoc()) { ?>

        <div class="card-catador">
          <h3><?php echo htmlspecialchars($c['nome']); ?></h3>

          <p><strong>Cidade:</strong> <?php echo htmlspecialchars($c['cidade']); ?></p>
          <p><strong>Bairro:</strong> <?php echo htmlspecialchars($c['bairro']); ?></p>
          <p><strong>Materiais:</strong> <?php echo htmlspecialchars($c['materiais']); ?></p>

          <a class="btn"
             href="excluir_catador.php?id=<?php echo $c['id']; ?>"
             onclick="return confirm('Excluir este coletor?')">
             Excluir Coletor
          </a>

        </div>

      <?php } ?>
    <?php } else { ?>
      <p>Nenhum coletor cadastrado.</p>
    <?php } ?>
  </div>
</section>

<!-- SOLICITAÇÕES -->
<section class="secao">
  <h2>Solicitações</h2>

  <div class="cards-catadores">
    <?php if ($solicitacoes && $solicitacoes->num_rows > 0) { ?>
      <?php while ($s = $solicitacoes->fetch_assoc()) { ?>

        <div class="card-catador">
          <h3><?php echo htmlspecialchars($s['material']); ?></h3>

          <p><strong>Usuário:</strong> <?php echo htmlspecialchars($s['nome_usuario']); ?></p>
          <p><strong>Cidade:</strong> <?php echo htmlspecialchars($s['cidade']); ?></p>
          <p><strong>Bairro:</strong> <?php echo htmlspecialchars($s['bairro']); ?></p>
          <p><strong>Quantidade:</strong> <?php echo htmlspecialchars($s['quantidade']); ?></p>
          <p><strong>Status:</strong> <?php echo htmlspecialchars($s['status']); ?></p>

        </div>

      <?php } ?>
    <?php } else { ?>
      <p>Nenhuma solicitação cadastrada.</p>
    <?php } ?>
  </div>
</section>

<footer>
  Ecoleta © 2026
</footer>

</body>
</html>