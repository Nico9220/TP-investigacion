<?php
include_once  '../../../includes/configuracion.php';
include_once(STRUCTURE_PATH . "head.php");
include_once '../../../vendor/avadim/fast-excel-reader/src/autoload.php';

//Obtengo los datos del formulario que encapsulé
$archivoCargado = data_submitted();

//Creo instancia del objeto y proceso los datos
$objExcel = new SubirExcel();
$resultado = $objExcel->subir($archivoCargado);

$file = ROOT_PATH . '/uploads/'.$archivoCargado['archivo']['name'];
$excel = \avadim\FastExcelReader\Excel::open($file);
$excel->setDateFormat('d-m-Y');
$result = $excel->readRows(true);
$sheet = $excel->sheet();
$firstRow = $sheet->readFirstRow();

foreach ($result as $index => $row) {
  if ($index == 0) {
      // Saltar la primera fila, que contiene los nombres de las columnas
      continue;
  }
  // Extraer los valores según las columnas correspondientes
  $dni = $row['DNI']; // Ajusta según el nombre exacto de la columna en tu Excel
  $nombre  = $row['NOMBRE']; // Ajusta según el nombre exacto de la columna
  $fechaNac = $row['FECHA DE NACIMIENTO']; // Ajusta según el nombre exacto de la columna
  if (!empty($dni) && !empty($nombre) && !empty($fechaNac)) {
    $param=["PerNombre"=>$nombre,"PerDNI"=>$dni,"PerFechaNac"=>date("Y-m-d", strtotime($fechaNac))];
    $persona = new ABMPersona;
    $persona->alta($param);
  }
  $personas = Persona::listar("");
}
?>

<main class="index p-5 text-center bg-light">
      <!-- Contenido de la página -->
       <!-- Contenido de la página -->

       <div class="card shadow">
        <a type="button" class="btn-close position-absolute top-0 end-0" href='../../fast-excel-reader/#ejemplos'></a>
        <div class="card-header">
          <div class="card-title">
            <h2 class="fst-italic">¡Se realizo la carga!</h2>
          </div>
          <div class="card-subtitle">
            <p>A continuación se muestran todas las cargas.
            </p>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-striped table-hover">
          <thead>
              <tr>
                <th scope="col">DNI</th>
                <th scope="col">Nombre</th>
                <th scope="col">Fecha de Nacimiento</th>
              </tr>
          </thead>
          <?php 
                        foreach ($personas as $per):
                            $nroDni = $per->getPerDNI();
                            $nombre = $per->getPerNombre();
                            $fechaNac = $per->getPerFechaNac();
                        ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $nroDni ?></td>
                                    <td><?php echo $nombre ?></td>
                                    <td><?php echo $fechaNac ?></td>
                                </tr>
                            </tbody>
                        <?php endforeach; ?>
        </table>
      </div>
</main>

<?php include(STRUCTURE_PATH . "footer.php"); ?>