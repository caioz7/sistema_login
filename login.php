<?php
 
// inclui o arquivo de inicialização
require 'conexao.php';
 
// resgata variáveis do formulário
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
 
if (empty($email) || empty($password))
{
	require_once './assets/header.php';
    echo "
    	<h1 class='text-center'>Informe email e senha.
    	<br>
    	<a href='javascript:history.back()''>Voltar</a> </h1>
	";
	require_once './assets/footer.php';
    exit;
}
 
// cria o hash da senha
$passwordHash = make_hash($password);
 
$PDO = db_connect();
 
$sql = "SELECT id, nome FROM users WHERE email = :email AND password = :password";
$stmt = $PDO->prepare($sql);
 
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $passwordHash);
 
$stmt->execute();
 
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
if (count($users) <= 0)
{
	require_once './assets/header.php';
    echo "
    	<h1 class='text-center'>Usuário ou senha incorretos.
    	<br>
    	<a href='javascript:history.back()''>Voltar</a> </h1>
	";
	require_once './assets/footer.php';
    exit;
}
 
// pega o primeiro usuário
$user = $users[0];
 
session_start();
$_SESSION['logged_in'] = true;
$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['nome'];
 
header('Location: index.php');

?>