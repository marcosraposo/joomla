<?php 
    defined('_JEXEC') or die;
    
    //Funcao para separar os artigos por ano
    function getListArticleAno($list, $ano){
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

    //Data de atualizacao utiliza o campo Data de Publicacao
    //Caso não tenha nenhum artigo publicado, utilizará a data atual;
    function getDataAtualizacao2($list){
        $dataAtualizacao = new DateTime();
        if(isset($list[0]->publish_up) && !empty($list[0]->publish_up)){
            $dataAtualizacao = new DateTime($list[0]->publish_up);
        }
        $dataAtualizacao = $dataAtualizacao->format('d/m/Y');
        return $dataAtualizacao;
    }
    
    //Percorrerá a lista de Valores e juntara o texto em html que sera exibido mais abaixo.
    function getTextoExibicao2($list){
        $textoExibicao = "";
        
        foreach($list as $valores): 
            $texto = str_replace("<p>", "", $valores->introtext);
            $texto = str_replace("</p>", "", $texto);
            
            $textoExibicao .= $texto;
        endforeach; 
        
        return $textoExibicao;
    }
    
?>