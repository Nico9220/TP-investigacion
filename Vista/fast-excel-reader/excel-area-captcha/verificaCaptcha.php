<?php
  include_once __DIR__."/../../includes/configuracion.php";
  include_once (STRUCTURE_PATH."head.php");
  include_once __DIR__.'/../../vendor/google/recaptcha/src/autoload.php';
  include_once  __DIR__.'/../../vendor/avadim/fast-excel-reader/src/autoload.php';

  $file = __DIR__.'/../../uploads/area.xlsx';
  $excel = \avadim\FastExcelReader\Excel::open($file);
  $excel->setDateFormat('d-m-Y');
  $datos = data_submitted();

  /////////////////////////////////////////////////////////////////////////////////////
  $secretKey = "6LfvL2AoAAAAAN8fZt2hRdSfO2Eat_iLduvfW7rM"; // CLAVE SECRETA
  $recaptcha = new \ReCaptcha\ReCaptcha($secretKey);
  ////////////////////////////////////////////////////////////////////////////////////      
      
?>
<main class="p-5 text-center bg-light">
    <div class="justify-content-md-center align-items-center ">
        <div class="card shadow mx-auto">
            <div class="card-header">
                <h3>Resultado</h3>
            </div>
            <div class="card-body">
                <?php
                if ($datos) {
									if (
											$datos['columnStart']!=='null'
											&& $datos['columnEnd']!=='null'
											&& $datos['rowStart']!=='null'
											&& $datos['rowEnd']!=='null'
											){
											$columnStart=strtoupper($datos['columnStart']);
											$columnEnd=strtoupper($datos['columnEnd']);
											$rowStart=$datos['rowStart'];
											$rowEnd=$datos['rowEnd'];
											$area = $columnStart.$rowStart.":".$columnEnd.$rowEnd;
											$result = $excel->setReadArea($area)->readRows(true);
									}else{
											$result = $excel->readRows(true);
											$area = array_key_first($excel->readCells()).":".array_key_last($excel->readCells());
									};
									$sheet = $excel->sheet();
									$firstRow = $sheet->readFirstRow();
									// Verifica el reCAPTCHA
									if (isset($datos['g-recaptcha-response'])) {
											$response = $datos['g-recaptcha-response']; //resultado si resolvieron el captcha
											$remoteIp = $_SERVER['REMOTE_ADDR']; // la dirección IP del usuario
											$recaptchaResponse = $recaptcha->verify($response, $remoteIp); //esta función se utiliza para verificar la respuesta CAPTCHA proporcionada por un usuario y 
																																											//realizar validaciones adicionales según las configuraciones opcionales.
																																											// Si se encuentran errores de validación, se devuelve una respuesta con los errores.
											if ($recaptchaResponse->isSuccess()) {
													// El reCAPTCHA se pasó con éxito.
													include 'excel-area.php';    
											} else {
													// El reCAPTCHA no se pasó, maneja el error adecuadamente.
													$errors = $recaptchaResponse->getErrorCodes();
													// Maneja los errores, por ejemplo, muestra un mensaje al usuario.
													foreach ($errors as $error) {
															echo "Error de reCAPTCHA: $error<br>";
													}
											}
									} else {
											// El reCAPTCHA no se proporcionó, maneja el error adecuadamente.
											echo "Por favor, completa el reCAPTCHA.";
									}
                }
                ?>
                <br><a href="index.php" class="btn btn-primary">Volver</a>
            </div>
        </div>
    </div>
</main>
<?php include(STRUCTURE_PATH . "footer.php"); ?>

