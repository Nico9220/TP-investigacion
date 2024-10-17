    <?php
    include_once  '../../../includes/configuracion.php';
    include_once(STRUCTURE_PATH . "head.php");
    include_once '../../../vendor/avadim/fast-excel-reader/src/autoload.php';
    $file = ROOT_PATH . '/uploads/img.xlsx';
    $excel = \avadim\FastExcelReader\Excel::open($file);
    $sheet = $excel->sheet();

    $imageList = $sheet->getImageList();

    ?>
    <main class="index p-5 text-center bg-light">
      <!-- Contenido de la página -->

      <div class="card shadow">
        <a type="button" class="btn-close position-absolute top-0 end-0" href='../../fast-excel-reader/#ejemplos'></a>
        <div class="card-header">
          <div class="card-title">
            <h2 class="fst-italic">Ejemplo de lectura de una planilla que contiene imágenes</h2>
          </div>
          <div class="card-subtitle">
            <p>En este ejemplo, se muestra el contenido de una planilla excel que contiene tres imágenes.
              <br> Se muestra cada imagen junto con sus datos.
            </p>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-striped table-hover">
            <tbody class="border">
              <?php
              if (!empty($imageList)) {
                echo '<div class="image-container">';

                foreach ($imageList as $cellAddress => $imageInfo) {
                  // Obtiene la información de la imagen
                  $imageMimeType = $sheet->getImageMimeType($cellAddress);
                  $imageName = $sheet->getImageName($cellAddress);
                  $imageBlob = $sheet->getImageBlob($cellAddress);

                  // Se puede mostrar la imagen o guardarla en el servidor
                  // Por ahora, vamos a mostrarla
                  echo '<div>';
                  echo '<p>MIME Type: ' . $imageMimeType . '</p>';
                  echo '<p>Nombre Interno: ' . $imageName . '</p>';
                  echo '<img src="data:' . $imageMimeType . ';base64,' . base64_encode($imageBlob) . '" />';
                  echo '</div>';
                }

                echo '</div>';
              } else {
                echo 'No se encontraron imágenes en el archivo Excel.';
              }
              ?>
            </tbody>
        </div>
        </table>
      </div>
    </main>

    <?php include(STRUCTURE_PATH . "footer.php"); ?>