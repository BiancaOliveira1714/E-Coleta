<?php include 'conectar.php'; ?>

<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastro de Coletor - Ecoleta</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<header class="nav">
  <div class="container nav-content">

    <!-- Logo clicável -->
    <a href="index.php" class="logo">♻️ Ecoleta</a>

  <?php $pagina_atual = basename($_SERVER['PHP_SELF']); ?>

<nav>

  <?php if ($pagina_atual != 'index.php') { ?>
    <a href="index.php">Início</a>
  <?php } ?>

  <?php if ($pagina_atual != 'solicitar_coleta.php') { ?>
    <a href="solicitar_coleta.php">Solicitar Coleta</a>
  <?php } ?>

  <?php if ($pagina_atual != 'catadores.php') { ?>
    <a href="catadores.php">Coletores</a>
  <?php } ?>

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

    <span>👤 <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></span>

    <?php if ($_SESSION['tipo'] == 'admin' && $pagina_atual != 'painel_admin.php') { ?>
      <a href="painel_admin.php">Admin</a>
    <?php } ?>

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

  <?php if ($pagina_atual != 'suporte.php') { ?>
  <a href="suporte.php">Suporte</a>
<?php } ?>

</nav>

  </div>
</header>

<section class="secao">
  <h2>Cadastro de Coletor</h2>
  <p class="sub">Cadastre seus dados para que as pessoas encontrem você</p>

  <form class="form-catador" action="salvar_catador.php" method="POST">

    <input type="text" name="nome" placeholder="Nome completo" required>

    <input type="tel" name="telefone" placeholder="Telefone" required>

    <input type="tel" name="whatsapp" placeholder="WhatsApp com DDD" required>

    <input type="text" name="cidade" placeholder="Cidade" required>

    <input type="text" name="bairro" placeholder="Bairro" required>

    <input type="text" name="endereco" placeholder="Local onde pode levar os recicláveis" required>

    <input type="text" name="materiais" placeholder="Materiais que aceita: papel, plástico, vidro..." required>

    <textarea name="observacao" placeholder="Observações"></textarea>

    <input type="password" name="senha" placeholder="Crie uma senha" required>

    <button class="btn grande" type="submit">Cadastrar Coletor</button>

  </form>
</section>

<footer>
  Ecoleta © 2026
</footer>

</body>
</html>