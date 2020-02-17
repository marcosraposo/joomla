<?php defined('_JEXEC') or die;

/*
$ano = 0;
foreach($dados['lista']['return'] as $list){
$horarioAno = explode("/",$list['nrCotacaoEletronica']);
	if($ano != $horarioAno[1]){
		$ano = $horarioAno[1];
		foreach($dados['lista']['return'] as $listDados){
		$horarioAno2 = explode("/",$listDados['nrCotacaoEletronica']);
		if($horarioAno2[1] == $horarioAno[1]){
			echo "<br>";
			echo $listDados['nrCotacaoEletronica'];
			echo $listDados['dataAbertura'];
			echo $listDados['horarioAbertura'];
			echo $listDados['descrCao'];
			}
		}
	}
}
*/

 ?>

<div class="container demonstrativo bg_azul_fundo">
    <div class="row">
        <div class="col-md-6 aba selecionado" data-aba="1">
            <div><?= $dados['dados']['titulo_tab_1'] ?></div>
        </div>
        <div class="col-md-6 aba" data-aba="2">
            <div><?= $dados['dados']['titulo_tab_2'] ?></div>
        </div>
    </div>
    <div class="row conteudo selecionado" data-aba-id="1">
        <div class="col-12">
            <div class="row">
                <div class="titulo"><?= $dados['dados']['titulo_box_1'] ?></div>
            </div>
            <div class="row">
                <small>Última atualização: <?php echo date('d/m/Y'); ?></small>
            </div>
		<?php
		$ano = 0;
		foreach($dados['lista']['return'] as $list):
		$horarioAno = explode("/",$list['nrCotacaoEletronica']);
			if($ano != $horarioAno[1]):
				$ano = $horarioAno[1];
				?>
			<div class="row report">
                <ul>
                    <li class="titulo"><?php echo $horarioAno[1];?></li>
                    <li class="arrow-down"><img src="templates/portalTRF5/images/arrow_down_2.svg"></li>
                </ul>
            </div>
            <div class="row botoes w100">
                <div class="download">
                    <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                    PDF
                </div>
                <div class="download">
                    <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                    XML
                </div>
                <div class="download">
                    <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                    CSV
                </div>
                <div class="download">
                    <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
                    IMPRIMIR
                </div>
                <div class="clearfix"></div>
                <div class="spacer"></div>
                <div class="spacer"></div>
                <table>
				
				<tr onclick="window.location.href='RESULTADO-IMAGEM.html'">
                        <th>Cotação Eletrônica Nº</th>
                        <th>Descrição</th>
                        <th>Data de Abertura</th>
                        <th>Horário de Abertura</th>
                </tr>
			<?php	
			foreach($dados['lista']['return'] as $listDados):
			$horarioAno2 = explode("/",$listDados['nrCotacaoEletronica']);
				if($horarioAno2[1] == $horarioAno[1]):
				?>
				<tr>
                        <td><?php echo $listDados['nrCotacaoEletronica'];?></td>
                        <td><?php echo $listDados['descrCao'];?></td>
                        <td><?php echo $listDados['dataAbertura'];?> </td>
						<td><?php echo $listDados['horarioAbertura'];?></td>
                </tr>
				<?php	endif; 
				endforeach;?>	
				   </table>
                <div class="clearfix"></div>
            </div>
		<?php	endif; 
		endforeach;?>	
			
        </div>
    </div>
     <div class="row conteudo" data-aba-id="2">
        <div class="col-12">
            <div class="row">
                <div class="titulo"><?= $dados['dados']['titulo_box_2'] ?></div>
            </div>
            <div class="row">
                <small>Última atualização: <?php echo date('d/m/Y'); ?></small>
            </div>
<?php
		$ano = 0;
		foreach($dados['listaInfo']['return'] as $list):
		$horarioAno = explode("/",$list['nrCotacaoEletronica']);
			if($ano != $horarioAno[1]):
				$ano = $horarioAno[1];
				?>
			<div class="row report">
                <ul>
                    <li class="titulo"><?php echo $horarioAno[1];?></li>
                    <li class="arrow-down"><img src="templates/portalTRF5/images/arrow_down_2.svg"></li>
                </ul>
            </div>
            <div class="row botoes w100">
                <div class="download">
                    <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                    PDF
                </div>
                <div class="download">
                    <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                    XML
                </div>
                <div class="download">
                    <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                    CSV
                </div>
                <div class="download">
                    <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
                    IMPRIMIR
                </div>
                <div class="clearfix"></div>
                <div class="spacer"></div>
                <div class="spacer"></div>
                <table>
                    <tr>
                        <th>Cotação Eletrônica Nº</th>
                        <th>Documentos Complementares</th>
                        <th>Descrição Resumida do Objeto</th>
					</tr>
			<?php	
			foreach($dados['listaInfo']['return'] as $listDados):
			$horarioAno2 = explode("/",$listDados['nrCotacaoEletronica']);
				if($horarioAno2[1] == $horarioAno[1]):
				?>
				<tr>
                        <td><?php echo $listDados['nrCotacaoEletronica'];?></td>
                        <td><?php echo $listDados['contemAnexo'];?></td>
                        <td><?php echo $listDados['resumoObjeto'];?> </td>
                </tr>		
				<?php	endif; 
				endforeach;?>	
				   </table>
                <div class="clearfix"></div>
            </div>
		<?php	endif; 
		endforeach;?>	
        </div>
    </div>
</div>







