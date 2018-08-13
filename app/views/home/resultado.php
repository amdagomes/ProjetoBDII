<?php

$servidor ="localhost";
$usuario ="root";
$senha = "";
$db_name ="projetobdii";

$conn= mysqli_connect($servidor,$usuario,$senha);
$banco = mysqli_select_db($conn,$db_name);
mysqli_set_charset($conn,'utf8');

if (isset($_POST['filtro'])) {
    $opcao=$_POST['filtro'];

    if($opcao=="Data"){
      if(isset($_POST['filtrar'])) {
        $filtrar=date($_POST['filtrar']);
        $resultado = mysqli_query($conn,"select * from events where dataI >= NOW() && dataI ='$filtrar'") or die("Erro");
      }
   }

     if($opcao=="Tema"){
      if(isset($_POST['filtrar'])) {
          $filtrar=$_POST['filtrar'];
          $resultado = mysqli_query($conn,"select * from events where dataI >= NOW()&& tema ='$filtrar'") or die("Erro");
      }
    }

     if($opcao=="Todos"){
       if(isset($_POST['filtrar'])) {
          $filtrar=$_POST['filtrar'];
          $resultado = mysqli_query($conn,"select * from events where dataI >= NOW()") or die("Erro");

       }
    }

}
else{
    $resultado = mysqli_query($conn,"select * from events where dataI >= NOW()") or die("Erro");
}


$eventos = array();
while($evento = mysqli_fetch_assoc($resultado))
{
  array_push($eventos,$evento);
}

?>
