<?php
include "../../conexion.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Minera 3H</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="../../dist/css/estilos.css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed" data-panel-auto-height-mode="height">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small" id=login name=login>
              <?php echo $_SESSION['uname']; ?>
            </span>
          </a>
          <!-- modal salir -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Salir
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">

        <img src="../../dist/img/logo3H.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">

        <span class="brand-text font-weight-light">SGP3H</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-header">TALLER</li>
            <li class="nav-item">
              <a href="mina_taller.php" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  Control de Equipos
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Contenido tablas-->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Control de Equipos</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- contenido form -->

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <!--subtitulo de pagina-->
                  </h3>
                  <br>
                </div>
                <div class="card-body">
                  <form>
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="state_id" class="control-label">Fecha</label>
                          <input type="date" class="form-control" id="fecha_taller" name="fecha_taller">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Ubicaci??n</label>
                          <select class="form-control" id="id_ubicacion" name="id_ubicacion">
                            <option value=""></option>
                            <?php
                            $query = $con->query("SELECT * FROM ubicaciones_minas");
                            while ($valores = mysqli_fetch_array($query)) {
                              echo '<option value="' . $valores[id_ubicacion] . '">' . $valores[nombre] . '</option>';
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Tipo de Equipo</label>
                          <select class="form-control" id="tequipo" name="tequipo">
                            <option value=""></option>
                            <?php
                            $query = $con->query("SELECT * FROM tipos_equipos");
                            while ($valores = mysqli_fetch_array($query)) {
                              echo '<option value="' . $valores[id_tequipo] . '">' . $valores[nombre] . '</option>';
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <div id="select2lista">
                          </div>
                        </div>
                      </div>
                      <!---->
                    </div>
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="state_id" class="control-label">Acci??n</label>
                          <select class="form-control" id="id_est_equipo" name="id_est_equipo">
                            <option value=""></option>
                            <?php
                            $query = $con->query("SELECT id_est_equipo, nombre FROM estado_equipos WHERE id_est_equipo in (6,7,8);");
                            while ($valores = mysqli_fetch_array($query)) {
                              echo '<option value="' . $valores[id_est_equipo] . '">' . $valores[nombre] . '</option>';
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="state_id" class="control-label">Hora</label>
                          <input type="time" class="form-control" id="hora_inicio" name="hora_inicio">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12" style="text-align:center">
                        <br>
                        <input type="button" class="btn-lg naranjo" value="Aceptar" name="colacion_equipos" id="colacion_equipos">
                        <input type="hidden" value="<?php echo $_SESSION['uname']; ?>" name="usuario" id="usuario">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <!--Footer sin nada-->
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Seguro quieres Salir?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">??</span>
          </button>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <a class="btn btn-primary naranjo" href="../logout.php">Salir</a>
        </div>
      </div>
    </div>
  </div>


  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../../plugins/jszip/jszip.min.js"></script>
  <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>
  <!-- Page specific script -->
  <script src="../funcionesjs/funciones_taller.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

</body>

</html>