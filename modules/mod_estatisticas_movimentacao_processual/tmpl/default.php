<?php 

function getAnexosVara($lista){
    $dados = array();
    if(is_array($lista) && !empty($lista)){
        foreach ($lista as $retorno) {
            if($retorno['exibe']){
                foreach ($retorno['movimentacoes']['anexos'] as $anexo) {
                    $pos =  strripos($anexo['descricao'], "(Por tipo)");
                    if($pos === false){
                        array_push($dados, $anexo);
                    }
                }
            }
        }
    }
    return $dados;
}

function getAnexosTipo($lista){
    $dados = array();
    if(is_array($lista) && !empty($lista)){
        foreach ($lista as $retorno) {
            if($retorno['exibe']){
                foreach ($retorno['movimentacoes']['anexos'] as $anexo) {
                    $pos =  strripos($anexo['descricao'], "(Por tipo)");
                    if($pos !== false){
                        array_push($dados, $anexo);
                    }
                }
            }
        }
    }
    return $dados;
}

function getAnexosSecoesTotais($lista){
    $dados = array();
    if(is_array($lista) && !empty($lista)){
        foreach ($lista as $retorno) {
            if($retorno['exibe']){
                foreach ($retorno['movimentacoes']['anexos'] as $anexo) {
                    if(is_array($anexo)){
                        $pos =  strripos($anexo['descricao'], "Totais Gerais");
                        if($pos !== false){
                            array_push($dados, $anexo);
                        }
                    }else{
                        $arrayNew = $retorno['movimentacoes']['anexos'];
                        if(!in_array($arrayNew, $dados)){
                            $pos =  strripos($arrayNew['descricao'], "Totais Gerais");
                            if($pos !== false){
                                array_push($dados, $arrayNew);
                            }
                        }
                    }
                }
            }
        }
    }
    return $dados;
}

function renomearDescricao($descricao){
    $pos = strripos($descricao, "Totais Gerais");
    $retorno = "";
    if($pos !== false){
        $retorno = trim(str_ireplace("Resumo da 5ª Região ", "", $descricao));
        $retorno = trim(str_ireplace("- Totais Gerais", "", trim($retorno)));
        $retorno = trim(str_ireplace("- Processos distribuídos, julgados, arquivados e em tramitação", "", $retorno));
    }else{
        $retorno = trim(str_ireplace("Resumo da 5ª Região ", "", $descricao));
        $retorno = trim(str_ireplace("- Totais Gerais", "", trim($retorno)));
        $retorno = trim(str_ireplace("- Gráficos Processos", "", $retorno));
    }
    return $retorno;
}

function getAnexosSecoesGraficos($lista){
    $dados = array();
    if(is_array($lista) && !empty($lista)){
        foreach ($lista as $retorno) {
            if($retorno['exibe']){
                foreach ($retorno['movimentacoes']['anexos'] as $anexo) {
                    if(is_array($anexo)){
                        $pos =  strripos($anexo['descricao'], "Gráficos Processos");
                        if($pos !== false){
                            array_push($dados, $anexo);
                        }
                    }else{
                        $arrayNew = $retorno['movimentacoes']['anexos'];
                        if(!in_array($arrayNew, $dados)){
                            $pos =  strripos($arrayNew['descricao'], "Gráficos Processos");
                            if($pos !== false){
                                array_push($dados, $arrayNew);
                            }
                        }
                    }
                }
            }
        }
    }
    return $dados;
}

function getDataAtualizacao($array){
    $dataAtualizacao = new DateTime();
    if(is_array($array) && !empty($array)){
        $first = true;
        foreach($array as $retorno){
            if($retorno['exibe']){
                foreach ($retorno['movimentacoes']['anexos'] as $anexo) {
                    if($first){
                        $dataAtualizacao = DateTime::createFromFormat('d/m/Y', trim($anexo['dataPublicacao']));
                        $first = false;
                    }else{
                        $dataTemp = DateTime::createFromFormat('d/m/Y', trim($anexo['dataPublicacao']));
                        if($dataTemp > $dataAtualizacao){
                            $dataAtualizacao = $dataTemp;
                        }
                    }
                }
            }
        }
    }

    $dataAtualizacao = $dataAtualizacao->format('d/m/Y');
    return $dataAtualizacao;
}

function retiraBarras($string){
    $string = str_replace("/", "&#47;", $string);
    return $string;
}

?>

<div class="spacer"></div>
<div class="spacer"></div>
<div style="display:none;">
    <input type="text" id="idMesOcultar" value="vazio"/>
