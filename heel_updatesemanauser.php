<?php 
//(ACTUALIZAR PUNJATES SEMANA)

header("Access-Control-Allow-Origin: *");
require_once __DIR__ . '/vendor/autoload.php';

// Crear Cliente---------------------------------------------------------------------

$client = new MongoDB\Client('mongodb+srv://kat:1234@cluster0.sacgk.mongodb.net/?retryWrites=true&w=majority');

// Traer Base de datos---------------------------------------------------------------

$database = $client->MultimediaS;

// Crear o Traer coleccion-----------------------------------------------------------

$collection = $database->usuario;

//Variables que necesito ------------------------------------------------------------

$usuarioid = $_POST['userid'];
$puntajeSemana = $_POST['puntajesemana'];


// Actualizar un dato ---------------------------------------------------------------

$filtro = ['_id' => new MongoDB\BSON\ObjectId($usuarioid)];
$Busqueda = $collection->findOne($filtro);


if($Busqueda != null)
{
    print_r("entra");

    $datosUsuario = $Busqueda->jsonSerialize(); 

    $var = json_encode($datosUsuario);

    echo($var);

    // Actualizar un dato ---------------------------------------------------------------
        
    /// Buscar datos puntajesemana y establecer parametros  -----------------------------
    
    $array = array_map('intval', explode(',', $puntajeSemana));

    var_dump($array);

    $update = ['$set' => ['semana' => $array]];

    $Actualizar = $collection->updateOne($filtro,$update);
}
else{
    $var = json_encode(null);
    die($var);
}





?>



