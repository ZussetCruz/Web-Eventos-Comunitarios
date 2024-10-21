<?php
date_default_timezone_set("America/Santo_Domingo");
setlocale(LC_ALL,"es_ES");

include('config.php');
                        
$idEvento         = $_POST['idEvento'];
$start            = $_REQUEST['start'];
$fecha_inicio     = date('Y-m-d', strtotime($start)); 
$end              = $_REQUEST['end']; 
$fecha_fin        = date('Y-m-d', strtotime($end));
$ubicacion        = $_REQUEST['ubicacion'];  


$UpdateProd = ("UPDATE eventoscalendar 
    SET 
        fecha_inicio ='$fecha_inicio',
        fecha_fin ='$fecha_fin',
        ubicacion = '$ubicacion'

    WHERE id='".$idEvento."' ");
$result = mysqli_query($con, $UpdateProd);

?>