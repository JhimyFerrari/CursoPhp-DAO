<?php
//Data Acess Object

//usa as classes para trabalhar com o banco de dados

//é uma abstração do banco de dados, torna mais versatil, mais seguro, mantem o codigo mais organizado

require_once("config.php");

//$sql = new Sql();
//$texto = $sql->select("SELECT * FROM tb_usuarios");
//echo json_encode($texto);


//$root = new Usuario();
//$root->loadById(3);



//$lista=Usuario::getList();
//echo json_encode($lista);


//Carrega um lista de usuarios buscando pelo login
#$search = Usuario::search("J");

#echo json_encode($search);



//carrega um usuario usando o login e a senha

//$usuario = new Usuario();

//$usuario->login("User", "12345");
//echo $usuario



$aluno = new Usuario("aluno","1a2b");

$aluno->insert();

echo $aluno;

?>