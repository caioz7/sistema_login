<?php
session_start();
 
require_once 'conexao.php';
require_once 'verifica_sessao.php';
require_once './assets/header.php';
require_once './assets/menu.php';

error_reporting(0);


// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // ?? == isset e empty
    $id = $_POST["id"] ?? "";
    $nome = $_POST["nome"] ?? "";
    $email = $_POST["email"] ?? "";
    $celular = $_POST["celular"] ?? "";
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = $_GET["id"] ?? "";
}

// busca a instancia do banco de dados
$conexao = db_connect();

// Bloco If que Salva os dados no Banco - atua como Create e Update
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nome != "") {
    try {
        if ($id != "") {
            $stmt = $conexao->prepare("UPDATE contatos SET nome=?, email=?, celular=? WHERE id = ?");
            $stmt->bindParam(4, $id);
        } else {
            $stmt = $conexao->prepare("INSERT INTO contatos (nome, email, celular) VALUES (?, ?, ?)");
        }
        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $celular);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "Dados cadastrados com sucesso!";
                $id = null;
                $nome = null;
                $email = null;
                $celular = null;
            } else {
                echo "Erro ao tentar efetivar cadastro";
            }
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}

// Bloco if que recupera as informações no formulário, etapa utilizada pelo Update
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM contatos WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            $id = $rs->id;
            $nome = $rs->nome;
            $email = $rs->email;
            $celular = $rs->celular;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}

// Bloco if utilizado pela etapa Delete
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM contatos WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo "Registo foi excluído com êxito";
            $id = null;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}
?>
  <form action="?act=save" method="POST" name="form1" >
      <h1>Agenda de contatos</h1>
      <hr>
      <input type="hidden" name="id" value='<?php echo $id ?? ''; ?>' />
      Nome:
      <input type="text" name="nome" value='<?php echo $nome ?? ''; ?>' />
      E-mail:
      <input type="text" name="email" value='<?php echo $email ?? ''; ?>' />/>
      Celular:
      <input type="text" name="celular" value='<?php echo $celular ?? ''; ?>' />
      <input type="submit" value="salvar" />
      <input type="reset" value="Novo" />
      <hr>
  </form>
        <table border="1" width="100%">
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Celular</th>
                <th>Ações</th>
            </tr>
            <?php

            // Bloco que realiza o papel do Read - recupera os dados e apresenta na tela
            try {
                $stmt = $conexao->prepare("SELECT * FROM contatos");
                if ($stmt->execute()) {
                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                        echo "<tr>";
                        echo "<td>".$rs->nome."</td><td>".$rs->email."</td><td>".$rs->celular
                                   ."</td><td><center><a href=\"?act=upd&id=".$rs->id."\">[Alterar]</a>"
                                   ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                                   ."<a href=\"?act=del&id=".$rs->id."\">[Excluir]</a></center></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "Erro: Não foi possível recuperar os dados do banco de dados";
                }
            } catch (PDOException $erro) {
                echo "Erro: ".$erro->getMessage();
            }
            ?>
        </table>
<?php require_once './assets/footer.php'; ?>
