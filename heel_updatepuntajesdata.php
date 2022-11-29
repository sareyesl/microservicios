<?php 
//(ACTUALIZAR PUNJATES)

header("Access-Control-Allow-Origin: *");
require_once __DIR__ . '/vendor/autoload.php';

// Crear Cliente---------------------------------------------------------------------

$client = new MongoDB\Client('mongodb+srv://kat:1234@cluster0.sacgk.mongodb.net/?retryWrites=true&w=majority');

// Traer Base de datos---------------------------------------------------------------

$database = $client->MultimediaS;

// Crear o Traer coleccion-----------------------------------------------------------

$collection = $database->puntaje;

//Variables que necesito ------------------------------------------------------------

$usuarioid = $_POST['userid'];
$trainingid = $_POST['trainingid'];
$puntaje = $_POST['puntaje'];
$index = $_POST['index'];

// Actualizar un dato ---------------------------------------------------------------

$filtro = ['userID' => new MongoDB\BSON\ObjectId($usuarioid)];
$filtro2 = ['entrenamientoID' => new MongoDB\BSON\ObjectId($trainingid)];
$Busqueda = $collection->findOne(array(
    '$and' => array($filtro,$filtro2))
);
if($puntaje != null){

    if($Busqueda != null)
    {
        $datosMundo = $Busqueda->jsonSerialize();  
        $var = json_encode($datosMundo); 
        //print($var);     
             
       // $update2 = ['$set' => array( 'contenido.'.$index.'.terminado' => 1 )];
       //$update = ['$set' => ['puntaje' => intval($puntaje)]];

   $Actualizar = $collection->updateOne($datosMundo,
                array('$set' => array(
                    'contenido.'.$index.'.terminado' => 1,
                    'puntaje' => intval($puntaje))),array('multi' => true));
    }
    else{
        $var = json_encode(null);
        die($var);
    }
}else{
    $var = json_encode(null);
    die($var);
}




?>



