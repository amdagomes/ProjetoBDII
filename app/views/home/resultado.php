<?php

$servidor ="localhost";
$usuario ="root";
$senha = "";
$db_name ="projetobdii";

$conn= mysqli_connect($servidor,$usuario,$senha);
$banco = mysqli_select_db($conn,$db_name);
mysqli_set_charset($conn,'utf8');

$resultado = mysqli_query($conn,"select * from events where periodo > NOW()") or die("Erro");

$eventos = array();
while($evento = mysqli_fetch_assoc($resultado))
{
  array_push($eventos,$evento);
}


/*$con = new mysqli($servidor,$usuario,$senha, $db_name);
if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());

    //Consultando banco de dados
    $qryLista = mysqli_query($con, "SELECT * FROM events");

    $array_da_consulta = mysqli_fetch_array($qryLista);

    while($resultado = mysqli_fetch_assoc($qryLista)){
        $vetor[] = array_map('utf8_decode', $resultado);
    }

    $json = json_encode($vetor);
    echo $json;
//Passando vetor em forma de json

$fp = fopen("eventos.json", "w");
fwrite($fp, json_encode($vetor));
fclose($fp);
*/
?>
