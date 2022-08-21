<?php
include('conexao.php');


if(isset($_POST['email']) || isset($_POST['senha']) || isset($_POST['nome'])) {


if(strlen($_POST['email']) <= 2){
    echo 'Erro! preencha um email valido!';
} else if (strlen($_POST['senha']) <=4 || strlen($_POST['senha']) >=25){
    $numberOfCaracterPass = strlen($_POST['senha']);
    echo 'Erro: <span style="color:#B8000C;">Verifique a quantidade de caracteres existentes na senha. O sistema detectou que o número de caracteres é igual a ' . $numberOfCaracterPass . ' o número precisa ser entre 4 e 25! </span>';

} else if(isset($_POST['nome']) == 0){
    
    echo('<span style="color:#B8000C;"> Erro: Por favor digite seu nome. </span>');
    
} else {


//v
$email = $_POST['email'];
$sqlConsultaEmail = "SELECT * FROM usuarios WHERE email = '$email'";
    $sql_query = $mysqli->query($sqlConsultaEmail) or die('Falha em consultar email no banco de dados. ERRO: ' . $mysqli->error);
    $quantidade = $sql_query->num_rows;



if($quantidade > 0 ){
    echo(' <span style="color:#B8000C;">Erro: Email já cadastrado no banco </span>');
}else {
 


    $nome = $mysqli->real_escape_string($_POST['nome']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $senha = $mysqli->real_escape_string($_POST['senha']);

   
    $hash = password_hash($senha, PASSWORD_BCRYPT);
   
 
    $sql_code = "INSERT INTO usuarios (email, password, nome) VALUES ('$email', '$hash', '$nome')";
    $sql_query = $mysqli->query($sql_code) or die("Não foi possível realizar o cadastro, ERRO: " . $mysqli->error);
    


    sleep(3);
    echo('<span style="color:#05FA3A";>Cadastrado com sucesso, entre com o email e senha clique <a href="login.php">aqui</a> para logar</span>');
    
  
}
} 


}





?>





<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/formulariocadastro.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
  
 <form action="" method="post" class="formulario_cadastro">
    <h1 class="espacamento_itens titulo_formulario_cadastro">CADASTRO</h1>
<p>
 <label for="" class="nome_label">Nome</label>
<input type="text" name="nome" class="formulario_input_nome">
</p>
<p>
<label for="">Email</label>
<input type="email" name="email" class="formulario_input_email" id="">
</p>
<p>
<label for="">Senha</label>
<input type="password" name="senha" id="" class="formulario_input_senha">

</p>
<p>Já possui cadastro ? clique <a href="">aqui</a> e faça o login</p>
<p class="formulario_botao_cadastrar">
<button type="submit" class="btn btn-info botao_formulario">Cadastrar</button>
</p>


 </form>


</body>
</html>