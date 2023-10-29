<?php

require_once 'CreateFile.php';

$control = new CreateFile("../../data/controls.dat");
$control->CreateFile();

$archive = fopen('../../data/toscovid.csv', 'r')or die ('No open file');
while(!feof($archive))
{
    $line = fgets($archive);
    if(!empty($line))
    {
        $data = explode("|",$line);
        $id_case = $data[0];
        $sint = trim($data[2]);
        $contact = trim($data[3]);
        $group_r = trim($data[4]);
        $establish = trim($data[5]);
        $most = trim($data[6]);
        $process = trim($data[7]);
        chmod('../../data/establishments.dat', 0777);
        $archive2 = fopen('../../data/establishments.dat','r')or die('No open file');

        while(!feof($archive2))
        {
            $line = fgets($archive2);
            $data = explode("|",$line);
            $id_est = $data[0];
            $establish2 = trim($data[1]);
            
            if($establish == $establish2)
            {
                $id_est = $id_est;
                break;
                fclose($archive2);
            }
        }
        if($exist==0)
        {
            $archive3= fopen('../../data/controls.dat','a+')or die('No open file');
            {
                fwrite($archive3,$id_case."|".$id_est."|".$sint."|".$contact."|".$group_r."|".$most."|".$process."\n");
                fclose($archive3);
            }
        }
    }
}fclose($archive);

echo("Extraction completed successfully!\n")

?>

<br>
<br>
<button onclick="history.back()">Volver</button>