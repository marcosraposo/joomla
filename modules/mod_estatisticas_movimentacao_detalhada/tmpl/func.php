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
	
function url_link(){ // cria o link para abrir o modulo de resultado em pdf
$url_link =  $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$url_link = explode("index.php",$url_link);
	$ssl = "http://";
	if( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ){
		$ssl = "https://";
	}
	return $ssl.$url_link[0];
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
	
	
	
function conteudo($arr, $dados, $mes){

$url_link = url_link();
$conteudo = "";
	if(is_array($arr)){
		array_sort_by3($arr, 'descricaoAnexo', $order = SORT_ASC);
		$descricaoMes = "";
		foreach($arr as $arrMes){
			if(empty( $arrMes['descricaoAnexo'])){
				$arrMes  = $arr;
				echo "<a  style='width: 60%;text-align: center;text-decoration: none;' class='box box-col-3'  href='".$url_link."index.php/gestao-orcamentaria/resultado-pdf?/id=" . $arrMes['id'] . "&MOD=".$dados['params']['servico_pdf']."&niveis=" .  urlencode($dados['params']['titulo_tab_1']."/" . $arrMes['descricaoAnexo']) . "'>
							" . $arrMes['descricaoAnexo'] . "
							</a><br><br>";
				break;
			}
			
			
				echo "<a  style='width: 60%;text-align: center;text-decoration: none;' class='box box-col-3'  href='".$url_link."index.php/gestao-orcamentaria/resultado-pdf?/id=" . $arrMes['id'] . "&MOD=".$dados['params']['servico_pdf']."&niveis=" .  urlencode($dados['params']['titulo_tab_1']."/" . $arrMes['descricaoAnexo']) . "'>
							" . $arrMes['descricaoAnexo'] . "
							</a><br><br>";
		}
}

return $conteudo;
}

?>