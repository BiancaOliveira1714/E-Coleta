<?php
session_start();
include 'conectar.php';

$erro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE nome = '$usuario'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $dados = $resultado->fetch_assoc();

        if (password_verify($senha, $dados['senha'])) {
            $_SESSION['usuario_id'] = $dados['id'];
            $_SESSION['usuario_nome'] = $dados['nome'];
            $_SESSION['tipo'] = $dados['tipo'];

            if ($dados['tipo'] == 'admin') {
                header("Location: painel_admin.php");
                exit;
            } elseif ($dados['tipo'] == 'coletor') {
                header("Location: painel_coletor.php");
                exit;
            } else {
                header("Location: index.php");
                exit;
            }

        } else {
            $erro = "Senha incorreta!";
        }
    } else {
        $erro = "Usuário não encontrado!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Ecoleta</title>
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

<section class="secao">
  <h2>Entrar na Ecoleta</h2>
  <p class="sub">Acesse sua conta</p>

  <?php if (!empty($erro)) { ?>
    <p style="color:red; text-align:center;"><?php echo $erro; ?></p>
  <?php } ?>

  <form class="form-catador" method="POST">
    <input type="text" name="usuario" placeholder="Nome de usuário" required>

    <input type="password" name="senha" placeholder="Senha" required>

    <button class="btn grande" type="submit">Entrar</button>
  </form>
</section>

<footer>
  Ecoleta © 2026
</footer>

</body>
</html>