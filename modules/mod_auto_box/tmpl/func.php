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

function url_link(){ // cria o link para abrir o modulo de resultado em pdf
$url_link =  $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$url_link = explode("index.php",$url_link);
	$ssl = "http://";
	if( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ){
		$ssl = "https://";
	}
	return $ssl.$url_link[0];
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
	
	
	
function conteudoSumulas($arr, $dados){
$conteudo = "";

	if(is_array($arr)){
		$descricaoMes = "";

		$conteudo .= "<table style=' margin-top:-40px;'>
		<tbody>
		<tr>
		<th>SÚMULAS</th>
		<th>Descrição</th>
		</tr>";
		
		$arr2 = array_sort($arr, 'numeroSequencial', $order = SORT_ASC);
		$url_link = url_link();
		foreach($arr2 as $arrMes){
		if(!empty($arrMes['descricaoAnexo'])){//compara o mes
		$conteudo .= "<tr>
			<td align='center'>
				<a href='".$url_link."index.php/gestao-orcamentaria/resultado-pdf?/id=" . $arrMes['id'] . "&MOD=".$dados['params']['servico_pdf']."&niveis=" .  urlencode($dados['params']['titulo_tab_1']."/" . $arrMes['numeroSequencial']) . "'>
					" . $arrMes['numeroSequencial'] . "
				</a>
			</td>
			<td>".$arrMes['descricaoAnexo']."</td>
			</tr>";
		}
		}
				
		if(!empty($arr2['descricaoAnexo'])){//compara o mes
		$conteudo .=  "<tr>
			<td align='center'>
				<a href='".$url_link."index.php/gestao-orcamentaria/resultado-pdf?/id=" . $arr2['id'] . "&MOD=".$dados['params']['servico_pdf']."&niveis=" . urlencode($dados['params']['titulo_tab_1']."/" . $arr2['numeroSequencial']) . "'>
				" . $arr2['numeroSequencial'] . "
				</a>
			</td>
			<td>".$arr2['dataFormatada']."</td>
			<td>".$arr2['descricaoAnexo']."</td>
			</tr>";
		}

		$conteudo .= "</tbody>
		</table><br/>";
		}
return $conteudo;
}
	
	
	
	
function portariaCJF($arr, $dados){
$conteudo = "";
$url_link = url_link();

$gatilho = 0;
foreach ($arr as $arr2){
	if(is_array($arr2)){
		$gatilho = 1;
		$descricaoMes = "";
		foreach($arr2 as $arrMes){
		if(!empty($arrMes['descricaoAnexo'])){//compara o mes
		$conteudo .= "
				<p class='box'>
					<a href='".$url_link."index.php/gestao-orcamentaria/resultado-pdf?/id=" . $arrMes['id'] . "&MOD=".$dados['params']['servico_pdf']."&niveis=" . urlencode("LEGISLAÇÃO CJF/" . $arrMes['descricaoAnexo']) . "'>
						" . $arrMes['descricaoAnexo'] . "
					</a>
				</p>			
			";
		}
		}
		if(!empty($arr2['descricaoAnexo'])){//compara o mes
			$conteudo .= "
				<p class='box'>
					<a href='".$url_link."index.php/gestao-orcamentaria/resultado-pdf?/id=" . $arr2['id'] . "&MOD=".$dados['params']['servico_pdf']."&niveis=" . urlencode("LEGISLAÇÃO CJF/" . $arr2['descricaoAnexo']) . "'>
						" . $arr2['descricaoAnexo'] . "
					</a>
				</p>			
			";
		}
		}
	}

if($gatilho == 0){
	if(!empty($arr['descricaoAnexo'])){//compara o mes
		$conteudo .= "
		<p class='box'>
			<a href='".$url_link."index.php/gestao-orcamentaria/resultado-pdf?/id=" . $arr['id'] . "&MOD=".$dados['params']['servico_pdf']."&niveis=" . urlencode("LEGISLAÇÃO CJF/" . $arr['descricaoAnexo']) . "'>
				" . $arr['descricaoAnexo'] . "
			</a>
		</p>			
		";
	}	
}
return $conteudo;
}

	
function conteudo($arr, $dados, $mes){
$conteudo = "";
	if(is_array($arr)){
		$descricaoMes = "";
		$conteudo .= "<table style=' margin-top:-40px;'>
		<tbody>
		<tr>
		<th>Nº</th>
		<th>Data</th>
		<th>Descrição</th>
		</tr>";
		
		$arr2 = array_sort($arr, 'numeroSequencial', $order = SORT_ASC);
		$url_link = url_link();
		foreach($arr2 as $arrMes){
		if(!empty($arrMes['descricaoAnexo']) ){//compara o mes
		$conteudo .= "<tr>
			<td align='center'>
				<a href='".$url_link."index.php/gestao-orcamentaria/resultado-pdf?/id=" . $arrMes['id'] . "&MOD=".$dados['params']['servico_pdf']."&niveis=" . urlencode($dados['params']['titulo_tab_1']."/N.º" . $arrMes['numeroSequencial']) . "'>
					" . $arrMes['numeroSequencial'] . "
				</a>
			</td>
			<td>".$arrMes['dataFormatada']."</td>
			<td>".$arrMes['descricaoAnexo']."</td>
			</tr>";
		}
		}
		if(!empty($arr2['descricaoAnexo'])){//compara o mes
		$conteudo .=  "<tr>
			<td align='center'>
				<a href='".$url_link."index.php/gestao-orcamentaria/resultado-pdf?/id=" . $arr2['id'] . "&MOD=".$dados['params']['servico_pdf']."&niveis=" . urlencode($dados['params']['titulo_tab_1']."/N.º" . $arr2['numeroSequencial']) . "'>
				" . $arr2['numeroSequencial'] . "
				</a>
			</td>
			<td>".$arr2['dataFormatada']."</td>
			<td>".$arr2['descricaoAnexo']."</td>
			</tr>";
		}
		$conteudo .= "</tbody>
		</table><br/>";
		}
return $conteudo;
}

function decisaoConselhoAdm($arr, $dados, $mes){
$conteudo = "";

if(is_array($arr)){
	$descricaoMes = "";
	$conteudo .= "<table style=' margin-top:-40px;'>
	<tbody>
	<tr>
	<th>DESCRIÇÃO</th>
	<th>Data</th>
	<th>COMPLEMENTO</th>
	</tr>";
	$i = 0;

	foreach($arr as $listaData){
		if(empty($listaData['dataAtualizacao'])){
			$listaData = $arr;
			$numeroData = explode('/', $listaData['dataAtualizacao']);
			$arr5[$i] = $listaData;
			$arr5[$i]['numeroData'] = $numeroData[2].$numeroData[1].$numeroData[0];
			$i++;
			break;
		}
		$numeroData = explode('/', $listaData['dataAtualizacao']);
		$arr5[$i] = $listaData;
		$arr5[$i]['numeroData'] = $numeroData[2].$numeroData[1].$numeroData[0];
		$i++;
	}

	$arr2 = array_sort($arr5, 'numeroData', $order = SORT_ASC);
	$url_link = url_link();
	foreach($arr2 as $arrMes){
		if(!empty($arrMes['descricaoAnexo']) ){//compara o mes
		$conteudo .= "<tr>
			<td align='center'>
				<a href='".$url_link."index.php/gestao-orcamentaria/resultado-pdf?/id=" . $arrMes['id'] . "&MOD=".$dados['params']['servico_pdf']."&niveis=" . urlencode($dados['params']['titulo_tab_1']."/N.º" . $arrMes['descricaoAnexo']) . "'>
					" . $arrMes['descricaoAnexo'] . "
				</a>
								
			</td>
			<td>".$arrMes['dataFormatada']."</td>
			<td>".$arrMes['complemento']."</td>
			</tr>";
		}
	}

	$conteudo .= "</tbody>
	</table></br>";
	}
return $conteudo;
}





?>