<?php
session_start();
if (isset($_SESSION['usr_role']) == "") 
{
    echo '<script type="text/javascript"> ;
    window.location.href="index.php";</script>';
}
else
{
?>
<!DOCTYPE html>
<html>
<head>
	<title>Inicio | Panel de Control</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
	<link rel="stylesheet" href="../../views/css/bootstrap.min.css" type="text/css" />

	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">

</head>
<body>

<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php" style="font-family: 'Lobster', cursive;">Practicas Profesionalizantes</a>
		</div>
		<div class="collapse navbar-collapse" id="navbar1">
			<ul class="nav navbar-nav navbar-right">
				<?php if (isset($_SESSION['usr_role'])) { ?>
				<li><p class="navbar-text">Logeado como <i class="btn btn-danger btn-xs" ><b><?php echo $_SESSION['usr_name']; ?></b></i></p></li>
				<li><a href="logout.php">Log Out</a></li>
				<?php } else { ?>
				<li><a href="login.php">Login</a></li>
				<li><a href="register.php">Registro</a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</nav>

<div class="container">

      <!--Componente principal de un mensaje de primario o llamado a la acción -->
      <div class="jumbotron">
        <h1>Parcial N°1</h1>
        <p>Bienvenido!</p>
        <p>Un placer participar en este parcial..</p>
        <p><a class="btn btn-lg btn-primary" href="register.php" role="button">Registrarse</a></p>
      </div>

    </div>

<script src="js/jquery-1.10.2.js"></script>

<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        
        <script src="datatables/jquery.dataTables.js"></script>
        <script src="datatables/dataTables.bootstrap.js"></script>
        <script>
        $(document).ready(function() {
				var dataTable = $('#lookup').DataTable( {
					
				 "language":	{
					"sProcessing":     "Procesando...",
					"sLengthMenu":     "Mostrar _MENU_ registros",
					"sZeroRecords":    "No se encontraron resultados",
					"sEmptyTable":     "Ningún dato disponible en esta tabla",
					"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
					"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
					"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
					"sInfoPostFix":    "",
					"sSearch":         "Buscar:",
					"sUrl":            "",
					"sInfoThousands":  ",",
					"sLoadingRecords": "Cargando...",
					"oPaginate": {
						"sFirst":    "Primero",
						"sLast":     "Último",
						"sNext":     "Siguiente",
						"sPrevious": "Anterior"
					},
					"oAria": {
						"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
						"sSortDescending": ": Activar para ordenar la columna de manera descendente"
					}
				},

					"processing": true,
					"serverSide": true,
					"ajax":{
						url :"ajax-grid-data.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".lookup-error").html("");
							$("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">Sin datos, para ser mostrados en el datatable</th></tr></tbody>');
							$("#lookup_processing").css("display","none");
							
						}
					}
				} );
			} );
        </script>


</body>
</html>
<?php
}
if($_SESSION["estado"] == 1)
$conectado = "Activo";
$_SESSION["estado"]=1;
echo "<html><body>";
echo "<h1>My DashBoard User</h1>";
echo "Bienvenido al Area de usuarios: <strong>";
echo $_SESSION["nombre"]." ".$_SESSION["usr_name"]." Estado: ".$conectado;
echo "</strong><br>Has entrado con el nick: ".$_SESSION["email"]." <strong> ";
echo $_SESSION["login"];
echo "<br>";
echo "</strong>";
echo "</strong>";
echo "<br>";
echo "<br>";
echo "<br>";
?>

<br><strong>Para realizar busqueda de establecimientos, pulsa: <a href='search_est.php'>Aqui</a>
<br>Para realizar busqueda de resultados de estudios, pulsa: <a href='search_result.php'>Aqui</a>
<br>Para realizar busqueda de controles, pulsa: <a href='search_control.php'>Aqui</a></strong>
<br><br>Para cerrar la sesion, pulsa: <a href='logout.php'>Aqui</a><br>
