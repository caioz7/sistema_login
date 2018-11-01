<?php
    session_start();

    require_once 'conexao.php';
    require_once 'verifica_sessao.php';
    require_once './assets/header.php';
?>
    <h1>
        HOME do Sistema
    </h1>

    <p>
        Seja bem vindo, <?php echo $_SESSION['user_name']; ?>.
    </p>
    
    <a href="javascript:window.history.go(-1)">
        Voltar
    </a>

    <br/><br/><br/>
    
    <a href="logout.php">
        Sair
    </a>
<?php require_once './assets/footer.php'; ?>