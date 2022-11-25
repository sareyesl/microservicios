<?php 
    //  (COMPARAR MYSQL)
    header("Access-Control-Allow-Origin: *");
    // $dbname = "pruebasu_pwa";
    // $dns = "mysql:host=localhost;dbname=$dbname";
    // $user = "pruebasu_pwa1";
    // $pass = "Admin22699";
    // try{
    //     $db = new PDO($dns,$user,$pass);
    // }catch(PDOException $e){
    //     echo $e->getMessage();
    // }
    
    $servername = "localhost";
    $user = "pruebasu_pwa1";
    $pass = "Admin22699";
    $dbname = "pruebasu_pwa";

    // $conn = mysqli_connect($servername,$user,$pass,$dbname);
    
    // if($conn){
    //     echo "Connexion establecida";
    // }
    // else{
    //     echo "error";
    // }

    try
    {
        $conexion = new PDO("mysql:host=localhost;dbname=pruebasu_pwa",$user,$pass);
        if ($conexion) {
            echo "conectooooo";
        }
    }catch(Exception $ex){
        echo $ex->getMessage();
    }
    
?>


