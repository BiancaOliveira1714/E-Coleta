<?php
session_start();
include 'conectar.php';

$pagina_atual = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Suporte - Ecoleta</title>
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
  <h2>Central de Suporte</h2>
  <p class="sub">Tire suas dúvidas sobre o funcionamento da Ecoleta</p>

  <div class="cards-catadores">

    <div class="card-catador">
      <h3>Como solicitar uma coleta?</h3>
      <p>
        Acesse a página “Solicitar Coleta”, preencha seus dados, informe o material
        e envie sua solicitação. Um coletor poderá visualizar o pedido pela plataforma.
      </p>
    </div>

    <div class="card-catador">
      <h3>Preciso pagar para usar a Ecoleta?</h3>
      <p>
        No momento, a Ecoleta funciona de maneira gratuita, podendo acessar coletores e realizar os descartes de maneira certa.
      </p>
    </div>

    <div class="card-catador">
      <h3>Como me cadastro como coletor?</h3>
      <p>
        Clique em “Sou Coletor”, preencha seus dados, materiais aceitos e crie uma senha.
        Depois disso, você poderá acessar o painel do coletor.
      </p>
    </div>

    <div class="card-catador">
      <h3>O que acontece depois que eu envio uma solicitação?</h3>
      <p>
        Sua solicitação fica disponível para os coletores. Quando um coletor aceitar,
        o status poderá ser atualizado para “Em andamento”.
      </p>
    </div>

    <div class="card-catador">
      <h3>Quais materiais posso descartar?</h3>
      <p>
        A plataforma aceita solicitações para materiais como plástico, papel, vidro,
        metal, eletrônico, óleo de cozinha e outros recicláveis.
      </p>
    </div>

    <div class="card-catador">
      <h3>Por que não aparece o telefone do coletor?</h3>
      <p>
        Para deixar o sistema mais organizado e seguro, o contato direto não aparece.
        A ideia é que a coleta seja solicitada e acompanhada pela própria plataforma.
      </p>
    </div>

  </div>
</section>

<section class="secao">
  <h2>Ainda precisa de ajuda?</h2>
  <p class="sub">Entre em contato com a equipe Ecoleta</p>

  <form class="form-catador" action="#" method="POST">
    <input type="text" name="nome" placeholder="Seu nome" required>
    <input type="email" name="email" placeholder="Seu e-mail" required>
    <textarea name="mensagem" placeholder="Digite sua dúvida ou problema" required></textarea>

    <button class="btn grande" type="submit">Enviar Mensagem</button>
  </form>
</section>

<footer>
  Ecoleta © 2026
</footer>

</body>
</html>