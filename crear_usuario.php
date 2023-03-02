<?php include "includes/header.php";

if (isset($_POST["crearUsuario"]))
{
  $email = $_POST["email"];
  $nombre = $_POST["nombre"];
  $telefono = $_POST["telefono"];
  $password = md5($_POST["password"]);
  $rol = $_POST["rol"];

  if (empty($email) || empty($nombre) || empty($telefono) || empty($password))
  {
    $error = "Error, algunos campos obligatorios estan vacios";
  }
  else
  {
    $query = "INSERT INTO usuario(email, nombre, telefono, password, es_admin) VALUES(:email, :nombre, :telefono, :password, :es_admin)";

    $conn = conectar();
    $stmt = $conn->prepare($query);

    $stmt->bindparam(":email", $email, PDO::PARAM_STR);
    $stmt->bindparam(":nombre", $nombre, PDO::PARAM_STR);
    $stmt->bindparam(":telefono", $telefono, PDO::PARAM_STR);
    $stmt->bindparam(":password", $password, PDO::PARAM_STR);
    $stmt->bindparam(":es_admin", $rol, PDO::PARAM_STR);

    $resultado = $stmt->execute();
    if($resultado)
    {
      $mensaje = "registro de usuario creado correctamente";
    }
    else
    {
      $error = "Error, no se pudo crear el usuario";
    }
  }
}
?>


<div class="row">
    <div class="col-sm-12"> 
      <?php if (isset($mensaje)) : ?>
        <div class="alert bg-success text-white alert-dismissible fade show" role="alert">
            <strong><?php echo($mensaje);?></strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
      <?php endif;?>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
      <?php if (isset($error)) : ?>
        <div class="alert bg-danger text-white alert-dismissible fade show" role="alert">
            <strong><?php echo($error);?></strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
      <?php endif;?>
    </div>
</div>



              <div class="card-header">               
                <div class="row">
                  <div class="col-md-9">
                    <h3 class="card-title">Crear un nuevo usuario</h3>
                  </div>                 
              </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                  <form role="form" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">            

                      <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control">
                      </div>

                      <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" class="form-control">
                      </div>

                       <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="text" name="telefono" class="form-control">
                      </div>    

                       <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" name="password" class="form-control">
                      </div>   

                      <div class="mb-3">
                       <label for="rol" class="form-label">Rol:</label>
                        <select class="form-control" name="rol" aria-label="Default select example">                       
                        <option value="">Selecciona una opción</option>
                        <option value="0">Registrado</option>
                        <option value="1">Administrador</option>
                        </select>  
                    </div>   

                            <button type="submit" name="crearUsuario" class="btn btn-primary"><i class="fas fa-cog"></i> Crear Usuario</button>  

                        </div>
                      </form>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->


<?php include "includes/footer.php" ?>

<!-- page script -->
<script>
  $(function () {   
    $('#tblRegistros').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    }); 
  });
</script>
