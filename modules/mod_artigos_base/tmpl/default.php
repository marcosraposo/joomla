<?php 
defined('_JEXEC') or die;

require_once('funcoes.php');

$listArticlesByCategory = array();
foreach ($params->get('catid') as $idCategory) {
    array_push($listArticlesByCategory, getListArticleCategory($list, $idCategory));
}

//recebe o título das Abas
$titlesTabs = $params->get('titleTabs');
$pos = strripos($titlesTabs, "|");
$listTabs = array();
if (!($pos === false)) {
    $listTabs = explode('|', $titlesTabs, 3);
}

$totalTabs = 0;
$listTitles = array();
//recebe o título da pagina
$titles = $params->get('title');
$pos = strripos($titles, "|");
if ($pos === false) {
    $titulo = $titles;
} else {
    $listTitles = explode('|', $titles, 3);
    $totalTabs = count($listTitles);
}

//Recebe o subtitle que foi informado como parametro no modulo.
$subtitle = $params->get('subtitle');
$subtitle = str_replace("<p>", "", $subtitle);
$subtitle = str_replace("</p>", "", $subtitle);

//Recebe o rodape da pagina que foi informado como parametro no modulo.
$rodape = $params->get('footer');
$rodape = str_replace("<p>", "", $rodape);
$rodape = str_replace("</p>", "", $rodape);

//Recebe o parametro se é ou não para exibir as opções de download.
$exibirOpcao = $params->get('radiooption');
$exibirData = $params->get('radioData');


