<?php
    include_once  '../../../includes/configuracion.php';
    include_once(STRUCTURE_PATH . "head.php");
?>
    <main class="index p-5 text-center bg-light">
      <!-- Contenido de la página -->

      <div class="card shadow">
        <a type="button" class="btn-close position-absolute top-0 end-0" href='../../fast-excel-reader/#ejemplos'></a>
        <div class="card-header">
          <div class="card-title">
            <h2 class="fst-italic">Ejemplo de lectura y carga de un excel</h2>
          </div>
          <div class="card-subtitle">
            <p>En este ejemplo podrá subir un excel con la siguiente estructura:</p>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-striped table-hover">
            <thead class="border">
              <tr>
                <th class="border-2 border-top-0 border-start-0 table-light" scope="col">DNI</th>
                <th class="border-2 border-top-0 table-light" scope="col"> NOMBRE</th>
                <th class="border-2 border-top-0 table-light" scope="col"> FECHA DE NACIMIENTO</th>
              </tr>
              <tr>
                <td>DNI 1</td>
                <td>NOMBRE 1</td>
                <td>FECHA NAC 1</td>
              </tr>
            </thead>
            <tbody class="border">
                <tr>
                <td>DNI 2</td>
                <td>NOMBRE 2</td>
                <td>FECHA NAC 2</td>
                </tr>
            </tbody>
        </div>
        </table>
        <div class="card-body">
            <form action="./formAction.php" id="form" method="post" enctype="multipart/form-data" class="input-group validate">
                <div class="mb-1">
                    <input id="archivo" name="archivo" class="form-control" type="file" required>
                    <div class="mensaje-error"></div>
                </div>
                <div>
                    <input class="btn btn-primary" type="submit" id="submit" value="Subir Excel">
                </div>
            </form>
        </div>
      </div>
    </main>

    <?php include(STRUCTURE_PATH . "footer.php"); ?>