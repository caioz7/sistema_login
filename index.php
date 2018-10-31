<?php
session_start();
 
require 'conexao.php';
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
 
        <title>Sistema de Login PHP</title>
    </head>
 
    <body>
         
        <h1>Sistema de Login PHP</h1>
 
        <?php if (isLoggedIn()):
        
            header("Location: home.php");

        else: 

            echo "Olá, visitante. <a href=form-login.php>Login</a></p>";
            
        endif; 
        
        ?>
 
    </body>
</html>