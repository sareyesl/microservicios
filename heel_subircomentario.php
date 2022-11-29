<?php 
//(SUBIR IMAGEN EN ARCHIVO)
header("Access-Control-Allow-Origin: *");
require_once __DIR__ . '/vendor/autoload.php';
// Crear Cliente---------------------------------------------------------------------
// Cambiar link de la base de datos --------------------

$client = new MongoDB\Client('mongodb+srv://kat:1234@cluster0.sacgk.mongodb.net/?retryWrites=true&w=majority');

// Traer Base de datos---------------------------------------------------------------
/// Cambiar nombre de la base de datos ------------------------------

$database = $client->MultimediaS;

// Crear o Traer coleccion-----------------------------------------------------------

$collection = $database->usuario;

//Variables que necesito ------------------------------------------------------------

$Usuario = $_POST['Usuario'];

$Comentario = $_POST['Comentario'];

// Actualizar un dato ---------------------------------------------------------------

$usuarioid = new MongoDB\BSON\ObjectId($Usuario);

$filtro = ['_id' => $usuarioid];

$CORREO = $collection->findOne($filtro);

if($CORREO != null){

    $datosCorreo = $CORREO->jsonSerialize();
    $update = ['$set' => ['comentario' => $Comentario]];
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



