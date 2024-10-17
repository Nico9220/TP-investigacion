<?php
include_once __DIR__ . '/../../includes/configuracion.php';
include_once(STRUCTURE_PATH . 'head.php');
?>
<main class="index p-5 text-center bg-light">
  <h1 class="mb-3">Librería Fast Excel Reader</h1>

  <div class="card shadow w-75 m-auto mb-3">
    <div class="card-header">
      <div class="row gx-3 gy-3 ">
        <h2> ¿Qué es Fast Excel Reader? </h2>
      </div>
    </div>
    <div class="card-body text-start">
      <p>Esta librería puede leer hojas de cálculo compatibles con Excel en formato XLSX. Solo puede leer datos, pero lo hace de manera muy rápida y con muy poco uso de memoría.</p>
      <p><strong>Características:</strong></p>
      <ul class="align-content-start">
        <li class="align-self-start">Admite la autodetección de tipos de monedas / numéricos / tipos de fechas</li>
        <li>Brinda un autoformato o uno personalizado para los tipos de fechas.</li>
        <li>La librería puede definir y extraer imágenes de archivos XLSX</li>
        <li>La librería puede leer diferentes estilos de celdas (formato de patrones, colores, bordes, fuentes, etc).</li>
      </ul>

    </div>
  </div>

  <div class="card shadow w-75 m-auto mb-3">
    <div class="card-header">
      <div class="row gx-3 gy-3 ">
        <h2> Implementación </h2>
      </div>
    </div>
    <div class="card-body text-start">
      <p><strong>Tiene dos formas de instalarse: </strong></p>
      <ul>
        <li>
          <p><strong>Utilizando Composer.</strong></p>
          <p>Composer es una herramienta para la gestión de dependencias en PHP. Le permite declarar las bibliotecas de las que depende su proyecto y las administrará (instalará/actualizará) automáticamente.
            <br>Para descargarla pueden ir al siguiente link y descargar el instalador que se encargará del resto: <a href="https://getcomposer.org/download/" target="_blank">https://getcomposer.org/download/</a>
            <br>Una vez instalado, en la carpeta de su proyecto, ejecutar el siguiente comando: <code>composer require avadim/fast-excel-reader</code>
          </p>
        </li>
        <li>
          <p><strong>
              Descargando el paquete.
            </strong></p>
          <p>Para descargar el paquete, pueden ir al siguiente link: <a href="https://getcomposer.org/download/" target="_blank">https://getcomposer.org/download/</a>
            <br>Una vez descargado, descomprimirlo en la carpeta de su proyecto y agregar la siguiente línea:
            <br><code>require_once __DIR__ . '/avadim/fast-excel-reader/src/FastExcelReader.php';</code>
          </p>
          <p><strong>Ejemplos de implementación:</strong></p>
          <ul>
            <li>
              <p><strong>Cabecera:</strong></p>
              <code>
                <pre>
&lt;?php
  include_once __DIR__."/../../includes/configuracion.php";
  include_once (STRUCTURE_PATH."head.php");
  include_once  __DIR__.'/../../vendor/avadim/fast-excel-reader/src/autoload.php';
  $file = __DIR__.'/../../uploads/planilla.xlsx';
  $excel = \avadim\FastExcelReader\Excel::open($file);
  $excel->setDateFormat('d-m-Y');
  $result = $excel->readRows(true);
  $sheet = $excel->sheet();
  $firstRow = $sheet->readFirstRow();
?&gt;
            </pre>
              </code>
            </li>
            <li>
              <p><strong>Recorriendo el excel:</strong></p>
              <code>
                <pre>
&lt;table class="table table-bordered table-striped table-hover"&gt;
  &lt;thead class="border"&gt;
    &lt;tr&gt;
      &lt;?php
          echo '&lt;th class="border-2 border-top-0 border-start-0 table-light" scope="col"&gt;&lt;/th&gt;';
          foreach ($firstRow as $key => $value) {
            echo '&lt;th class="border-2 border-top-0 table-light" scope="col"&gt;'.$key.'&lt;/th&gt;';
          }
      ?&gt;        
    &lt;/tr&gt;
    &lt;tr&gt;
      &lt;?php
        echo '&lt;td class="border-2 border-start-0 table-light fw-bold" scope="col"&gt;'.($sheet->firstRow()-1).'&lt;/td&gt;';
        foreach ($firstRow as $key => $value) {
          echo '&lt;th scope="col"&gt;'.$value.'&lt;/th&gt;';
        }
      ?&gt;
    &lt;/tr&gt;
  &lt;/thead&gt;
  &lt;tbody class="border"&gt;
    &lt;?php
      foreach ($result as $cellKey => $cellValue) {    
        echo '&lt;tr&gt;';
        echo '&lt;td class="border-2 border-start-0 table-light fw-bold"&gt;'.$cellKey.'&lt;/td&gt;';
        foreach ($firstRow as $rowKey => $rowValue) {
          echo isset($cellValue[$rowValue])? '&lt;td&gt;'.$cellValue[$rowValue].'&lt;/td&gt;':'&lt;td&gt;&lt;/td&gt;';
        }
        echo '&lt;/tr&gt;';
      }
    ?&gt;
  &lt;/tbody&gt;
&lt;/table&gt;
              </pre>
              </code>
            </li>
          </ul>
        </li>
      </ul>

    </div>
  </div>
  <div class="card shadow w-75 m-auto mb-3">
    <div class="card-header">
      <div class="row gx-3 gy-3 ">
        <h2 id="ejemplos">Ejemplos</h2>
      </div>
    </div>
    <div class="card-body text-start">
      <p>Excel Reader es una librería que permite la lectura de archivos con extensión xlsx.</p>
      <ul>
        <li>
          <p>Lectura de un área: <a href="excel-area/index.php">excel-area</a></p>
        </li>
        <li>
          <p>Lectura de una planilla que contiene imágenes: <a href="excel-img/index.php">excel-img</a></p>
        </li>
        <li>
          <p>Lectura de una planilla iniciando en la primera fila: <a href="excel-sheet/index.php">excel-sheet</a></p>
        </li>
        <li>
          <p>Carga de un excel a la BD: <a href="excel-carga/form.php">excel-carga</a></p>
        </li>
      </ul>
    </div>
  </div>
</main>

<?php
include STRUCTURE_PATH . 'footer.php';
?>