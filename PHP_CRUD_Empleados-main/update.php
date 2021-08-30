<?php
    include("datos_conexion.php");
    $db_conexion= mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM empleados WHERE id_empleado = $id";
        $result= mysqli_query($db_conexion,$sql);
        if(mysqli_num_rows($result)==1){
            $row = mysqli_fetch_array($result);
            $codigo = $row['codigo'];
            $nombres = $row['nombres'];
            $apellidos = $row['apellidos'];
            $direccion = $row['direccion'];
            $telefono = $row['telefono'];
            $puesto= $row['id_puesto'];
            $fn= $row['fecha_nacimiento'];
        }
    }

    if(isset($_POST['btn_update'])){
        $id=$_GET['id'];
        
        $codigo=$_POST['txt_codigo'];
        $nombres=$_POST['txt_nombres'];
        $apellidos=$_POST['txt_apellidos'];
        $direccion=$_POST['txt_direccion'];
        $telefono=$_POST['txt_telefono'];
        $puesto=$_POST['drop_puesto'];
        $fn=$_POST['txt_fn'];

        
        $sql="UPDATE empleados 
        set codigo = '$codigo',nombres='$nombres',apellidos='$apellidos',
        direccion='$direccion',telefono=$telefono,id_puesto=$puesto,fecha_nacimiento='$fn' 
        where id_empleado =$id";
        mysqli_query($db_conexion,$sql);

        if($db_conexion->query($sql)==true){
            $db_conexion->close();
            echo"Exito";
            header("location:index.php");
        }else{
            echo"Error al eliminar" . $sql. "<br>". $db_conexion->close();
        }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Modificar Empleados</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  </head>
  <body>
    <div class="container">
        <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
            <br><h2>FORMULARIO EMPLEADOS</h2>
            <br>
            <br>
        </nav><br>
    </div>
  <div class="container">
          <form class="d-flex" action="update.php?id=<?php echo $_GET['id'];?> " method="POST">
              <div class="col">
                  <div class="mb-3">
                      <label for="lbl_codigo" class="form-label"><b>Código</b></label>
                      <input type="text" name="txt_codigo" id="txt_codigo" class="form-control" value="<?php echo $codigo;?>" placeholder="EOO1" Required>
                  </div>
                  <div class="mb-3">
                      <label for="lbl_nombres" class="form-label"><b>Nombres</b></label>
                      <input type="text" name="txt_nombres" id="txt_nombres" class="form-control" value="<?php echo $nombres;?>" placeholder="Nombres: Nombre1 Nombre2" Required>
                  </div>
                  <div class="mb-3">
                      <label for="lbl_apellidos" class="form-label"><b>Apellidos</b></label>
                      <input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control" value="<?php echo $apellidos;?>" placeholder="Nombres: Apellido1 Apellido2" Required>
                  </div>
                  <div class="mb-3">
                      <label for="lbl_direccion" class="form-label"><b>Dirección</b></label>
                      <input type="text" name="txt_direccion" id="txt_direccion" class="form-control" value="<?php echo $direccion;?>" placeholder="Dirección: Lugar #Casa Zona Avenida" Required>
                  </div>
                  <div class="mb-3">
                      <label for="lbl_telefono" class="form-label"><b>Teléfono</b></label>
                      <input type="number" name="txt_telefono" id="txt_telefono" class="form-control" value="<?php echo $telefono;?>" placeholder="0000 0000" Required>
                  </div>
                  <div class="mb-3">
                    <label for="" class="lbl_puesto"><b>Puesto</b></label>
                    <select class="form-select" name="drop_puesto" id="drop_puesto">
                      <option value=0>---Puesto---</option>
                      
                      <?php
                      include("datos_conexion.php");
                      $db_conexion= mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);
                      $db_conexion ->real_query("select id_puesto as id, puesto from puestos;");
                      $resultado = $db_conexion->use_result();

                      while($fila = $resultado->fetch_assoc()){
                          echo"<option value=" . $fila['id'] . ">" . $fila['puesto'] ."</option>";
                      }
                      
                      $db_conexion ->close();
                      ?>

                    </select>
                  </div>
                  <div class="mb-3">
                      <label for="lbl_fn" class="form-label"><b>Fecha de Nacimiento</b></label>
                      <input type="date" name="txt_fn" id="txt_fn" class="form-control" value="<?php echo $fn;?>" placeholder="aaaa-mmm-ddd" Required>
                  </div>
                  <div class="mb-3">
                      <input type="submit" name="btn_update" id="btn_update" class="btn btn-warning" value="Modificar">
                  </div>
                  
              </div>
          </form>  
                  
        </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>