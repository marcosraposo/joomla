<?php 
    defined('_JEXEC') or die;
	
	//ORDENACAO
 	function array_sort_by2(&$arrIni, $col, $order = SORT_ASC){
		$arrAux = array();
		foreach ($arrIni as $key=> $row)
		{
			$arrAux[$key] = is_object($row) ? $arrAux[$key] = $row->$col : $row[$col];
			$arrAux[$key] = strtolower($arrAux[$key]);
		}
		array_multisort($arrAux, $order, $arrIni);
	}
 
 
 
    //Funcao para separar os artigos por categorias
    function getListArticleCategory2($list, $category){
        $listCategory = array();
        foreach ($list as $article) {
            if($article->catid == $category){
                array_push($listCategory, $article);
            }
        }
        return $listCategory;
    }

    //Funcao para separar os artigos por ano
    /*function getListArticleAno($list, $ano){
        $listAno = array();
        foreach ($list as $article) {
            $data = explode('-', $article->publish_up, 2);
            $anoArticle = $data[0];
            if($ano == $anoArticle){
                array_push($listAno, $article);
            }
        }
        return $listAno;
    }*/

    //Funcao para separar os artigos por ano-mes
    /* function getListArticleAnoMes($list, $anoMes){
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
    } */

    //Data de atualizacao utiliza o campo Data de Publicacao
    //Caso não tenha nenhum artigo publicado, utilizará a data atual;
    function getDataAtualizacao3($list){
        $dataAtualizacao = new DateTime();
        if(isset($list[0]->publish_up) && !empty($list[0]->publish_up)){
            $dataAtualizacao = new DateTime($list[0]->publish_up);
        }
        $dataAtualizacao = $dataAtualizacao->format('d/m/Y');
        return $dataAtualizacao;
    }
    
    //Percorrerá a lista de Valores e juntara o texto em html que sera exibido mais abaixo.
    function getTextoExibicao3($list){
        $textoExibicao = "";
        
        foreach($list as $valores): 
            $texto = str_replace("<p>", "", $valores->introtext);
            $texto = str_replace("</p>", "", $texto);
            
            $textoExibicao .= $texto;
        endforeach; 
        
        return $textoExibicao;
    }

    function getClass3($texto){
        $class = "row";
        $div = strripos($texto, "<div class=\"row report\">");
        if($div === false){
            $class = "row botoes w100";
        }else{
            $class = "row";
        }
        return $class;
    }

?>