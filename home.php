<?php
session_start();
 
require_once 'conexao.php';

require 'verifica_sessao.php';

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
 
        <title>HOME do Sistema</title>
    </head>
 
    <body>
        
        <h1>HOME do Sistema</h1>

        <p>Seja bem vindo, <?php echo $_SESSION['user_name']; ?>.</p>
        
        <a href="javascript:window.history.go(-1)">Voltar</a>

        <br /><br /><br /><a href="logout.php">Sair</a></p>
    </body>
</html>