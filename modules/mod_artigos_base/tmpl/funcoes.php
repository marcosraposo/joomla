<?php 
    defined('_JEXEC') or die; 
    //Funcao para separar os artigos por categorias
    function getListArticleCategory($list, $category){
        $listCategory = array();
        foreach ($list as $article) {
            if($article->catid == $category){
                array_push($listCategory, $article);
            }
        }
        return $listCategory;
    }

    //Data de atualizacao utiliza o campo Data de Publicacao
    //Caso não tenha nenhum artigo publicado, utilizará a data atual;
    function getDataAtualizacao($list){
        $dataAtualizacao = new DateTime();
        if(isset($list[0]->publish_up) && !empty($list[0]->publish_up)){
            $dataAtualizacao = new DateTime($list[0]->publish_up);
        }
        $dataAtualizacao = $dataAtualizacao->format('d/m/Y');
        return $dataAtualizacao;
    }
    
    //Percorrerá a lista de Valores e juntara o texto em html que sera exibido mais abaixo.
    function getTextoExibicao($list){
        $textoExibicao = "";
        
        foreach($list as $valores): 
            $texto = str_replace("<p>", "", $valores->introtext);
            $texto = str_replace("</p>", "", $texto);
            
            $textoExibicao .= $texto;
        endforeach; 
        
        return $textoExibicao;
    }

    function getClass($texto){
        $class = "row";
        $div = strripos($texto, "<div class=\"row report\">");
        if($div === false){
            $class = "row botoes w100";
        }else{
            $class = "row";
        }
        return $class;
    }