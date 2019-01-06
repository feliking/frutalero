<?php
include_once("conexion.php");
$input = filter_input_array(INPUT_POST);
if ($input['action'] == 'edit') {	
	$update_field='';
	if(isset($input['1'])) {
		$update_field.= "ciudad_nac='".$input['1']."'";
	} else if(isset($input['2'])) {
		$update_field.= "nombres='".$input['2']."'";
	} else if(isset($input['3'])) {
		$update_field.= "apellidos='".$input['3']."'";
	} else if(isset($input['4'])) {
		$update_field.= "domicilio='".$input['4']."'";
	} else if(isset($input['10'])) {
		$update_field.= "sueldo_mensual='".$input['10']."'";
	} else if(isset($input['11'])) {
		$update_field.= "area_designada='".$input['11']."'";
	}
	if($update_field && $input['id']) {
		$sql_query = "UPDATE personal SET $update_field WHERE ci_per='" . $input['id'] . "'";	
		mysqli_query($con, $sql_query) or die("database error:". mysqli_error($con));		
	}
}


