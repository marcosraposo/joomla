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


	
function getDataAtualizacao2($array){
	$dataAtualizacao = new DateTime();
	if (is_array($array) && !empty($array)) {
	//// parte da funcao corrige o nullpointer por conta do array[0]
	////Testar se depois da base de dados ser sincronizada irá continuar dando o erro
	
		$dataAtualizacao = DateTime::createFromFormat('d/m/Y', trim($array[count($array)-1]['dataAtualizacao']));
		for ($i = 1; $i <= count($array); $i++) {
			$relatorio = $array[$i];
			$dataTemp = DateTime::createFromFormat('d/m/Y', trim($relatorio['dataAtualizacao']));
			if ($dataTemp > $dataAtualizacao) {
				$dataAtualizacao = $dataTemp;
			}
		}
	//// comentada a parte da funcao com o erro nullpointer por conta do array[0]
	////Testar se depois da base de dados ser sincronizada irá continuar dando o erro
	/*
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
	*/
	}
	$dataAtualizacao = $dataAtualizacao->format('d/m/Y');
	return $dataAtualizacao;
}
	

	
	function array_sort($array, $on, $order=SORT_ASC)
{
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
            break;
            case SORT_DESC:
                arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}


?>