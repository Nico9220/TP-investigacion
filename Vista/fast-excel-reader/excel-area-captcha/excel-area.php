    <div class="card shadow">
      <div class="card-header">
        <div class="card-title">
          <h2 class="fst-italic">Librería útil: FAST EXCEL READER - Ejemplo de lectura de un área.</h2>
          <h4></h4> 
        </div>
        <div class="card-subtitle">
          <p>En este ejemplo se muestra el contenido del <strong>área <?php echo $area;?></strong> de una planilla excel.
          <br> Se tienen en cuenta los campos tipo "date" para darle un formato legible.</p>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-striped table-hover">
          <thead class="border">
            <tr>
              <?php
                  echo '<th class="border-2 border-top-0 border-start-0 table-light" scope="col"></th>';
                  foreach ($firstRow as $key => $value) {
                    echo '<th class="border-2 border-top-0 table-light" scope="col">'.$key.'</th>';
                  }
                  ?>        
            </tr>
            <tr>
              <?php
              echo '<td class="border-2 border-start-0 table-light fw-bold" scope="col">'.($sheet->firstRow()-1).'</td>';
                foreach ($firstRow as $key => $value) {
                  echo '<th scope="col">'.$value.'</th>';
                }
                ?>        
            </tr>
          </thead>
          <tbody class="border">
            <?php
            foreach ($result as $cellKey => $cellValue) {    
              echo '<tr>';
              echo '<td class="border-2 border-start-0 table-light fw-bold">'.$cellKey.'</td>';
              foreach ($firstRow as $rowKey => $rowValue) {
                echo isset($cellValue[$rowValue])? '<td>'.$cellValue[$rowValue].'</td>':'<td></td>';
              }
              echo '</tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
