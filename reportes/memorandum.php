<?php ob_start();
	require_once '../controller/conexion.php';
	require_once 'dompdf/lib/html5lib/Parser.php';
	require_once 'dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
	require_once 'dompdf/lib/php-svg-lib/src/autoload.php';
	require_once 'dompdf/src/Autoloader.php';
	Dompdf\Autoloader::register();
	extract($_GET);
	$sql = "SELECT * FROM memorandums m, personal p WHERE m.id = $id AND m.id_personal = p.id";
	$query = $con->query($sql) or die(mysqli_error($con));
	$personal = mysqli_fetch_row($query);
	$week_days = array ("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");  
    $months = array ("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");  
    $year_now = date ("Y");  
    $month_now = date ("n");  
    $day_now = date ("j");  
    $week_day_now = date ("w");  
    $date = $day_now . " de " . $months[$month_now] . " de " . $year_now;
	if ($personal[2] == 'Felicitacion') {
		//ob_start();
		# code...
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<font face="Arial">
		<table width="100%">
			<tr>
				<th colspan="2"></th>
			</tr>
			<tr>
				<th colspan="2"><br><br><center><font size="40px">M E M O R A N D U M</font></center></th>
			</tr>
			<tr>
				<th width="50%"><img src="../views/images/preset/logo-frutalero.png" width="400px"></th>
				<th width="50%" style="font-weight: normal;">Señor(a):<br><b><?php echo $personal[8].' '.$personal[9]; ?> <br><?php echo $personal[15]; ?></b><br>en el área de:<br><b><?php echo $personal[14]; ?></b><br>La Paz, <?php echo $date; ?><?php  ?></th>
			</tr>
			<tr>
				<th colspan="2" style="font-weight: normal;">De mi consideracion:<br><br><br>Me es grato comunicarle que en compendio con Gerencia General es un honor para nosotros y 
					nuestra honorable empresa otorgarle este <b>MEMORANDUM DE FELICITACION</b> bajo el siguiente concepto 
					de "<b><?php echo $personal[3]; ?></b>"<br><br>Sin más que decir nos despedimos de la manera mas distinguida y siga 
					adelante con su excelente trabajo que es muy valioso su desempeño para nosotros. <br><br> Desearle éxito en sus funciones, saludos a usted con toda atención</th>
			</tr>
			<tr>
				<th colspan="2" height="250px" style="font-weight: normal;">Lic. Doris Mabel García Lugones <br><b>GERENTE GENERAL <br>DEPARTAMENTO DE RECURSOS HUMANOS</b></th>
			</tr>
		</table>
	</font>

	

</body>
</html>

<?php 
	}
	elseif ($personal[2] == 'Llamada de atencion') {
		//ob_end_clean();
		//ob_start();
	
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<font face="Arial">
		<table width="100%">
			<tr>
				<th colspan="2"></th>
			</tr>
			<tr>
				<th colspan="2"><br><br><center><font size="40px">M E M O R A N D U M</font></center></th>
			</tr>
			<tr>
				<th width="50%"><img src="../views/images/preset/logo-frutalero.png" width="400px"></th>
				<th width="50%" style="font-weight: normal;">Señor(a):<br><b><?php echo $personal[8].' '.$personal[9]; ?> <br><?php echo $personal[15]; ?></b><br>en el área de:<br><b><?php echo $personal[14]; ?></b><br>La Paz, <?php echo $date; ?><?php  ?></th>
			</tr>
			<tr>
				<th colspan="2" style="font-weight: normal;">Sr.(a) <?php echo $personal[8].' '.$personal[9]; ?>:<br><br><br>El presente de <b>MEMORANDUM DE LLAMADA DE ATENCION</b> 
					es para recordarle las obligaciones que conlleva formar parte de nuestra gran familia, es por eso que nos vemos obligados a pedirle que esperamos un poco más de 
					su compromiso para con nosotros, la presente llamada de atención es bajo el concepto "<b><?php echo $personal[3]; ?></b>"<br><br>Sin más que decir nos despedimos de la manera mas distinguida y siga 
					adelante con sus funciones. <br><br> Desearle éxito en sus funciones y un poco más de compromiso.</th>
			</tr>
			<tr>
				<th colspan="2" height="250px" style="font-weight: normal;">Lic. Doris Mabel García Lugones <br><b>GERENTE GENERAL <br>DEPARTAMENTO DE RECURSOS HUMANOS</b></th>
			</tr>
		</table>
	</font>

	

</body>
</html>
	<?php 
		}
		elseif ($personal[2] == 'Sancion') {
			//ob_end_clean();
			//ob_start();
		
	 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<font face="Arial">
		<table width="100%">
			<tr>
				<th colspan="2"></th>
			</tr>
			<tr>
				<th colspan="2"><br><br><center><font size="40px">M E M O R A N D U M</font></center></th>
			</tr>
			<tr>
				<th width="50%"><img src="../views/images/preset/logo-frutalero.png" width="400px"></th>
				<th width="50%" style="font-weight: normal;">Señor(a):<br><b><?php echo $personal[8].' '.$personal[9]; ?> <br><?php echo $personal[15]; ?></b><br>en el área de:<br><b><?php echo $personal[14]; ?></b><br>La Paz, <?php echo $date; ?><?php  ?></th>
			</tr>
			<tr>
				<th colspan="2" style="font-weight: normal;">Sr.(a) <?php echo $personal[8].' '.$personal[9]; ?>:<br><br><br>Recordarle que nuestra empresa cumple con estrictas reglas en cuanto
				a normas internas y externas, es por eso que nos vemos obligados a conferirle el presente <b>MEMORANDUM DE SANCION</b> bajo el concepto 
					de "<b><?php echo $personal[3]; ?></b>"<br><br>Esperamos reflexione en cuanto su compromiso con nosotros y no tengamos que tomar médidas más drasticas. <br><br> 
				Desearle éxito en sus funciones, saludos a usted con toda atención.</th>
			</tr>
			<tr>
				<th colspan="2" height="250px" style="font-weight: normal;">Lic. Doris Mabel García Lugones <br><b>GERENTE GENERAL <br>DEPARTAMENTO DE RECURSOS HUMANOS</b></th>
			</tr>
		</table>
	</font>

	

</body>
</html>
<?php
}
		// reference the Dompdf namespace
		use Dompdf\Dompdf;

		// instantiate and use the dompdf class
		$dompdf = new Dompdf();
		$dompdf->set_option('defaultFont', 'Arial');
		$dompdf->loadHtml(ob_get_clean());

		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'portrait');

		// Render the HTML as PDF
		$dompdf->render();

		// Output the generated PDF to Browser
		$dompdf->stream();
?>