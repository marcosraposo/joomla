<?php 
    defined('_JEXEC') or die;
 
    //Funcao para separar os artigos por categorias
    function getListArticleCategoryMA($list, $category){
        $listCategory = array();
        foreach ($list as $article) {
            if($article->catid == $category){
                array_push($listCategory, $article);
            }
        }
        return $listCategory;
    }

    function array_sort_by(&$arrIni, $col, $order = SORT_ASC){
		$arrAux = array();
		foreach ($arrIni as $key=> $row)
		{
			$arrAux[$key] = is_object($row) ? $arrAux[$key] = $row->$col : $row[$col];
			$arrAux[$key] = strtolower($arrAux[$key]);
		}
		array_multisort($arrAux, $order, $arrIni);
	}
	
    //Funcao para separar os artigos por ano
    function getListArticleAnoMA($list, $ano){
        $listAno = array();
        foreach ($list as $article) {
            $data = explode('-', $article->publish_up, 2);
            $anoArticle = $data[0];
            if($ano == $anoArticle){
                array_push($listAno, $article);
            }
        }
        return $listAno;
    }

    //Funcao para separar os artigos por ano-mes
    function getListArticleAnoMesMA($list, $anoMes){
        $listAnoMes = array();
        foreach ($list as $article) {
            $data = explode('-', $article->publish_up, 3);
            $ano = $data[0];
            $mes = $data[1];
            if($anoMes == $ano."-".$mes){
                array_push($listAnoMes, $article);
            }
        }
        return $listAnoMes;
    }

    //Data de atualizacao utiliza o campo Data de Publicacao
    //Caso não tenha nenhum artigo publicado, utilizará a data atual;
    function getDataAtualizacaoMA($list){
        $dataAtualizacao = new DateTime();
        if(isset($list[0]->publish_up) && !empty($list[0]->publish_up)){
            $dataAtualizacao = new DateTime($list[0]->publish_up);
        }
        $dataAtualizacao = $dataAtualizacao->format('d/m/Y');
        return $dataAtualizacao;
    }
    
    //Percorrerá a lista de Valores e juntara o texto em html que sera exibido mais abaixo.
    function getTextoExibicaoMA($list){
        $textoExibicao = "";
        
        foreach($list as $valores): 
            $texto = str_replace("<p>", "", $valores->introtext);
            $texto = str_replace("</p>", "", $texto);
            
            $textoExibicao .= $texto;
        endforeach; 
        
        return $textoExibicao;
    }

    function getMesMA($texto){
        $retorno = "";
        if($texto == "1"){
            $retorno = "JAN";
        }else if($texto == "2"){
            $retorno = "FEV";
        }else if($texto == "3"){
            $retorno = "MAR";
        }else if($texto == "4"){
            $retorno = "ABR";
        }else if($texto == "5"){
            $retorno = "MAI";
        }else if($texto == "6"){
            $retorno = "JUN";
        }else if($texto == "7"){
            $retorno = "JUL";
        }else if($texto == "8"){
            $retorno = "AGO";
        }else if($texto == "9"){
            $retorno = "SET";
        }else if($texto == "10"){
            $retorno = "OUT";
        }else if($texto == "11"){
            $retorno = "NOV";
        }else if($texto == "12"){
            $retorno = "DEZ";
        }
        return $retorno;
    }
	
	
function detalhamentoRelatorioMA($divisao, $botaoResultado, $anoMes){
	$botao = "";

	if( strpos( $divisao, "FINA" )){
		$botao .= "
			<div class='row botoes2' style='display: none' id='".$anoMes."'> 
				<ul>
				    $botaoResultado 
				</ul>    
				<div class='clearfix'></div>                         
			</div>
			";
	}
	if( strpos( $divisao, "REMU" )){
		$botao .= "
			<div class='row botoes2' style='display: none' id='".$anoMes."'> 
				<ul>
				    $botaoResultado
				</ul>    
				<div class='clearfix'></div>                         
			</div>
			";
	}

	if( strpos( $divisao, "CARGOS" )){
		$botao .= "
			<div class='row botoes2' style='display: none' id='".$anoMes."'> 
				<ul>
				    $botaoResultado
				</ul>    
				<div class='clearfix'></div>                         
			</div>
			";
	}
	
	if( strpos( $divisao, "DETALHA" )){
		$botao .= "
			<div class='row botoes2' style='display: none' id='".$anoMes."'> 
				<ul>
				    $botaoResultado
				</ul>    
				<div class='clearfix'></div>                         
			</div>
			";
	}
	
	return $botao;
}
?>