<?php
session_start();
include 'conectar.php';

$sql = "SELECT * FROM catadores ORDER BY criado_em DESC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ecoleta</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

<header class="nav">
  <div class="container nav-content">


    <a href="index.php" class="logo">♻️ Ecoleta</a>

 <?php $pagina_atual = basename($_SERVER['PHP_SELF']); ?>

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

<!-- HERO -->
<section class="hero">
  <div class="container hero-grid">

    <div class="text">
      <h1>Agende sua coleta<br>de recicláveis de<br>forma fácil</h1>
      <p>
       Conectando quem quer descartar com quem sabe reciclar.
      </p>

      <a href="solicitar_coleta.php" class="btn grande">
        Solicitar Coleta →
      </a>
    </div>

    <img src="img/mascote.png" class="hero-img" alt="Mascote da Ecoleta">

  </div>
</section>

<section id="como" class="secao">
  <h2>Como Funciona</h2>
  <p class="sub">Um processo simples e rápido</p>

  <div class="cards">
    <div class="card">
      <h3>Solicite a Coleta</h3>
      <p>Informe seus recicláveis</p>
    </div>

    <div class="card">
      <h3>Coletor Aceita</h3>
      <p>Um coletor próximo aceita</p>
    </div>

    <div class="card">
      <h3>Material Coletado</h3>
      <p>Destino correto garantido</p>
    </div>
  </div>
</section>


<section id="beneficios" class="secao verde">
  <h2>Por Que Usar a Ecoleta?</h2>

  <div class="cards">
    <div class="card">
      <h3>Ajude o Meio Ambiente</h3>
      <p>Reduza resíduos e preserve a natureza</p>
    </div>

    <div class="card">
      <h3>Rápido e Fácil</h3>
      <p>Agende em minutos</p>
    </div>

    <div class="card">
      <h3>Apoie Coletores</h3>
      <p>Fortaleça a economia local</p>
    </div>
  </div>
</section>


<section id="sobre" class="sobre">
  <div class="container grid">

    <img src="img/sobre.png" class="img-sobre" alt="Imagem sobre a plataforma Ecoleta">

    <div>
      <h2>Sobre a Plataforma</h2>
      <p>
       A Ecoleta é uma plataforma digital que conecta usuários a coletores especializados,
        facilitando o descarte correto de resíduos e incentivando práticas sustentáveis por meio de uma solução prática,
        acessível e eficiente.
      </p>
    </div>

  </div>
</section>

<!-- CTA -->
<section class="cta">
  <div class="container grid">

    <div>
      <h2>Pronto para fazer a diferença?</h2>
      <p>Cada pequena atitude conta. Junte-se a quem já está cuidando do nosso planeta!</p>

      <a href="solicitar_coleta.php" class="btn branco">
        Começar agora →
      </a>
    </div>

    <img src="img/cta.png" class="img-cta" alt="Imagem de incentivo à coleta sustentável">

  </div>
</section>

<footer>
  Ecoleta © 2026
</footer>

<script src="script.js"></script>
</body>
</html>