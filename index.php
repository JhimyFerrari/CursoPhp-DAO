<?php
//Data Acess Object

//usa as classes para trabalhar com o banco de dados

//é uma abstração do banco de dados, torna mais versatil, mais seguro, mantem o codigo mais organizado

require_once("config.php");

$sql = new Sql();

$texto = $sql->select("SELECT * FROM tb_usuarios");

echo json_encode($texto);

?>