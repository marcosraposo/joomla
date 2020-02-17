<?php defined('_JEXEC') or die;
include_once 'func.php';

function getDataAtualizacao($array){
	$dataAtualizacao = new DateTime();

	if(is_array($array) && !empty($array)){
		for ($i = 0; $i < count($array); $i++) {
			$relatorio = $array[$i];
			if($i==0){
				$dataAtualizacao = DateTime::createFromFormat('d/m/Y', trim($relatorio['dataAtualizacao']));
			}else{
				$dataTemp = DateTime::createFromFormat('d/m/Y', trim($relatorio['dataAtualizacao']));
				if($dataTemp > $dataAtualizacao){
					$dataAtualizacao = $dataTemp;
				}
			}
		}
	}
	$dataAtualizacao = $dataAtualizacao->format('d/m/Y');
	return $dataAtualizacao;
}




$ordernar = false;
$i1 = 0;
foreach ($dados['listaBoletinsAdministrativos']['return'] as  $group) {
	$horarioAno2 = explode("/", $group['dataPublicacao']);
	if (!empty($horarioAno2[2])) {
		$ordernar = true;
		$dados['listaBoletinsAdministrativos']['return'][$i1]['anoPublicacao'] = $horarioAno2[2];
		$dados['listaBoletinsAdministrativos']['return'][$i1]['dataNumero'] = $horarioAno2[2].$horarioAno2[1].$horarioAno2[0];

	}
	$i1++;
}

if ($ordernar) {
	array_sort($dados['listaBoletinsAdministrativos']['return'], 'dataNumero', $order = SORT_DESC);
}

?>
 

 
<div class="container demonstrativo bg_azul_fundo">
    <div class="row conteudo selecionado" data-aba-id="1">
        <div class="col-12">
		<div class="row">
                <div class="titulo">Boletins Administrativos </div>
            </div>
            <div class="row">
                <small>Última atualização: <?php echo getDataAtualizacao($dados['listaBoletinsAdministrativos']['return']); ?></small>
            </div>
			<div class="row">
                <p>Atualmente dirigido pelo Des. Federal Rogério de Meneses Fialho Moreira, o Gabinete da Revista disponibiliza, periodicamente, o Boletim de Jurisprudência, a Revista de Jurisprudência e o Boletim Administrativo (substituído, a partir de dezembro/2011, pelo DJe do TRF5), que são publicações oficiais eletrônicas do TRF da 5ª Região. Além disso, o Gabinete é responsável pelo credenciamento dos Repositórios Oficiais de Jurisprudência do TRF da 5ª Região.</p>
            </div>
		<?php
		$ano = 0;
		foreach( $dados['listaBoletinsAdministrativos']['return'] as $list){
			if(!empty($list['dataPublicacao'])):
				$horarioAno = explode("/",$list['dataPublicacao']);
				if($ano != $horarioAno[2]):
					$ano = $horarioAno[2]; 				?>
			<div class="row report">
                <ul>
                    <li class="titulo"><?php echo $horarioAno[2];?></li>
                    <li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
                </ul>
            </div>
            <div class="row botoes w100">
                
                <div class="clearfix"></div>
                <div class="spacer"></div>
                <div class="spacer"></div>
                <table>
				<tr>
                        <th>Mês</th>
                        <th>Data</th>
                </tr>
			<?php	
			$dados['listaBoletinsAdministrativos']['return'] = array_sort($dados['listaBoletinsAdministrativos']['return'], 'dataNumero', $order = SORT_ASC);
			
			foreach($dados['listaBoletinsAdministrativos']['return'] as $listDados):
			if(!empty($listDados['dataPublicacao'])):
			$horarioAno2 = explode("/",$listDados['dataPublicacao']);

			
		
				if($horarioAno2[2] == $horarioAno[2]):
				?>
				<tr>
					<td>
						<a href="/joomla/index.php/gestao-orcamentaria/resultado-pdf?/id=<?php echo $listDados['id'] ;?>&MOD=SV27&niveis=<?php echo urlencode('REVISTA GABINETE/BOLETINS ADMINISTRATIVOS/'.$listDados['descricao'])?>"><?php echo $listDados['descricao'];?></a>
					</td>
                    <td><?php echo $listDados['dataPublicacao'];?></td>
					
                </tr>
				<?php	endif;
					endif;
				endforeach;?>	
				   </table>
                <div class="clearfix"></div>
            </div>
		<?php	endif; 
		endif;
		}?>	
        </div>
    </div>
</div>







