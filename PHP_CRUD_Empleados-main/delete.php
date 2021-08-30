<?php
    include("datos_conexion.php");
    $db_conexion= mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);

    if(isset($_GET['id'])){
        $id= $_GET['id'];
        $sql="DELETE FROM Empleados where id_empleado = $id";

        if($db_conexion->query($sql)==true){
            $db_conexion->close();
            echo"Exito";
            header("location:index.php");
        }else{
            echo"Error al eliminar" . $sql. "<br>". $db_conexion->close();
        }   
    }
?>