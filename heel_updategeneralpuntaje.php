<?php 
//(ACTUALIZAR PUNJATES GENERAL)

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
$puntaje = $_POST['puntaje'];

// Actualizar un dato ---------------------------------------------------------------

$filtro = ['_id' => new MongoDB\BSON\ObjectId($usuarioid)];
$Busqueda = $collection->findOne($filtro);

if($Busqueda != null)
{
        $datosMundo = $Busqueda->jsonSerialize();  
        $var = json_encode($datosMundo); 
        print_r($var);

        /// Buscar datos fechas y establecer parametros  -----------------------------
    
        $obtenerDato = json_decode($var,true);
        $puntajeActual = $obtenerDato['score'];
        var_dump($puntajeActual);

        $finalScore = $puntajeActual + $puntaje;
        print_r($finalScore);

        $update = ['$set' => ['score' => $finalScore]];
        $Actualizar = $collection->updateOne($filtro,$update);

}
else{
    $var = json_encode(null);
    die($var);
}

?>



