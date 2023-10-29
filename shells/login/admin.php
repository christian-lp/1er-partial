<?php
$controls = '../../data/controls.dat';
$esta = '../../data/establishments.dat';
$results = '../../data/results.dat';

//elimina archivos .dat
if (isset($_POST['controls']))
{
    if (file_exists($controls)) 
    {
        if (unlink($controls)) 
        {
            echo 'El archivo se ha eliminado correctamente! ';
        } 
        else 
        {
            echo 'No se pudo eliminar el archivo! ';
        }
    } 
    else
    {
        echo 'El archivo Controls.dat no existe! ';
    }
}

if (isset($_POST['establish_del'])) 
{

    if (file_exists($esta)) 
    {
        if (unlink($esta)) 
        {
            echo 'El archivo se ha eliminado correctamente! ';
        } 
        else 
        {
            echo 'No se pudo eliminar el archivo! ';
        }
    } 
    else
    {
        echo 'El archivo results.dat no existe! ';
    }
}

if (isset($_POST['results']))
{
    if (file_exists($results)) 
    {
        if (unlink($results)) 
        {
            echo 'El archivo se ha eliminado correctamente! ';
        } 
        else 
        {
            echo 'No se pudo eliminar el archivo! ';
        }
    } 
    else
    {
        echo 'El archivo results.dat no existe! ';
    }
}


//ejecuta escripts
if (isset($_POST['sh'])) {
    // Ejecutar script run_relation.sh aquí
    shell_exec('bash /var/www/html/ev_cristianlugo/shells/normalizators/run_relation.sh');
    echo "listo";
}

if (isset($_POST['establish_run'])) {
    // Ejecutar script establishment.py aquí
    exec('python3 /var/www/html/ev_cristianlugo/shells/normalizators/establishment.py');
    echo "listo";
}

if (isset($_POST['controls_run'])) {
    // Ejecutar script controls.php aquí
    shell_exec('php /var/www/html/ev_cristianlugo/shells/normalizators/controls.php');
    echo "listo";
}

if (isset($_POST['results_run'])) {
    // Ejecutar script results.php aquí
    shell_exec('php /var/www/html/ev_cristianlugo/shells/normalizators/results.php');
    echo "listo";
}

?>
<br>
<br>
<button onclick="history.back()">Volver</button>