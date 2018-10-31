<?php
 
require_once 'conexao.php';
 
if (!isLoggedIn())
{
    header('Location: form-login.php');
}

?>