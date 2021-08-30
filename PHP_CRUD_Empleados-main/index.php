<!doctype html>
<html lang="en">
  <head>
    <title>Página en PHP</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Font Awesome 5-->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    
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
          <form class="d-flex" action="insert.php" method="post">
              <div class="col">
                  <div class="mb-3">
                      <label for="lbl_codigo" class="form-label"><b>Código</b></label>
                      <input type="text" name="txt_codigo" id="txt_codigo" class="form-control" placeholder="EOO1" Required>
                  </div>
                  <div class="mb-3">
                      <label for="lbl_nombres" class="form-label"><b>Nombres</b></label>
                      <input type="text" name="txt_nombres" id="txt_nombres" class="form-control" placeholder="Nombres: Nombre1 Nombre2" Required>
                  </div>
                  <div class="mb-3">
                      <label for="lbl_apellidos" class="form-label"><b>Apellidos</b></label>
                      <input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control" placeholder="Nombres: Apellido1 Apellido2" Required>
                  </div>
                  <div class="mb-3">
                      <label for="lbl_direccion" class="form-label"><b>Dirección</b></label>
                      <input type="text" name="txt_direccion" id="txt_direccion" class="form-control" placeholder="Dirección: Lugar #Casa Zona Avenida" Required>
                  </div>
                  <div class="mb-3">
                      <label for="lbl_telefono" class="form-label"><b>Teléfono</b></label>
                      <input type="number" name="txt_telefono" id="txt_telefono" class="form-control" placeholder="0000 0000" Required>
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
                      <input type="date" name="txt_fn" id="txt_fn" class="form-control" placeholder="aaaa-mmm-ddd" Required>
                  </div>
                  <div class="mb-3">
                      <input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value="Agregar" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modelId">
                  </div>
                  <!-- Button trigger modal -->
                  
                  
                  <!-- Modal -->
                  <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                                  <div class="modal-header">
                                          <h5 class="modal-title">Agregar Empleado</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                              <div class="modal-body">
                                  <div class="container-fluid">
                                      Empleado agregado con éxito...
                                  </div>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  
                              </div>
                          </div>
                      </div>
                  </div>
                  
                  
              </div>
          </form>  
                  
        </div>
        <div class="container">
        <table class="table table-striped table-inverse table-responsive">
              <thead class="thead-inverse">
                  <tr>
                      <th>Código</th>
                      <th>Nombres</th>
                      <th>Apellidos</th>
                      <th>Dirección </th>
                      <th>Teléfono</th>
                      <th>Puesto</th>
                      <th>Nacimiento</th>
                      <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                      <?php
                      include("datos_conexion.php");
                      $db_conexion= mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);
                      $db_conexion ->real_query("select e.id_empleado as id,e.codigo,e.nombres,e.apellidos,e.direccion,e.telefono,p.puesto,e.fecha_nacimiento from empleados as e inner join puestos as p on e.id_puesto = p.id_puesto;");
                      $resultado = $db_conexion->use_result();

                      while($fila = $resultado->fetch_assoc()){
                          echo"<tr data-id=". $fila['id'].">";
                          echo"<td>". $fila['codigo'] . "</td>";
                          echo"<td>". $fila['nombres'] . "</td>";
                          echo"<td>". $fila['apellidos'] . "</td>";
                          echo"<td>". $fila['direccion'] . "</td>";
                          echo"<td>". $fila['telefono'] . "</td>";
                          echo"<td>". $fila['puesto'] . "</td>";
                          echo"<td>". $fila['fecha_nacimiento'] . "</td>";
                          
                          
                          ?>
                          
                          <td>
                            <a href="update.php?id=<?php echo $fila['id']?>" class="btn btn-secondary">
                                <i class="fas fa-marker"></i> 
                            </a>
                            <a href="delete.php?id=<?php echo $fila['id']?>" class="btn btn-danger">
                                <i class="far fa-trash-alt"></i> 
                            </a>
                          </td>
                           
                          <?php
                          echo"<tr>";
                      }
                      
                      $db_conexion ->close();
                      ?>
                  </tbody>
          </table>
        </div>
        
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>