<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['direccion'])) {
        $alert = '<div class="alert alert-danger" role="alert">
                                    Todo los campos son obligatorio
                                </div>';
    } else {
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $usuario_id = $_SESSION['idUser'];

        $result = 0;
        if (is_numeric($dni) and $dni != 0) {
            $query = mysqli_query($conexion, "SELECT * FROM cliente where dni = '$dni'");
            $result = mysqli_fetch_array($query);
        }
        if ($result > 0) {
            $alert = '<div class="alert alert-danger" role="alert">
                                    El dni ya existe
                                </div>';
        } else {
            $query_insert = mysqli_query($conexion, "INSERT INTO cliente(dni,nombre,telefono,direccion, usuario_id) values ('$dni', '$nombre', '$telefono', '$direccion', '$usuario_id')");
            if ($query_insert) {
                $alert = '<div class="alert alert-primary" role="alert">
                                    Cliente Registrado
                                </div>';
            } else {
                $alert = '<div class="alert alert-danger" role="alert">
                                    Error al Guardar
                            </div>';
            }
        }
    }
    mysqli_close($conexion);
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Agregar Cliente</h1>
        <a href="lista_cliente.php" class="btn btn-primary">Regresar</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 m-auto">
            <form action="" method="post" autocomplete="off">
                <?php echo isset($alert) ? $alert : ''; ?>
                <div class="form-group">
    <label for="dni">DNI</label>
    <input type="text" placeholder="Ingrese DNI (9 dígitos)" name="dni" id="dni" class="form-control" maxlength="9">
</div>
<div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" placeholder="Ingrese Nombre" name="nombre" id="nombre" class="form-control">
</div>
<div class="form-group">
    <label for="telefono">Teléfono</label>
    <input type="text" placeholder="Ingrese Teléfono (9 dígitos)" name="telefono" id="telefono" class="form-control" maxlength="9">
</div>
<div class="form-group">
    <label for="direccion">Dirección</label>
    <input type="text" placeholder="Ingrese Dirección" name="direccion" id="direccion" class="form-control">
</div>
                <input type="submit" value="Guardar Cliente" class="btn btn-primary">
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dniInput = document.getElementById('dni');
        const telefonoInput = document.getElementById('telefono');

        dniInput.addEventListener('input', function() {
            if (this.value.length > 9) {
                this.value = this.value.slice(0, 9);
            }
        });

        telefonoInput.addEventListener('input', function() {
            if (this.value.length > 9) {
                this.value = this.value.slice(0, 9);
            }
        });

        dniInput.addEventListener('blur', function() {
            if (this.value.length !== 9) {
                alert('El DNI debe contener 9 dígitos');
                this.value = '';
            }
        });

        telefonoInput.addEventListener('blur', function() {
            if (this.value.length !== 9) {
                alert('El teléfono debe contener 9 dígitos');
                this.value = '';
            }
        });
    });
</script>
</div>
<!-- End of Main Content -->
<?php include_once "includes/footer.php"; ?>