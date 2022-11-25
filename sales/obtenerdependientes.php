<?php 
//(OBTENER DEPENDIENTES)

header("Access-Control-Allow-Origin: *");
require_once __DIR__ . '/vendor/autoload.php';

// Crear Cliente---------------------------------------------------------------------

$client = new MongoDB\Client('mongodb+srv://miguel:22699@cluster0.amgor.mongodb.net/?retryWrites=true&w=majority');

// Traer Base de datos---------------------------------------------------------------

$database = $client->MultimediaS;

// Crear o Traer coleccion-----------------------------------------------------------

$collection = $database->usuario;

$filtro = ['rol' => 1];

$projection = ['projection'=>["imgUser" => 0]];

$Datos = $collection->find($filtro,$projection);

if($Datos != null)
{
    $arreglo = array();

    foreach ($Datos as $doc) 
    {
        $datosDependiente = $doc->jsonSerialize();
        array_push($arreglo, $datosDependiente);
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