</div>
<div class="container demonstrativo bg_azul_fundo">
    <div class="row conteudo selecionado responsivo" data-aba-id="1">
        <div class="col-12">

            <div class="row">
                <div class="titulo">MOVIMENTAÇÃO PROCESSUAL DO 1º GRAU NA 5ª REGIÃO</div>
            </div>
            <div class="row">
                <small>Última atualização: <?= getDataAtualizacao($list['varas']); ?></small>
            </div>
            <div class="row">
                <div class="texton">Por Vara, Tipo e Seção Judiciária do período de 2008 a 2014.</div>
            </div>

            <div class="row report">
                <ul style="width: 100%;">
                    <li class="titulo" style="display: inline-block; width: 120px;">Por Vara</li>
                    <li class="arrow-down up"><img src="templates/portalTRF5/images/arrow_down_2.svg"></li>
                </ul>
            </div>
            <div class="row botoes w100 pt-3" style="display: none;">
                <div class="subtitulo">Processos distribuídos, julgados, arquivados e em tramitação na 5ª Região - 2008 a 2014
                </div>
            
                <?php 
                foreach (getAnexosVara($list['varas']) as $dado):
                    echo "<a style='width: calc(25% - 10px);text-align: center;text-decoration: none;' class='box box-col-4' 
                        href='/joomla/index.php/gestao-orcamentaria/resultado-pdf?/id=".$dado['id']."&MOD=SV38&niveis=".urlencode("PROCESSOS E CONSULTAS/ESTATÍSTICAS/PRIMEIRO GRAU/MOVIMENTAÇÃO PROCESSUAL - 2008-2014/Processos distribuídos, julgados, arquivados e em tramitação na 5ª Região - 2008 a 2014/Por Vara/".$dado['vara'])."'>
                        ".$dado['vara']."
                        </a>";
                endforeach; 
                ?>
                
                <div class="clearfix"></div>
            </div>                                                                   
            <div class="row report">
                <ul style="width: 100%;">
                    <li class="titulo" style="display: inline-block; width: 120px;">Por Tipo</li>
                    <li class="arrow-down up"><img src="templates/portalTRF5/images/arrow_down_2.svg"></li>
                </ul>
            </div>
            <div class="row botoes w100 pt-3" style="display: none;">
                <div class="subtitulo">Processos distribuídos, julgados, arquivados e em tramitação na 5ª Região - 2008 a 2014</div>

                <?php 
                foreach (getAnexosTipo($list['varas']) as $dado):
                    echo "<a style='width: calc(25% - 10px);;text-align: center;text-decoration: none;' class='box box-col-4' 
                        href='/joomla/index.php/gestao-orcamentaria/resultado-pdf?/id=".$dado['id']."&MOD=SV38&niveis=".urlencode("PROCESSOS E CONSULTAS/ESTATÍSTICAS/PRIMEIRO GRAU/MOVIMENTAÇÃO PROCESSUAL - 2008-2014/Processos distribuídos, julgados, arquivados e em tramitação na 5ª Região - 2008 a 2014/Por Tipo/".$dado['vara'])."'>
                        ".$dado['vara']."
                        </a>";
                endforeach; 
                ?>
                
                <div class="clearfix"></div>
            </div>                                                                   
            <div class="row report">
                <ul style="width: 100%;">
                    <li class="titulo" style="display: inline-block; width: 120px;">Por Seções</li>
                    <li class="arrow-down up"><img src="templates/portalTRF5/images/arrow_down_2.svg"></li>
                </ul>
            </div>
            <div class="row botoes w100 pt-3" style="display: none;">
                <div class="subtitulo">Estatísticas Totais Gerais - 2008 a 2014</div><br>
                <div class="subtitulo">Resumo da 5ª Região - Processos distribuídos, julgados, arquivados e em tramitação</div>
            
                <?php 
                foreach (getAnexosSecoesTotais($list['secoes']) as $dado):
                    echo "<a style='width: calc(25% - 10px);text-align: center;text-decoration: none;' class='box box-col-4' 
                        href='/joomla/index.php/gestao-orcamentaria/resultado-pdf?/id=".$dado['id']."&MOD=SV39&niveis=".urlencode("PROCESSOS E CONSULTAS/ESTATÍSTICAS/PRIMEIRO GRAU/MOVIMENTAÇÃO PROCESSUAL - 2008-2014/Estatísticas Totais Gerais - 2008 a 2014/Resumo da 5ª Região - Processos distribuídos, julgados, arquivados e em tramitação/".renomearDescricao($dado['descricao']))."'>
                        ".renomearDescricao($dado['descricao'])."
                        </a>";
                endforeach; 
                ?>
                
                <div class="clearfix"></div><br><br>

                <div class="row"></div>
                <div class="subtitulo">Gráficos - 2008 a 2014</div><br>
                <div class="subtitulo">Resumo da 5ª Região - Gráficos de Processos</div>
                
                <?php 
                foreach (getAnexosSecoesGraficos($list['secoes']) as $dado):
                    echo "<a style='width: calc(25% - 10px);text-align: center;text-decoration: none;' class='box box-col-4' 
                        href='/joomla/index.php/gestao-orcamentaria/resultado-pdf?/id=".$dado['id']."&MOD=SV39&niveis=".urlencode("PROCESSOS E CONSULTAS/ESTATÍSTICAS/PRIMEIRO GRAU/MOVIMENTAÇÃO PROCESSUAL - 2008-2014/Gráficos - 2008 a 2014/Resumo da 5ª Região - Gráficos de Processos/".renomearDescricao($dado['descricao']))."'>
                        ".renomearDescricao($dado['descricao'])."
                        </a>";
                endforeach; 
                ?>
                
                <div class="clearfix"></div>
            </div>                           
      </div>
    </div>
</div>