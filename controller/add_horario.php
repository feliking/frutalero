<?php

if(!empty($_POST)){
	if(isset($_POST["ide"])){
		if($_POST["ide"]!=""){
				include('conexion.php');
				$lunes = null;
				$martes = null;
				$miercoles = null;
				$jueves = null;
				$viernes = null;
				$sabado = null;
				$domingo = null;
				if(isset($_POST['lunes'])){
					$lunes=implode(",",$_POST['lunes']);
				}
				else{
					$lunes = '';
				}
				if(isset($_POST['martes'])){
					$martes=implode(",",$_POST['martes']);
				}
				else{
					$martes = '';
				}
				if(isset($_POST['miercoles'])){
					$miercoles=implode(",",$_POST['miercoles']);
				}
				else{
					$miercoles = '';
				}
				if(isset($_POST['jueves'])){
					$jueves=implode(",",$_POST['jueves']);
				}
				else{
					$jueves = '';
				}
				if(isset($_POST['viernes'])){
					$viernes=implode(",",$_POST['viernes']);
				}
				else{
					$viernes = '';
				}
				if(isset($_POST['sabado'])){
					$sabado=implode(",",$_POST['sabado']);
				}
				else{
					$sabado = '';
				}
				if(isset($_POST['domingo'])){
					$domingo=implode(",",$_POST['domingo']);
				}
				else{
					$domingo = '';
				}
				$sql = "INSERT INTO horarios(
					nombre,
					descripcion,
					lunes,
					martes,
					miercoles,
					jueves,
					viernes,
					sabado,
					domingo)
					VALUES (
				\"$_POST[nombre]\",
				\"$_POST[descripcion]\",
				'$lunes',
				'$martes',
				'$miercoles',
				'$jueves',
				'$viernes',
				'$sabado',
				'$domingo'
				)";
				$query = $con->query($sql) or die(mysqli_error($con));
				if($query!=null){
					print "<script>alert(\"El horario se registró exitosamente\");window.location='../views/view-horario.php';</script>";
				}
			}
		}
		else{
			echo "falla el segundo if";
		}
	}

?>