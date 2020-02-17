<?php

	function array_sort_by(&$arrIni, $col, $order = SORT_ASC){
		$arrAux = array();
		foreach ($arrIni as $key=> $row)
		{
			$arrAux[$key] = is_object($row) ? $arrAux[$key] = $row->$col : $row[$col];
			$arrAux[$key] = strtolower($arrAux[$key]);
		}
		array_multisort($arrAux, $order, $arrIni);
	}

	function getDataAtualizacaoBoletim($array){
	$dataAtualizacaoBoletim = new DateTime();
		if(is_array($array) && !empty($array)){
			for ($i = 0; $i < count($array); $i++) {
				$relatorio = $array[$i];
				if($i==0){
					$dataAtualizacaoBoletim = new DateTime($relatorio['dataAtualizacao']);
				}else{
					$dataTemp = new DateTime($relatorio['dataAtualizacao']);
					if($dataTemp > $dataAtualizacaoBoletim){
						$dataAtualizacaoBoletim = $dataTemp;
					}
				}
			}
		}

		$dataAtualizacaoBoletim = $dataAtualizacaoBoletim->format('d/m/Y');
		return $dataAtualizacaoBoletim;
	}

?>