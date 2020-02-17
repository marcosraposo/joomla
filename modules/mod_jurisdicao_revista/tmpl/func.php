<?php
function array_sort_by3(&$arrIni, $col, $order = SORT_ASC){
	$arrAux = array();
	foreach ($arrIni as $key=> $row)
	{
		$arrAux[$key] = is_object($row) ? $arrAux[$key] = $row->$col : $row[$col];
		$arrAux[$key] = strtolower($arrAux[$key]);
	}
	array_multisort($arrAux, $order, $arrIni);
}

function getDataAtualizacaoRevista($array){
	$dataAtualizacao = new DateTime();
	if (is_array($array) && !empty($array)) {
		for ($i = 0; $i < count($array); $i++) {
			$relatorio = $array[$i];
			if ($i == 0) {
				$dataAtualizacao = DateTime::createFromFormat('d/m/Y', trim($relatorio['dataAtualizacao']));
			} else {
				$dataTemp = DateTime::createFromFormat('d/m/Y', trim($relatorio['dataAtualizacao']));
				if ($dataTemp > $dataAtualizacao) {
					$dataAtualizacao = $dataTemp;
				}
			}
		}
	}
	$dataAtualizacao = $dataAtualizacao->format('d/m/Y');
	return $dataAtualizacao;
}	
?>