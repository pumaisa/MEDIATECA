<?php
	

/*En este php, se accede a los datos de la base de datos, se comprueba el usuario, asi como la contraseña y redirecciona segun el caso a los diferentes mensajes 
	de error*/	
	if (isset($_POST["cuenta"]) && isset($_POST['contra'])){
		//Conexión a la base de datos
				
		
		$conexion = mysqli_connect('localhost', 'root', '', 'usuarios');
		if (mysqli_connect_errno($conexion)) {
			echo 'Fallo al conectar a MySQL: ' . mysqli_connect_error();
		}
		// En caso que la conexion sea exitosa, se mete al programa
		else{
			$cuenta=$_POST['cuenta'];
			$resultado=mysqli_query($conexion, "SELECT * FROM alumnos WHERE no_cta='".$cuenta."';");
			$consulta=mysqli_fetch_assoc($resultado);
			$contra=$_POST['contra'];
			$nombreusuario=$consulta["nombre_usuario"];	
				//Comprobar si el usuario existe
			if ($nombreusuario=="")
			{
					echo "<script>";
					echo "alert('Usuario no registrado!');";  
					echo "window.location = 'index.html';";
					echo "</script>";
//EL usuario es válido:
			}
			else {
					SESSION_start();
					$_SESSION["nombre"]=$nombreusuario;
					//$_SESSION["id"]=$consulta["no_cta"];
				
					echo "<script>";
					echo "alert('Bienvenido de Nuevo!');";  
					echo "window.location = '../../indexP.html';";
					echo "</script>";						
					}
					
		}
		mysqli_close($conexion);
	}
	else {
		echo "Formulario de inicio de sesion inválido.";
	}


?>