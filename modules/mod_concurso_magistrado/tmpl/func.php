<?php
	function array_sort_by2(&$arrIni, $col, $order = SORT_ASC){
		$arrAux = array();
		foreach ($arrIni as $key=> $row)
		{
			$arrAux[$key] = is_object($row) ? $arrAux[$key] = $row->$col : $row[$col];
			$arrAux[$key] = strtolower($arrAux[$key]);
		}
		array_multisort($arrAux, $order, $arrIni);
	}

	function getDataAtualizacao($array){
		$dataAtualizacao = new DateTime();
		if(is_array($array) && !empty($array)){
			for ($i = 0; $i < count($array); $i++) {
				$relatorio = $array[$i];
				if($i==0){
					echo $relatorio['dataAtualizacao'];
					//$dataAtualizacao = new DateTime($relatorio['dataAtualizacao']);
				}else{
					//$dataTemp = new DateTime($relatorio['dataAtualizacao']);
					if($dataTemp > $dataAtualizacao){
						$dataAtualizacao = $dataTemp;
					}
				}
			}
		}
	}

	function getListDadosPorConcurso($list, $titulo){
		$listCategory = array();
        foreach ($list as $concurso) {
            if($concurso['tituloConcurso'] == $titulo){
                array_push($listCategory, $concurso);
            }
        }
        return $listCategory;
	}

	/**
	* Converter número romano para inteiro
	*/
	function numberRomanToInteger($numRoman, $debug = false){
		$nRoman = $numRoman;
		$default = array(
			'M'     => 1000,
			'CM'     => 900,
			'D'     => 500,
			'CD'     => 400,
			'C'     => 100,
			'XC'     => 90,
			'L'     => 50,
			'XL'     => 40,
			'X'     => 10,
			'IX'     => 9,
			'V'     => 5,
			'IV'     => 4,
			'I'     => 1,
		);
	
		$int = 0;
		foreach ($default as $key => $value) {
			while (strpos($numRoman, $key) === 0) {
				$int += $value;
				$numRoman = substr($numRoman, strlen($key));
			}
		}
	
		if($debug){
			return sprintf('%s = %s', $nRoman, $int);
		}
	
		return $int;
	}

	function ordenarTitulos($arrayTitulos){
		
		$numArray = array();
		foreach ($arrayTitulos as $titulo){
			$parte = explode(" ", $titulo);
			$numRomano = $parte[0];
			
			array_push($numArray, numberRomanToInteger($numRomano));
		}
		
		rsort($numArray);
		$arrayRetorno = array();
		foreach ($numArray as $numero){
			foreach ($arrayTitulos as $titulo){
				$parte = explode(" ", $titulo);
				$numRomano = $parte[0];
				if(numberRomanToInteger($numRomano) == $numero){
					if(!in_array($titulo, $arrayRetorno)){
						array_push($arrayRetorno, $titulo);
					}
				}
			}
		}

		return $arrayRetorno;
	}
?>