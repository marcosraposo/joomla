<?php 
defined('_JEXEC') or die;

//Data de atualizacao utiliza o campo Data de Publicacao
//Caso não tenha nenhum artigo publicado, utilizará a data atual;
$dataAtualizacao = new DateTime();
if (isset($list[0]->publish_up) && !empty($list[0]->publish_up)) {
    $dataAtualizacao = new DateTime($list[0]->publish_up);
}
$dataAtualizacao = $dataAtualizacao->format('d/m/Y');

//Percorrerá a lista de Valores e juntara o texto em html que sera exibido mais abaixo.
$textoExibicao = "";
foreach ($list as $valores) :
    $texto = str_replace("<p>", "", $valores->introtext);
    $texto = str_replace("</p>", "", $texto);

    $textoExibicao .= $texto;
endforeach;

//Recebe o cabeçalho da tabela que foi informado como parametro no modulo.
$cabecalhoTabela = $params->get('tabletitle');
$cabecalhoTabela = str_replace("<p>", "", $cabecalhoTabela);
$cabecalhoTabela = str_replace("</p>", "", $cabecalhoTabela);

//Recebe o rodape da pagina que foi informado como parametro no modulo.
$rodape = $params->get('footer');
$rodape = str_replace("<p>", "", $rodape);
$rodape = str_replace("</p>", "", $rodape);
?>

<div class="container demonstrativo bg_azul_fundo">
    <div class="row conteudo selecionado">
        <div class="col-12">
            <div class="row">
                <div class="titulo">Valores da Gratificação por Encargo de Curso ou Concurso</div>
            </div>
            <div class="row">
                <small>Última atualização: <?= $dataAtualizacao ?></small>
            </div>
             <div class="spacer"></div>
            <div class="spacer"></div>
            <div class="row botoes w100" style="display:block">
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF('valores');">
                    <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                    PDF
                </a>
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('valores', 'xml');">
                    <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                    XML
                </a>
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('valores', 'csv');">
                    <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                    CSV
                </a>
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('tabela_export_valores', 'export', '', this);">
                    <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
                    IMPRIMIR
                </a>
                <div class="clearfix"></div>
                <div class="spacer"></div>
                <div class="spacer"></div>
                
                <div class="spacer"></div>
                <table id="tabela_valores">
                    <thead>
                        <tr>
                            <?php echo html_entity_decode($cabecalhoTabela); ?>
                        </tr>
                    </thead>
                    <?php echo html_entity_decode($textoExibicao); ?>
                </table>
                <div class="clearfix"></div>
                <div class="spacer"></div>
                <div class="clearfix"></div>
                <div class="spacer"></div>

                <?php echo html_entity_decode($rodape); ?>

                <?php 
                //Aqui conteém o HTML que vai ser trandormado em PDF.
                $htmlPDF = "<h3>Valores da Gratificação por Encargo de Curso ou Concurso</h3>";
                $htmlPDF .= "<table border=1 id='tabela_valores' cellspacing=0>
                                <tr>" . html_entity_decode($cabecalhoTabela) . "</tr>"
                    . html_entity_decode($textoExibicao);
                $htmlPDF = str_replace("<br />", "", $htmlPDF);
                $htmlPDF .= "</table>";
                $htmlPDF .= "<br><br>" . html_entity_decode($rodape);
                ?>
                <div style="display:none;"><input id="table_valores" type="text" value="<?php echo urlencode($htmlPDF); ?>" /></div>
                <div style="display:none;" id="tabela_export_valores"><?php echo $htmlPDF; ?></div>
            </div>
        </div>
    </div>
</div> 