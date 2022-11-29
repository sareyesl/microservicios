<?php 
//(ESTABLECER PUNTAJES EN 0)

header("Access-Control-Allow-Origin: *");
require_once __DIR__ . '/vendor/autoload.php';

// Crear Cliente---------------------------------------------------------------------

$client = new MongoDB\Client('mongodb+srv://kat:1234@cluster0.sacgk.mongodb.net/?retryWrites=true&w=majority');

// Traer Base de datos---------------------------------------------------------------

$database = $client->MultimediaS;

// Crear o Traer coleccion-----------------------------------------------------------

$collection = $database->entrenamiento;
$collection2 = $database->puntaje;

$datoUsuarioid = $_POST['userid'];

$usuarioid = new MongoDB\BSON\ObjectId($datoUsuarioid);

$Datos = $collection->find();


if ($datoUsuarioid != null) {

        if($Datos != null){

        $arreglo = array();
        $arreglofinal = array();

        $filtro = ['userID' => $usuarioid];

        foreach($Datos as $doc) 
        {
            /// Buscar datos id y establecer parametros id y title -----------------------------

            $datosMundo = $doc->jsonSerialize();
            array_push($arreglo, $datosMundo);  
            $entID =  $doc -> _id;
            $entTitle = $doc -> title;
            $entMeta = $doc -> meta;
            $entImg = $doc -> img;
            $entMundo = $doc -> mundo;
            $entCont = $doc -> contenido;
            $entHabilitado = $doc -> habilitado;

            /// Buscar por medio de entrenamientoID y Userid si existe en la tabla puntaje------------

            $filtro2 = ['entrenamientoID' => $entID];
            $Busqueda = $collection2->findOne(array(
                '$and' => array($filtro2,$filtro))
            );
            var_dump($Busqueda);

            if ($Busqueda == NULL) 
            {
                print("agregó");
                $collection2->insertOne(

                    [
                        'userID' => new MongoDB\BSON\ObjectId($usuarioid),
                        'entrenamientoID' => new MongoDB\BSON\ObjectId($entID),
                        'puntaje' => 0,
                        'entrenamientoTitle' => $entTitle,
                        'meta' => $entMeta,
                        'img' => $entImg,
                        'mundo' => $entMundo,
                        'contenido' => $entCont,
                        'habilitado' => $entHabilitado
                    ]

                );
            }
        }  
    }
}
else 
{
    $var = json_encode(null);
    die($var);
}



?>



