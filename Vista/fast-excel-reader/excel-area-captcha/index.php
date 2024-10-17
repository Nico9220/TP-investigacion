    
  <?php
  include_once __DIR__."/../../includes/configuracion.php";
  include_once (STRUCTURE_PATH."head.php");
  include_once  __DIR__.'/../../vendor/avadim/fast-excel-reader/src/autoload.php';
  $file = __DIR__.'/../../uploads/area.xlsx';
  $excel = \avadim\FastExcelReader\Excel::open($file);
  $excel->setDateFormat('d-m-Y');
  
  // $columnStart='F';
  // $columnEnd='K';
  // $rowStart=12;
  // $rowEnd=25;
  if (isset($columnStart)&&isset($columnEnd)&&isset($rowStart)&&isset($rowEnd)){
    $result = $excel->setReadArea(''.$columnStart.$rowStart.':'.$columnEnd.$rowEnd.'')->readRows(true);
  }else{
    $result = $excel->readRows(true);
  }
  $sheet = $excel->sheet();
  $firstRow = $sheet->readFirstRow();
  ?>
  <main class="p-5 text-center bg-light"  >
    <!-- Contenido de la página -->
    <div class="card shadow">
      <div class="card-header align-content-center">
        <div class="card-title">
          <h2 class="fst-italic">Librería útil: FAST EXCEL READER - Ejemplo de lectura de un área.</h2>
          <h4>Fast Excel Reader es una librería que permite la lectura de archivos con extensión xlsx.</h4>
        </div>
        <div class="card-subtitle w-50 align-self-center m-auto">
          <p>El archivo usado en este ejemplo tiene una tabla situada en el <strong>área F12:K25</strong>.
           Si se desea ver un área específica se pueden ingresar los datos de inicio y fin del área. Luego de aprobar el control captcha, pulsar "Enviar" para obtener una visualización del área elgido dentro del archivo Xslx.</p> 
        </div>
      </div>
      <div class="card-body w-75 m-auto">
        <form class="d-flex flex-column needs-validation" method="post" action="verificaCaptcha.php" id="formLogin" name="formLogin">
        <div class="row">
          <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="mb-3">
              <div class="input-group">
                <span class="input-group-text" id="basic-addon1">
                  <i class="bi-table"></i>
                </span>
                <input class="form-control validate" type="text" pattern="[A-Za-z]{0,2}" title="Sólo letras de la A a la Z. Hasta dos caracteres." name="columnStart" id="columnStart" placeholder="Columna Inicial">
                <div class="invalid-feedback">
                  Por favor, ingrese una letra.
                  <br>*Debe ingresar una letra.
                </div>
              </div>
            </div>
            <div class="mb-3">
              <div class="input-group">
                <span class="input-group-text" id="basic-addon1">
                  <i class="bi-table"></i>
                </span>
                <input class="form-control validate" type="number" name="rowStart" id="rowStart" placeholder="Fila Inicial">
                <div class="invalid-feedback">
                  Por favor, ingrese un número válido.
                </div>
              </div>
            </div>
          </div>    
          <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="mb-3 ">
              <div class="input-group">
                <span class="input-group-text" id="basic-addon1">
                  <i class="bi-table"></i>
                </span>
                <input class="form-control validate" type="text"  pattern="[A-Za-z]{0,2}" title="Sólo letras de la A a la Z. Hasta dos caracteres." name="columnEnd" id="columnEnd" placeholder="Columna Final">
                <div class="invalid-feedback">
                  Por favor, ingrese una letra.
                  <br>*Debe ingresar una letra.
                </div>
              </div>
            </div>
            <div class="mb-3">
              <div class="input-group">
                <span class="input-group-text" id="basic-addon1">
                  <i class="bi-table"></i>
                </span>
                <input class="form-control validate" type="number" name="rowEnd" id="rowEnd" placeholder="Fila Final">
                <div class="invalid-feedback">
                  Por favor, ingrese un número.
                </div>
              </div>
            </div>
          </div>
          <div class="col align-self-center">
            <div class="row align-content-start">
              <div class="col mb-3">
                <!-- A continuación colocamos el div en donde será inyectado el input -->
                <div class="g-recaptcha" data-sitekey="6LfvL2AoAAAAAEpNfogbblqxHtecHHlpVHeuhMij" id="captcha-container" data-theme="light"></div>
                <div class="invalid-feedback" id="captcha-error" style="display: none;">
                  Por favor, verifica que no eres un robot.
                </div>
              </div>
              <div class="col align-self-center">
                <input type="submit" class="btn btn-primary" value="Enviar">
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="container m-3">

      <div class="card shadow">
        <div class="card-header">
          <h2>Así se ve el archivo original</h2>
        </div>
        <div class="card-body">
          <img class="my-4 img-fluid img-thumbnail" alt="Muestra del archivo Excel original" src="../../uploads/tabla-area.png"/>
        </div>
      </div>
    </div>
</main>
  <?php include (STRUCTURE_PATH."footer.php"); ?>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>