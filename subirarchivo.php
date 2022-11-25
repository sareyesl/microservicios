<?php 
//(SUBIR IMAGEN EN ARCHIVO)
header("Access-Control-Allow-Origin: *");
require_once __DIR__ . '/vendor/autoload.php';
// Crear Cliente---------------------------------------------------------------------

$client = new MongoDB\Client('mongodb+srv://miguel:22699@cluster0.amgor.mongodb.net/?retryWrites=true&w=majority');

// Traer Base de datos---------------------------------------------------------------

$database = $client->MultimediaS;

// Crear o Traer coleccion-----------------------------------------------------------

$collection = $database->usuario;

//Variables que necesito ------------------------------------------------------------

$Usuario = $_POST['Usuario'];
$Imagen = $_POST['Imagen'];

// Actualizar un dato ---------------------------------------------------------------

$usuarioid = new MongoDB\BSON\ObjectId($Usuario);

$filtro = ['_id' => $usuarioid];

$CORREO = $collection->findOne($filtro);

if($CORREO != null){

    $datosCorreo = $CORREO->jsonSerialize();

    $update = ['$set' => ['archivo' => $Imagen]];
    $Actualizar = $collection->updateOne($filtro,$update);
    $var = json_encode($datosCorreo);
    die($var);
    
}
else 
{
    $var = json_encode(null);
    die($var);
}


?>