?>
<?php if ($totalTabs == 0) { ?>
<div class="container demonstrativo bg_azul_fundo">
    <div class="row conteudo selecionado">
        <div class="col-12">
            <div class="row">
                <div class="titulo"><?= $titulo ?></div>
            </div>
            <div class="row">
                <?php  if($exibirData == null || $exibirData == 1){ echo "<small>Última atualização:".getDataAtualizacao($list); } ?></small>
            </div>
            <div class="spacer"></div>

            <?php if ($exibirOpcao == "1") { ?>
			
            <?php if(in_array($_SERVER['PATH_INFO'], array('/entrevistas-juridicas') )): ?>
			<a href="#conteudo" role="button" class="download" onClick="javascript:gerarPDFGrande('<?php echo $list[0]->id;?>')">
                <div class=" icone"><img src="templates/portalTRF5/images/download.svg">
                </div>
                PDF
            </a>
			<?php else: ?>
			<a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF('export')">
                <div class=" icone"><img src="templates/portalTRF5/images/download.svg">
                </div>
                PDF
            </a>
			<?php endif; ?>
			
            <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('export', 'export', '<?= $titulo ?>', this)">
                <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
                IMPRIMIR
            </a>
			
			
         <?php } ?>

            <div class="clearfix"></div>
            <div class="spacer"></div>

            <?php if (!empty($subtitle)) {

                echo html_entity_decode($subtitle); ?>

            <div class="clearfix"></div>
            <div class="spacer"></div>
            <?php

        }

        echo html_entity_decode(getTextoExibicao($list));

        ?>
            <?php 
            $htmlPDF = "<h3>" . $titulo . "</h3>";
            $htmlPDF .= (!empty($subtitle)) ? html_entity_decode($subtitle) . "<br><br>" : "";
            $htmlPDF .= str_replace("<br>", " ", html_entity_decode(getTextoExibicao($list)));
            $htmlPDF = str_replace("<table", "<table border='1'", $htmlPDF);
            $htmlPDF .= "</table>";
            $htmlPDF .= (!empty($rodape)) ? "<br><br>" . html_entity_decode($rodape) : "";
            ?>
            <div style="display:none;"><input id="table_export" type="text" value="<?php echo urlencode($htmlPDF); ?>" /></div>
            <div style="display:none;" id="export"><?php echo $htmlPDF ?></div>

            <div class="clearfix"></div>
            <div class="spacer"></div>

            <?php echo html_entity_decode($rodape); ?>
        </div>

    </div>
</div>
<?php 
} elseif ($totalTabs == 2) { ?>
<div class="container demonstrativo bg_azul_fundo">
    <div class="row">
        <div class="col-md-6 aba selecionado" data-aba="1">
            <div><a class="textoSemSublinhado" href="#container"><?= $listTabs[0] ?></a></div>
        </div>
        <div class="col-md-6 aba" data-aba="2">
            <div><a class="textoSemSublinhado" href="#container"><?= $listTabs[1] ?></a></div>
        </div>
    </div>
    <div class="row conteudo selecionado" data-aba-id="1">
        <div class="col-12">
            <div class="row">
                <div class="titulo"><?= $listTitles[0] ?></div>
            </div>
            <div class="row">
                <?php  if($exibirData == null || $exibirData == 1){ echo "<small>Última atualização:".getDataAtualizacao($listArticlesByCategory[0]); } ?></small>
            </div>
            <div class="spacer"></div>
            <div class="<?php echo getClass(getTextoExibicao($listArticlesByCategory[0])); ?>" style="display:block">

                <?php if ($exibirOpcao == "1") { ?>
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF('export0')">
                    <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                    PDF
                </a>
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('export0', 'export', '<?= $listTitles[0] ?>', this)">
                    <div class=" icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
                    IMPRIMIR
                </a>
                <?php 
            } ?>

                <div class="clearfix"></div>
                <div class="spacer"></div>

                <?php if (!empty($subtitle)) {

                    echo html_entity_decode($subtitle); ?>

                <div class="clearfix"></div>
                <div class="spacer"></div>
                <?php

            }

            echo html_entity_decode(getTextoExibicao($listArticlesByCategory[0]));

            ?>

                <?php 
                $htmlPDF = "<h3>" . $listTitles[0] . "</h3>";
                $htmlPDF .= (!empty($subtitle)) ? html_entity_decode($subtitle) . "<br><br>" : "";
                $htmlPDF .= html_entity_decode(getTextoExibicao($listArticlesByCategory[0]));
                $htmlPDF = str_replace("<table", "<table border='1'", $htmlPDF);
                $htmlPDF .= "</table>";
                $htmlPDF .= (!empty($rodape)) ? "<br><br>" . html_entity_decode($rodape) : "";
                ?>
                <div style="display:none;"><input id="table_export0" type="text" value="<?php echo urlencode($htmlPDF); ?>" /></div>
                <div style="display:none;" id="export0"><?php echo $htmlPDF ?></div>

                <div class="clearfix"></div>
                <div class="spacer"></div>

                <?php echo html_entity_decode($rodape); ?>
            </div>
        </div>
    </div>
    <div class="row conteudo" data-aba-id="2">
        <div class="col-12">
            <div class="row">
                <div class="titulo"><?= $listTitles[1] ?></div>
            </div>
            <div class="row">
                <?php  if($exibirData == null || $exibirData == 1){ echo "<small>Última atualização:".getDataAtualizacao($listArticlesByCategory[1]); } ?></small>
            </div>
            <div class="spacer"></div>
            <div class="<?php echo getClass(getTextoExibicao($listArticlesByCategory[1])); ?>" style="display:block">

                <?php if ($exibirOpcao == "1") { ?>
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF('export1')">
                    <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                    PDF
                </a>
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('export1', 'export', '<?= $listTitles[1] ?>', this)">
                    <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
                    IMPRIMIR
                </a>
                <?php 
            } ?>

                <div class="clearfix"></div>
                <div class="spacer"></div>

                <?php if (!empty($subtitle)) {

                    echo html_entity_decode($subtitle); ?>

                <div class="clearfix"></div>
                <div class="spacer"></div>
                <?php

            }

            echo html_entity_decode(getTextoExibicao($listArticlesByCategory[1]));

            ?>

                <?php 
                $htmlPDF = "<h3>" . $listTitles[1] . "</h3>";
                $htmlPDF .= (!empty($subtitle)) ? html_entity_decode($subtitle) . "<br><br>" : "";
                $htmlPDF .= html_entity_decode(getTextoExibicao($listArticlesByCategory[1]));
                $htmlPDF = str_replace("<table", "<table border='1'", $htmlPDF);
                $htmlPDF .= "</table>";
                $htmlPDF .= (!empty($rodape)) ? "<br><br>" . html_entity_decode($rodape) : "";
                ?>
                <div style="display:none;"><input id="table_export1" type="text" value="<?php echo urlencode($htmlPDF); ?>" /></div>
                <div style="display:none;" id="export1"><?php echo $htmlPDF ?></div>


                <div class="clearfix"></div>
                <div class="spacer"></div>

                <?php echo html_entity_decode($rodape); ?>
            </div>
        </div>
    </div>
</div>
<?php 
} elseif ($totalTabs == 3) { ?>
<div class="container demonstrativo bg_azul_fundo">
    <div class="row">
        <div class="col-md-4 aba selecionado" data-aba="1">
            <div><a class="textoSemSublinhado" href="#container"><?= $listTabs[0] ?></a></div>
        </div>
        <div class="col-md-4 aba" data-aba="2">
            <div><a class="textoSemSublinhado" href="#container"><?= $listTabs[1] ?></a></div>
        </div>
        <div class="col-md-4 aba" data-aba="3">
            <div><a class="textoSemSublinhado" href="#container"><?= $listTabs[2] ?></a></div>
        </div>
    </div>
    <div class="row conteudo selecionado" data-aba-id="1">
        <div class="col-12">
            <div class="row">
                <div class="titulo"><?= $listTitles[0] ?></div>
            </div>
            <div class="row">
                <?php  if($exibirData == null || $exibirData == 1){ echo "<small>Última atualização:".getDataAtualizacao($listArticlesByCategory[0]);} ?></small>
            </div>
            <div class="spacer"></div>

            <?php if ($exibirOpcao == "1") { ?>
            <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF('export2')">
                <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                PDF
            </a>
            <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('export2', 'export', '<?= $listTitles[1] ?>', this)">
                <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
                IMPRIMIR
            </a>
            <?php 
        } ?>

            <div class="clearfix"></div>
            <div class="spacer"></div>

            <?php if (!empty($subtitle)) {

                echo html_entity_decode($subtitle); ?>

            <div class="clearfix"></div>
            <div class="spacer"></div>
            <?php 
        }
        ?>

            <?php echo html_entity_decode(getTextoExibicao($listArticlesByCategory[0])); ?>

            <?php 
            $htmlPDF = "<h3>" . $listTitles[0] . "</h3>";
            $htmlPDF .= (!empty($subtitle)) ? html_entity_decode($subtitle) . "<br><br>" : "";
            $htmlPDF .= html_entity_decode(getTextoExibicao($listArticlesByCategory[0]));
            $htmlPDF = str_replace("<table", "<table border='1'", $htmlPDF);
            $htmlPDF .= "</table>";
            $htmlPDF .= (!empty($rodape)) ? "<br><br>" . html_entity_decode($rodape) : "";
            ?>
            <div style="display:none;"><input id="table_export2" type="text" value="<?php echo urlencode($htmlPDF); ?>" /></div>
            <div style="display:none;" id="export2"><?php echo $htmlPDF ?></div>


            <div class="clearfix"></div>
            <div class="spacer"></div>

            <?php echo html_entity_decode($rodape); ?>

        </div>
    </div>
    <div class="row conteudo" data-aba-id="2">
        <div class="col-12">
            <div class="row">
                <div class="titulo"><?= $listTitles[1] ?></div>
            </div>
            <div class="row">
                <?php  if($exibirData == null || $exibirData == 1){ echo "<small>Última atualização:".getDataAtualizacao($listArticlesByCategory[1]); } ?></small>
            </div>
            <div class="spacer"></div>
            <div class="<?php echo getClass(getTextoExibicao($listArticlesByCategory[1])); ?>" style="display:block">

                <?php if ($exibirOpcao == "1") { ?>
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF('export3')">
                    <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                    PDF
                </a>
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('export3', 'export', '<?= $listTitles[1] ?>', this)">
                    <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
                    IMPRIMIR
                </a>
                <?php 
            } ?>

                <div class="clearfix"></div>
                <div class="spacer"></div>

                <?php if (!empty($subtitle)) {

                    echo html_entity_decode($subtitle); ?>

                <div class="clearfix"></div>
                <div class="spacer"></div>
                <?php 
            }
            ?>

                <?php echo html_entity_decode(getTextoExibicao($listArticlesByCategory[1])); ?>

                <?php 
                $htmlPDF = "<h3>" . $listTitles[1] . "</h3>";
                $htmlPDF .= (!empty($subtitle)) ? html_entity_decode($subtitle) . "<br><br>" : "";
                $htmlPDF .= html_entity_decode(getTextoExibicao($listArticlesByCategory[1]));
                $htmlPDF = str_replace("<table", "<table border='1'", $htmlPDF);
                $htmlPDF .= "</table>";
                $htmlPDF .= (!empty($rodape)) ? "<br><br>" . html_entity_decode($rodape) : "";
                ?>
                <div style="display:none;"><input id="table_export3" type="text" value="<?php echo urlencode($htmlPDF); ?>" /></div>
                <div style="display:none;" id="export3"><?php echo $htmlPDF ?></div>


                <div class="clearfix"></div>
                <div class="spacer"></div>

                <?php echo html_entity_decode($rodape); ?>
            </div>
        </div>
    </div>
    <div class="row conteudo" data-aba-id="3">
        <div class="col-12">
            <div class="row">
                <div class="titulo"><?= $listTitles[2] ?></div>
            </div>
            <div class="row">
                <?php  if($exibirData == null || $exibirData == 1){ echo "<small>Última atualização:".getDataAtualizacao($listArticlesByCategory[2]); } ?></small>
            </div>
            <div class="spacer"></div>
            <div class="<?php echo getClass(getTextoExibicao($listArticlesByCategory[2])); ?>" style="display:block">

                <?php if ($exibirOpcao == "1") { ?>
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF('export4')">
                    <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                    PDF
                </a>
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('export4', 'export', '<?= $listTitles[2]; ?>', this)">
                    <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
                    IMPRIMIR
                </a>
                <?php 
            } ?>

                <div class="clearfix"></div>
                <div class="spacer"></div>

                <?php if (!empty($subtitle)) {

                    echo html_entity_decode($subtitle); ?>

                <div class="clearfix"></div>
                <div class="spacer"></div>
                <?php 
            }
            ?>

                <?php echo html_entity_decode(getTextoExibicao($listArticlesByCategory[2])); ?>

                <?php 
                $htmlPDF = "<h3>" . $listTitles[2] . "</h3>";
                $htmlPDF .= (!empty($subtitle)) ? html_entity_decode($subtitle) . "<br><br>" : "";
                $htmlPDF .= html_entity_decode(getTextoExibicao($listArticlesByCategory[2]));
                $htmlPDF = str_replace("<table", "<table border='1'", $htmlPDF);
                $htmlPDF .= "</table>";
                $htmlPDF .= (!empty($rodape)) ? "<br><br>" . html_entity_decode($rodape) : "";
                ?>
                <div style="display:none;"><input id="table_export4" type="text" value="<?php echo urlencode($htmlPDF); ?>" /></div>
                <div style="display:none;" id="export4"><?php echo $htmlPDF ?></div>

                <div class="clearfix"></div>
                <div class="spacer"></div>

                <?php echo html_entity_decode($rodape); ?>
            </div>
        </div>
    </div>
</div>
<?php 
}
?> 