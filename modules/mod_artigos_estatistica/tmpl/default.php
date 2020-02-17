<?php 
    defined('_JEXEC') or die;

    //Funcao para separar os artigos por categorias
    function getListArticleCategory($list, $category){
        $listCategory = array();

        foreach ($list as $article) {
            if($article->category_alias == $category){
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
    
    //recebe o título da pagina
    $titulo = $params->get('title');
    
    //Recebe o subtitle que foi informado como parametro no modulo.
    $subtitle = $params->get('subtitle');
    $subtitle = str_replace("<p>", "", $subtitle);
    $subtitle = str_replace("</p>", "", $subtitle);
    
    //Recebe o rodape da pagina que foi informado como parametro no modulo.
    $rodape = $params->get('footer');
    $rodape = str_replace("<p>", "", $rodape);
    $rodape = str_replace("</p>", "", $rodape);

    $listQuinta = getListArticleCategory($list, 'quinta-regiao');
    $listVarasJEF = getListArticleCategory($list, 'varas-de-jef');
    $listVarasComum = getListArticleCategory($list, 'varas-comuns');
	$listVaraPrimeiro = getListArticleCategory($list, 'vara-primeiro-grau');
	$listVaraSegundo = getListArticleCategory($list, 'vara-segundo-grau-estatistica');

?>
<div class="container demonstrativo bg_azul_fundo">
    <div class="row conteudo selecionado">
        <div class="col-12">
            <div class="row">
                <div class="titulo"><?=$titulo?></div>                
            </div>   
            <div class="row">
                <small>Por Vara, Tipo e por Seção Judiciária nos Últimos 07 Anos</small>                
            </div>
            <div class="spacer"></div>
            <div class="row botoes w100" style="display:block">
                    
                <?php echo html_entity_decode($subtitle); ?>
                
                <div class="clearfix"></div>
                <div class="spacer"></div>
                
                <!-- Quinta Regiao -->
                <div class="subtitulo" style="font-size: 17px">Quinta Região</div>
                <small>Última atualização: <?php echo getDataAtualizacao($listQuinta);?></small>
                <?php echo html_entity_decode(getTextoExibicao($listQuinta)); ?>
                
                <div class="clearfix"></div>
                <div class="spacer"></div>

                <!-- Segundo Grau -->
                <div class="subtitulo" style="font-size: 17px">Segundo Grau</div>
                <small>Última atualização: <?php echo getDataAtualizacao($list);?></small>
                <?php echo html_entity_decode(getTextoExibicao($listVaraSegundo)); ?>

                <div class="clearfix"></div>
                <div class="spacer"></div>

                <!-- Primeiro Grau -->
                <div class="subtitulo" style="font-size: 17px">Primeiro Grau</div>
                <small>Última atualização: <?php echo getDataAtualizacao($list);?></small>
                <?php echo html_entity_decode(getTextoExibicao($listVaraPrimeiro)); ?>

                <div class="clearfix"></div>
                <div class="spacer"></div>

                <!-- VARAS JEF -->
                <div class="subtitulo" style="font-size: 17px">Varas de JEF - Processos Físicos e Virtuais</div>
                <small>Última atualização: <?php echo getDataAtualizacao($listVarasJEF);?></small>
                <?php echo html_entity_decode(getTextoExibicao($listVarasJEF)); ?>
                <div class="clearfix"></div>
                <div class="spacer"></div>

                <!-- Varas Comuns -->
                <div class="subtitulo" style="font-size: 17px">Varas Comuns - Processos Físicos</div>
                <small>Última atualização: <?php echo getDataAtualizacao($listVarasComum);?></small>
                <?php echo html_entity_decode(getTextoExibicao($listVarasComum)); ?>
                <div class="clearfix"></div>
                <div class="spacer"></div>

                <?php echo html_entity_decode($rodape); ?>
            </div>
        </div>
    </div>
</div>