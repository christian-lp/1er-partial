<?php

require_once 'CreateFile.php';

$results = new CreateFile("../../data/results.dat");
$results->CreateFile();
$count=1;

$archive = fopen('../../data/toscovid.csv', 'r')or die ('No open file');
while(!feof($archive))
{
    $line = fgets($archive);
    if(!empty($line))
    {
        $data = explode("|",$line);
        $id_case = trim($data[0]);
        $result = trim($data[1]);

        $exist=0;
        $archive2 = fopen('../../data/results.dat','r')or die('No open file');
        while(!feof($archive2)and $exist==0)
        {
            $line = fgets($archive2);
            $data = explode("|",$line);
            $id_case2 = trim($data[1]);
            
            if($id_case == $id_case2)
            {
                $exist=1;
                break;
                fclose($archive2);
            }
        }
        if($exist==0)
        {
            $archive2= fopen('../../data/results.dat','a+')or die('No open file');
            {
                fwrite($archive2,$count."|".$id_case."|".$result."\n");
                $count++;
                fclose($archive2);
            }
        }
    }
}fclose($archive);


echo("Extraction completed successfully!\n")
?>

<br>
<br>
<button onclick="history.back()">Volver</button>