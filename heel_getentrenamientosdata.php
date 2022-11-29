<?php 
//(OBTENER ENTRENAMIENTOS)
header("Access-Control-Allow-Origin: *");
require_once __DIR__ . '/vendor/autoload.php';
// Crear Cliente---------------------------------------------------------------------
$client = new MongoDB\Client('mongodb+srv://kat:1234@cluster0.sacgk.mongodb.net/?retryWrites=true&w=majority');

// Traer Base de datos---------------------------------------------------------------
$database = $client->MultimediaS;
// Crear o Traer coleccion-----------------------------------------------------------
$collection = $database->entrenamiento;

$Datos = $collection->find();


if($Datos != null){

    $arreglo = array();

   foreach($Datos as $doc) 
   {

        $datosMundo = $doc->jsonSerialize();
        array_push($arreglo, $datosMundo);       
        
   }
    $var = json_encode($arreglo);
    echo($var);

}
else 
{
    $var = json_encode(null);
    die($var);
}



?>



