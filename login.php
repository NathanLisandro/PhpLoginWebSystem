<?php
include('conexao.php');
$quantidadeOnlineNaPlataforma = 0;

if(isset($_POST['email']) || isset($_POST['senha'])) {

    if(strlen($_POST['email']) == 0) {
        echo '<span class="erro_login";> ERRO: Preencha seu e-mail </span>';
    } else if(strlen($_POST['senha']) == 0) {
        echo '<span class="erro_login";> ERRO: Preencha sua senha';
    } else {
// Proteção contra sql injection
         $email = $mysqli->real_escape_string($_POST['email']);
         $senha = $mysqli->real_escape_string($_POST['senha']);
     
      // verifica se o email é válido
                $sql_code = "SELECT * FROM usuarios WHERE email = '$email'";
                    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
// se a query deu certo, pega o numero de linhas, se for igual a 1 deu certo. 
        $quantidade = $sql_query->num_rows;
        // transforma o resultado da query em um array associativo
        $usuario = $sql_query->fetch_assoc();
      
    if($quantidade == 0 ){
        echo'<span class="erro_login";>ERRO: Email não cadastrado no banco de dados </span>';
    } else{
                                 // pega o array associativo onde contém 'password' e confirma se a senha passada é verdadeira.
        if($quantidade == 1 && password_verify($senha, $usuario['password'])) {
            
    
           
           
            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: painel.php");
        
        } else {
            echo '<span class="erro_login";>Erro: Falha ao logar! E-mail ou senha incorretos </span>';
        }
    }
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/formulario login.css">
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<div id="container">
    <form action="" method="POST" class="formulario_login">
    <h1 class="titulo_login espacamento_itens">Acesse sua conta</h1>
    <div class= "conteudo_formulario">
    <p class="">
            <label class="formulario_label_email espacamento_itens ">E-mail</label>
            <input type="text" name="email" class="input_email_formulario">
        </p>
        <p>
            <label class="formulario_label_senha espacamento_itens">Senha</label>
            <input type="password" name="senha" class="input_senha_formulario">
        </p>
        <p>Não tem conta ? clique <a href="cadastro.php">aqui</a> e cadastre-se </p>
        <p>
            <button type="submit" class="btn btn-success espacamento_itens button_formulario">Entrar</button>
        </p>
       
    </form>

</div>
</body>
</html>