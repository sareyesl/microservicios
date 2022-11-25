<?php 
//(OBTENER PUNTAJES DE TODOS LOS DEPENDIENTES)
header("Access-Control-Allow-Origin: *");
require_once __DIR__ . '/vendor/autoload.php';
// Crear Cliente---------------------------------------------------------------------

$client = new MongoDB\Client('mongodb+srv://miguel:22699@cluster0.amgor.mongodb.net/?retryWrites=true&w=majority');

// Traer Base de datos---------------------------------------------------------------

$database = $client->MultimediaS;

// Crear o Traer coleccion-----------------------------------------------------------

$collection = $database->puntaje;

//Variables que necesito ------------------------------------------------------------

$filtro = [];

$projection = ['projection'=>["img" => 0]];

$Datos = $collection->find($filtro,$projection);

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



