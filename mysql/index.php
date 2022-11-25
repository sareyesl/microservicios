<?php 
    //  (COMPARAR MYSQL)
    header("Access-Control-Allow-Origin: *");
    
    include 'connect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    $consultar=$connect->query("SELECT * FROM usuario WHERE username = '".$username."' and password='".$password."'");
   
    $result=array();

    while($fetchData = $consultar->fetch_assoc()){
        $result[]=$fetchData;
    }
    echo json_encode($result);


    
?>


