<?php 
    //  (COMPARAR)
    header("Access-Control-Allow-Origin: *");
    require_once __DIR__ . '/vendor/autoload.php';
    // Crear Cliente---------------------------------------------------------------------
    $client = new MongoDB\Client('mongodb+srv://miguel:22699@cluster0.amgor.mongodb.net/?retryWrites=true&w=majority');
    // Traer Base de datos-----------------------------------------------------------------
    $database = $client->salesApp;
    // Crear o Traer coleccion-----------------------------------------------------------
    $collection = $database->usuario;
    // Logica de Login -------------------------------------------------------------------------------------

    //Variables que necesito -----------
    $Usuario = $_POST['Correo'];
    $Clave = $_POST['Clave'];
    // $Fecha = $_GET['Fecha'];

    $Puntaje =0;
    //-----------
    $stringCorreo = $Usuario;
    $stringclave = $Clave;
    //----------
    $filtroCorreo =['user' => $stringCorreo];
    $CORREO = $collection->findOne($filtroCorreo);
    if($CORREO != null){
      // print_r($CORREO);
        $datosCorreo = $CORREO->jsonSerialize();
       
        //echo "usuario: " . $CORREO[user] . " clave: " . $CORREO[password].".";

        // despues de jsonSerialize queda asi 
            /*
                {
                    _id : id de mongo ,
                    ID_USER : id del usuario ,
                    ID: id,
                    CORREO :Correo,
                    PASSWORD: Contraseña
                }
            */ 
            // Documento para instertar
            $document=[

                'user' => $stringCorreo,
                'password' => $stringclave,
            ];

            // Comprobar 
            if($datosCorreo->user != null && $datosCorreo->password != null)
            {
                if( $stringCorreo == $datosCorreo->user && $stringclave == $datosCorreo->password )
                {
                    $var = json_encode($datosCorreo);
                    echo($var);

                    // Actualizar un dato ---------------------------------------------------------------
                    

                /// Buscar datos fechas y establecer parametros  -----------------------------
            
                    // $obtenerDato = json_decode($var,true);
                    // $arrayFechas = $obtenerDato['fecha'];

                    // array_shift($arrayFechas);
                    // array_push($arrayFechas,$Fecha);


                    // $update = ['$set' => ['fecha' => $arrayFechas]];

                    // $Actualizar = $collection->updateOne($filtroCorreo,$update);

                    




                // $existe = $collection2->findOne($filtroCorreo);
                    // if(!empty($existe) && $stringclave == $datosCorreo->PASSWORD)
                    // {  
                    //     //-----------
                    //   //  $filtro =['CORREO' => $stringCorreo];
                    //    // $document = $collection2->findOne($filtro);
                    //    // $datosPuntaje = $document->jsonSerialize();
                    //     //echo $datosPuntaje->PUNTAJE;
                    //    // $Puntaje = $datosPuntaje->PUNTAJE;
                    //     //Enviar a unity
                    //     //$enviar->PUNTAJE = $Puntaje;
                    //     //echo json_encode($enviar);
                    // } else 
                    // {
                    //     //$insertOneResult = $collection2->insertOne($document); 
                    //     echo 'Se agrego el campo correctamente';
                    // }                       
                }
                elseif($stringCorreo == $datosCorreo->user && $stringclave != $datosCorreo->password)
                {
                    $var = json_encode(null);
                    die($var);
                }
                elseif($stringCorreo != $datosCorreo->user && $stringclave == $datosCorreo->password)
                {
                    $var = json_encode(null);
                    die($var);
                }else
                {
                    $var = json_encode(null);
                    die($var);
                }
            }else
            {
                $var = json_encode(null);
                die($var);
            }

    }else{

        $var = json_encode(null);
        die($var);
    }

    
?>


