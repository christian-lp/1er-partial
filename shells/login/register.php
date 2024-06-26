<?php
session_start();
error_reporting(E_ALL);
if(isset($_SESSION['usr_id'])) {
		echo'<script type="text/javascript"> ;
		window.location.href="login.php";</script>';
	
}

// llamo a la función que se va a encargar de realizar el envio del mail ///

require("../../funciones/funciones.php");

//Establece el error de validación como flag
$error = false;

//check if form is submitted
if (isset($_POST['signup'])) 
{
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
	$terminosycond =$_POST['terminosycond'];
	
	//Nombre sólo puede contener caracteres alfabéticos y espacio (esto varia sgun requerimiento)
	if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
		$error = true;
		$name_error = "El nombre debe contener solo caracteres del alfabeto y espacio.";
	}
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		$error = true;
		$email_error = "Ingresa un correo electrónico válido.";
	}
	if(strlen($password) < 6) {
		$error = true;
		$password_error = "La contraseña debe tener un mínimo de 6 caracteres.";
	}
	if($password != $cpassword) {
		$error = true;
		$cpassword_error = "Las contraseñas no coinciden";
	}
	if(!$terminosycond) {
		//$error = true;
		//$terminosycond_error = "Debes aceptar Terminos y condiciones";
	}
	if (!$error) {

//////////// codigo para verificar los datos ingresados

	$ok=0;
	chmod('../../data/Registro.txt', 777);
	$archivo=fopen('../../data/Registro.txt','r') or die ("Error de apertura de archivo, consulte con el administrador...");
	while(!feof($archivo) and $ok==0)
	{
	    $linea=fgets($archivo);
		if(!empty($linea)){
			$datos=explode("|",$linea);
			$lastname= $datos[0];
			$mail= $datos[1];
			$active=$datos[2];
			$role=$datos[3];
			$passwd=$datos[4];
       		if($email==$mail) 
	   		{
				$ok=1;
	  		}
		}
	}
// si es igual usuario e identica pass y ademas esta activa podría ingresar
	fclose($archivo);

	if($ok == 1)
	{ 
		$errormsg = '
		<div class="alert alert-danger alert-dismissable fade in">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		    <strong>Error de registro.!</strong> Verifica tus datos, ya existe un usuario registrado con el mismo Email.
		</div>
		';

//si activada, que es el campo que seleccionamos es 0, informamos que debe activar su cuenta para poder usarla
	}
	else
	{
		$activ = 1;
		$rol=1;
			$archivo=fopen('../../data/Registro.txt','a+') or die ("Error en registro, consulte con el administrador...");
			fputs($archivo, $name."|".$email."|".$activ."|".$rol."|".md5($password)."\n");
			fclose($archivo);
			if (is_readable("../../data/Config.txt")){
				$config_file=fopen('../../data/Config.txt','r+') or die ("Error de apertura de archivo, consulte con el administrador...");
				while(!feof($config_file))
				{
			
					$linea=fgets($config_file);
					if (!empty($linea)){
						$datos=explode("|",$linea);
						$site=$datos[0];
						$sourcemail= $datos[1];
						$passmail=$datos[2];
					}
				}
				enviar_mail($email,$name,$site,$sourcemail,$passmail);
				$successmsg = '
			    <div class="alert alert-success alert-dismissable fade in">
			    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    	<strong>EXITO.!</strong> ¡Registrado exitosamente!
			    </div>
			  	';
			} 
			
			else
			{
				// echo "no existe";
				// exit;
				$errormsg = '
				<div class="alert alert-danger alert-dismissable fade in">
				    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				    <strong>Error de registro.!</strong> Error no se pudo enviar mail de confirmación.
				</div>
				';
			} 
			
	} 
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registro Usuario</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
	<!--link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" /-->
	<link rel="stylesheet" href="../../views/css/style.css" type="text/css" />
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">

</head>
<body>

<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<!-- add header -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="../../index.php" style="font-family: 'Lobster', cursive;">Practicas Profesionalizantes</a>
		</div>
		<!-- menu items -->
		<div class="collapse navbar-collapse" id="navbar1">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="login.php">Login</a></li>
				<li class="active"><a href="register.php">Registro</a></li>
			</ul>
		</div>
	</div>
</nav>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="signupform">
				<fieldset>
					<legend>Registro</legend>

					<div class="form-group">
						<label for="name">Apellido y Nombres</label>
						<input type="text" name="name" placeholder="Nombres Completos" required value="<?php if($error) echo $name; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
					</div>
					
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" name="email" placeholder="Correo Electrónico" required value="<?php if($error) echo $email; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
					</div>

					<div class="form-group">
						<label for="password">Contraseña</label>
						<input type="password" name="password" placeholder="Contraseña" required class="form-control" />
						<span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
					</div>

					<div class="form-group">
						<label for="cpassword">Repita Contraseña</label>
						<input type="password" name="cpassword" placeholder="Confirmar Contraseña" required class="form-control" />
						<span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
					</div>
					
					<div class="checkbox">
					    <label>
					      <input type="checkbox" name="terminosycond" id="terminosycond" required=""> Acepto todos los 
					      <!-- Button trigger modal -->
							<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#TernimosCondiciones">
							  Terminos y condiciones
							</button>
							<br>
							<span class="text-danger"><?php if (isset($terminosycond_error)) echo $terminosycond_error; ?></span>
					    </label>
					</div>

					<div class="form-group">
						<input type="submit" name="signup" value="Registrar" class="btn btn-primary" />
					</div>
				</fieldset>
			</form>
			<span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
			<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">	
		Ya te registaste? <a href="login.php">Logeate Aqui</a>
		</div>
	</div>
</div>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>


<!-- Modal -->
<div class="modal fade" id="TernimosCondiciones" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">
        	<b>Terminos y Condiciones </b>
        </h4>
      </div>
      <div class="modal-body">
        Mediante la simple utilización de Practicas Profesionalizantes y al contratar cualquiera de los servicios ofrecidos a través de Practicas Profesionalizantes, el Cliente reconoce haber leído y acepta los términos expuestos en el presente Acuerdo y / o las políticas que formen parte del mismo.
        <br>
        <br>
        <p>
        	<b>Uso de la cuenta de usuario en Practicas Profesionalizantes</b>
        </p>
		<p>
			<ul>
				<li>El usuario de Registros.com se compromete a proporcionar mediante su registro datos veraces, exactos y completos sobre su identidad. También se compromete a revisar periódicamente la información proporcionada y garantiza la validez y la vigencia de los datos asociados tanto a su cuenta de usuario como a los productos y servicios contratados. El incumplimiento de esta condición podrá motivar la cancelación de la cuenta y la denegación al usuario el acceso a los servicios de Registros.com de forma temporal o permanente.</li>
				<li>Registros.com se reserva el derecho de solicitar la verificación y / o actualización de la información proporcionada por el Cliente, quien deberá responder satisfactoriamente a la petición de Registros.com en el plazo máximo de 5 días laborables. El Cliente entiende y acepta que el no cumplimiento de este requisito constituye una vulneración del presente Acuerdo y puede dar lugar a la cancelación de los productos y/o servicios cont...</li>
				<br>
				<a href="#" class="btn btn-default btn-xs">
					<span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span> Descargar PDF
				</a>
			</ul>
		</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        <!--button type="button" class="btn btn-primary">Guardar Cambios</button-->
      </div>
    </div>
  </div>
</div>

<script>
	//Modal terminos y condiciones
	$('#TernimosCondiciones').on('shown.bs.modal', function () {
	  $('#myInput').focus()
	})
</script>