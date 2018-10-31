<?php
 
//Conecta com o MySQL usando PDO
function db_connect()
{
    try {
	    $conexao = new PDO("mysql:host=localhost;port=3306;dbname=login", "root", "");
	    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $conexao->exec("set names utf8");
	    return $conexao;
	} catch (PDOException $erro) {
	    echo "Erro na conexão:".$erro->getMessage();
	}
}
 
//Cria o hash da senha, usando MD5 e SHA-1
function make_hash($str)
{
    return sha1(md5($str));
}
 
//Verifica se o usuário está logado
function isLoggedIn()
{
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true)
    {
        return false;
    }
    
    return true;
}

?>