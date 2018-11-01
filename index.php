<?php
    session_start();
    require_once 'conexao.php';
    require_once './assets/header.php';

?>
    <h1 class="text-center bg-primary mb-0 text-white p-2">Sistema de Login PHP</h1>   
 
<?php 
    if (isLoggedIn()){
        header("Location: home.php");
    }
    else{
?>
    <h5 class="text-center p-3">
        Olá, visitante. 
        <br>
        <a href="form-login.php" class="">Clique para Logar</a></p>    
    </h5>
    

<?php
    }
    require_once './assets/footer.php';
?>