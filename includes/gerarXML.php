<?php


error_reporting(0);
$table = "<table >
	<tr><td>nome</td><td>idade</td><td>cidade</td></tr>
	<tr><td>joao</td><td>50</td><td>igarassu</td></tr>
	<tr><td>joao</td><td>50</td><td>igarassu</td></tr>
	<tr><td>joao</td><td>50</td><td>igarassu</td></tr>
	<tr><td>joao</td><td>50</td><td>igarassu</td></tr>
	<tr><td>joao</td><td>50</td><td>igarassu</td></tr>
</table>";

$table = str_replace("</td>","",$table);
$table = str_replace("</tr>","",$table);
 
$strg = explode("<tr>", $table);
$tags = explode("<tr>", $table);

$titulos = explode("<td>", $tags[1]);

$i2 = 0;
$td_titulos = "";
$xml = "";
foreach($strg as $tr){
	$td = explode("<td>", $tr);

	if($i2 == 1){
		$td_titulos = explode("<td>", $tr);
	}
	
	$i = 0;
	if($i2 >= 2 ){
		foreach($td as $td2){
			if($i >= 1){
				echo "<".$td_titulos[$i].">". $td2."</".$td_titulos[$i].">";
			}
			$i++;
		}
	}
	$i2++;
}


header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename=sample.xml');
$fp = fopen("php://output", "w");
fputxml($fp, $xml);
fclose($fp);


?>

 