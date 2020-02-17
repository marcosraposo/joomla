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

	function getDataAtualizacaoArtigo($array){
		$dataAtualizacao = new DateTime();
		if(is_array($array) && !empty($array)){
			for ($i = 0; $i < count($array); $i++) {
				$relatorio = $array[$i];
				if($i==0){
					$dataAtualizacao = new DateTime($relatorio->publish_up);
				}else{
					$dataTemp = new DateTime($relatorio->publish_up);
					if($dataTemp > $dataAtualizacao){
						$dataAtualizacao = $dataTemp;
					}
				}
			}
		}

		$dataAtualizacao = $dataAtualizacao->format('d/m/Y');
		return $dataAtualizacao;
	}

	
		function getDataAtualizacao($array){
		$dataAtualizacao = new DateTime();
		if(is_array($array) && !empty($array)){
			$first = true;
			foreach ($array['anos'] as $ano) {
				for ($i = 0; $i < count($ano['meses']); $i++) {
					$mes = $ano['meses'][$i];
					if($mes['exibe']){
						if($first){
							$dataAtualizacao = DateTime::createFromFormat('d/m/Y', $mes['dataAtualizacao']);
							$first = false;
						}else{
							$dataTemp = DateTime::createFromFormat('d/m/Y', $mes['dataAtualizacao']);
							if($dataTemp > $dataAtualizacao){
								$dataAtualizacao = $dataTemp;
							}
						}
					}
				}
			}
		}

		$dataAtualizacao = $dataAtualizacao->format('d/m/Y');
		return $dataAtualizacao;
	}
	
	
	function mesParaNumero($mes){
			if($mes == "JAN"){
				$mesOrdem = "01";
			}if($mes == "FEV"){
				$mesOrdem = "02";
			}if($mes == "MAR"){
				$mesOrdem = "03";
			}if($mes == "ABR"){
				$mesOrdem = "04";
			}if($mes == "MAI"){
				$mesOrdem = "05";
			}if($mes == "JUN"){
				$mesOrdem = "06";
			}if($mes == "JUL"){
				$mesOrdem = "07";
			}if($mes == "AGO"){
				$mesOrdem = "08";
			}if($mes == "SET"){
				$mesOrdem = "09";
			}if($mes == "OUT"){
				$mesOrdem = "10";
			}if($mes == "NOV"){
				$mesOrdem = "11";
			}if($mes == "DEZ"){
				$mesOrdem = "12";
			}
	
	return $mesOrdem;
	}
	
	
	
?>