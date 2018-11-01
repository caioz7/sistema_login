<?php
 
// inclui o arquivo de inicialização
require_once 'conexao.php';
require_once 'funcoes.php';
 
// resgata variáveis do formulário
$email = isset($_POST['email']) && !empty($_POST['email']) ? $_POST['email'] : showError('Informe o email.');;
$password = isset($_POST['password']) && !empty($_POST['password']) ? $_POST['password'] : showError('Informe a senha.');;

// cria o hash da senha
$passwordHash = make_hash($password);
 
$PDO = db_connect();
 
$sql = "SELECT id, nome FROM users WHERE email = :email AND password = :password";
$stmt = $PDO->prepare($sql);
 
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $passwordHash);
 
$stmt->execute();
 
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
if (count($users) <= 0) showError('Usuário ou senha incorretos.');
 
// pega o primeiro usuário
$user = $users[0];
 
session_start();
$_SESSION['logged_in'] = true;
$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['nome'];
 
header('Location: index.php');

?>