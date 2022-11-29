<?php 
//(CAMBIAR IMAGEN)
header("Access-Control-Allow-Origin: *");
require_once __DIR__ . '/vendor/autoload.php';
// Crear Cliente---------------------------------------------------------------------

$client = new MongoDB\Client('mongodb+srv://admin:123@cluster0.lvbvi.mongodb.net/?retryWrites=true&w=majority');

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

    $update = ['$set' => ['imgUser' => $Imagen]];
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



