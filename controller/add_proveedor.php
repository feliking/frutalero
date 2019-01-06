<?php
if(!empty($_POST)){
	if(isset($_POST["nombre"])){
		if($_POST["nombre"]!=""){
			include "conexion.php";
			if (!$_FILES['respaldo']['error']==4) {
				if ($_FILES['respaldo']['type']=="image/jpeg"||$_FILES['respaldo']['type']=="image/png"||$_FILES['respaldo']['type']=="image/gif"||$_FILES['respaldo']['type']=="application/pdf") {
					$respaldo=time().$_FILES['respaldo']['name'];
					$origen2=$_FILES['respaldo']['tmp_name'];
					$destino2="../files/proveedor/$respaldo";
					move_uploaded_file($origen2,$destino2);
				}
				else{
					print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/add_proveedor.php';</script>";
				}
			}
			else{
				$respaldo="";
			}
			$found=false;
			$sql1= "SELECT * FROM proveedor WHERE nombre=\"$_POST[nombre]\"";
			$query1=mysqli_query($con,$sql1);
            while($arreglo=mysqli_fetch_array($query1)){
            	$found=true;
            	break;
            }
			if($found){
				print "<script>alert(\"Ese proveedor ya se encuentra registrado.\");window.location='../views/add_proveedor.php';</script>";
			}
			else{
			$sql = "insert into proveedor(
				nombre,
				nit,
				direccion,
				email,
				contacto,
				telefono,
				archivo,
				nro_cuenta) values (
					\"$_POST[nombre]\",
					\"$_POST[nit]\",
					\"$_POST[direccion]\",
					\"$_POST[email]\",
					\"$_POST[contacto]\",
					\"$_POST[telefono]\",
					'$respaldo',
					\"$_POST[nro_cuenta]\")";
			$query = $con->query($sql);
			if($query!=null){
				print "<script>alert(\"El contrato fue registrado exitosamente.\");window.location='../views/add_proveedor.php';</script>";
				mysqli_close($con);
			}
			else{
				echo "Hay problemas con la consulta";
			}
			}
		}
		else{
			print "<script>alert(\"Por lo menos debe escribir el nombre de la empresa\");window.location='../views/add_proveedor.php';</script>";
		}
	}
	else{
		print "<script>alert(\"Por lo menos debe escribir el nombre de la empresa\");window.location='../views/add_proveedor.php';</script>";
	}
}
else{
	echo "Hay problemas en el primer if";
}
?>