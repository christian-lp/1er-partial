<?php
session_start();
if (isset($_SESSION['usr_role']) == "") 
{
    echo '<script type="text/javascript"> ;
    window.location.href="index.php";</script>';
}
else
{
    if( $_SESSION["estado"]==1)
    {
        $_SESSION["estado"]=1;
        $conectado = "Activo";
        echo "<html><body>";
        echo "<h1>My DashBoard Admin</h1>";
        echo "Bienvenido al Area de usuarios: <strong>";
        echo $_SESSION["nombre"]." ".$_SESSION["usr_name"]." Estado: ". $conectado;
        echo "</strong><br>Has entrado con el nick: ".$_SESSION["email"]." <strong> ";
        echo $_SESSION["login"];
        echo "<br>";
        echo "</strong>";
        echo "</strong>";
        echo "<br>";
    }

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Administrar Archivos</title>
</head>
<body>
<h3>Eliminar Archivos</h3>
    <form action= "admin.php" method="POST">
        <input type="submit" name="controls" value="Eliminar controls.dat">
        <input type="submit" name="results" value="Eliminar results.dat">
        <input type="submit" name="establish_del" value="Eliminar establishments.dat">
    </form>

    <h2>Ejecutar scripts</h2>
    

    <form action="admin.php" method="POST">
        <input type="submit" name="sh" value="Ejecutar script run_relation.sh">
    </form>
    <form action="admin.php" method="POST">
        <input type="submit" name="establish_run" value="Ejecutar script establishment.py">
    </form>
    <form action="admin.php" method="POST">
        <input type="submit" name="controls_run" value="Ejecutar script Controls.php">
    </form>
    <form action="admin.php" method="POST">
        <input type="submit" name="results_run" value="Ejecutar script Results.php">
    </form>
    <br>
    <br><strong>Para realizar busqueda de establecimientos, pulsa: <a href='../../controllers/search_est.php'>Aqui</a>
    <br>Para realizar busqueda de resultados de estudios, pulsa: <a href='../../controllers/search_result.php'>Aqui</a>
    <br>Para realizar busqueda de controles, pulsa: <a href='../../controllers/search_control.php'>Aqui</a></strong>
    <br><br>Para cerrar la sesion, pulsa: <a href='logout.php'>Aqui</a><br>
</body>
</html>