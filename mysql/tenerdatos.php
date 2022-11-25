<?php 
    //  (COMPARAR MYSQL)
    header("Access-Control-Allow-Origin: *");
    
    require_once("connect.php");
    $SQLquery = "SELECT * FROM usuario";
    $stm=$db->prepare($SQLquery);
    $stm->execute();
    $registros = $stm->fetchAll(PDO::FETCH_ASSOC);
   
    $result=array();

foreach ($registros as $registro) {
    $result[] = $registro;
}
    echo json_encode($result);


    
?>


