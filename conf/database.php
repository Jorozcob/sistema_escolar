<?php
$server = '127.0.0.1';
$dbnombre = 'sistema_escolar';
$user= 'root';
$password = '';
try{
  $pdo = new PDO("mysql:host=$server; dbname=$dbnombre",$user,$password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Successful";
}catch(PDOException $ex){
  echo "Conexion could not be made: ". $ex->getMessage();
}
?>