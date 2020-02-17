<?php

function mesDescricao($mesDescricao){
	$mesOrdem = "";
	if($mesDescricao == '01'){
		$mesOrdem = "JAN";
	}if($mesDescricao == "02"){
		$mesOrdem = "FEV";
	}if($mesDescricao == "03"){
		$mesOrdem = "MAR";
	}if($mesDescricao == "04"){
		$mesOrdem = "ABR";
	}if($mesDescricao == "05"){
		$mesOrdem = "MAI";
	}if($mesDescricao == "06"){
		$mesOrdem = "JUN";
	}if($mesDescricao == "07"){
		$mesOrdem = "JUL";
	}if($mesDescricao == "08"){
		$mesOrdem = "AGO";
	}if($mesDescricao == "09"){
		$mesOrdem = "SET";
	}if($mesDescricao == "10"){
		$mesOrdem = "OUT";
	}if($mesDescricao == "11"){
		$mesOrdem = "NOV";
	}if($mesDescricao == "12"){
		$mesOrdem = "DEZ";
	}
	return	$mesOrdem;
}

function mesNumero($descricaoMes){
	$mesOrdem = "";
	if($descricaoMes == "JAN"){
		$mesOrdem = "1";
	}if($descricaoMes == "FEV"){
		$mesOrdem = "2";
	}if($descricaoMes == "MAR"){
		$mesOrdem = "3";
	}if($descricaoMes == "ABR"){
		$mesOrdem = "4";
	}if($descricaoMes == "MAI"){
		$mesOrdem = "5";
	}if($descricaoMes == "JUN"){
		$mesOrdem = "6";
	}if($descricaoMes == "JUL"){
		$mesOrdem = "7";
	}if($descricaoMes == "AGO"){
		$mesOrdem = "8";
	}if($descricaoMes == "SET"){
		$mesOrdem = "9";
	}if($descricaoMes == "OUT"){
		$mesOrdem = "10";
	}if($descricaoMes == "NOV"){
		$mesOrdem = "11";
	}if($descricaoMes == "DEZ"){
		$mesOrdem = "12";
	}
return	$mesOrdem;
}

function getDataAtualizacaoA($array){
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

	
	
function array_sort_by2(&$arrIni, $col, $order = SORT_ASC){
	$arrAux = array();
	foreach ($arrIni as $key=> $row)
	{
		$arrAux[$key] = is_object($row) ? $arrAux[$key] = $row->$col : $row[$col];
		$arrAux[$key] = strtolower($arrAux[$key]);
	}
	array_multisort($arrAux, $order, $arrIni);
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