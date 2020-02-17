<?php defined('_JEXEC') or die; 
	function getDataAtualizacao($array){
		$dataAtualizacao = new DateTime();
		if(is_array($array) && !empty($array)){
			$first = true;
			foreach ($array['anos'] as $ano) {
				for ($i = 0; $i < count($ano['meses']); $i++) {
					$mes = $ano['meses'][$i];
					if($mes['exibe']){
						if($first){
							$dataAtualizacao = DateTime::createFromFormat('d/m/Y', $mes['dataAtualizacao']);
							$first = false;
						}else{
							$dataTemp = DateTime::createFromFormat('d/m/Y', $mes['dataAtualizacao']);
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
	function getMeses($meses) {
		$retorno = array();
		for ($i = 0; $i < count($meses); $i++) { 
			if(is_array($meses[$i])){
				array_push($retorno, $meses[$i]);
			}
		}
		return $retorno;
	}
	function getDados($meses) {
		$anos  = array();
		$dados = array();
		$meses = getMeses($meses);
		foreach($meses as $mes) {
			$ano = $mes['ano'];
			if(!in_array($ano, $anos)) {
				array_push($anos, $ano);
			}
		}
		foreach($anos as $ano) {
			$arrayAnos = array();
			foreach($meses as $mes) {
				$anoMes = $mes['ano'];
				if ($anoMes === $ano) {
					array_push($arrayAnos, $mes['meses']);
				}
			}
			array_push($dados, array(
				"ano" => $ano,
				"meses" => $arrayAnos
			));
		}
		return $dados;
	}
	function retiraBarras($string){
		$string = str_replace("/", "&#47;", $string);
		return $string;
	}
	
$lista = null;
if(empty($list['limitacaoEmpenho']['anos'][0])){
	$lista['limitacaoEmpenho']['anos'][0] = $list['limitacaoEmpenho']['anos'];
}else{
	$lista['limitacaoEmpenho']['anos'] = $list['limitacaoEmpenho']['anos'];
}																			?>
<div style="display:none;">
	<input type="text" id="idMesOcultar" value="vazio"/>
</div>
<div class="container demonstrativo bg_azul_fundo">
	<div class="row conteudo selecionado">
		<div class="col-12">
			<div class="row">
				<div class="titulo">CJF - Limitação de Empenho e Movimentação Financeira</div>
			</div>
			<div class="row">
				<small>Última atualização: <?php echo getDataAtualizacao($lista['limitacaoEmpenho'])?></small>
			</div>
<?php	
	foreach(getDados($lista['limitacaoEmpenho']['anos']) as $dado){
                $liAno = "";
                $liMes = "";
                $tabelasRow = "";
                $liAno .= "<li>".$dado['ano']."</li>";
				foreach($dado['meses'] as $mes): 
                    $liMes .= "<a href='#conteudo' style=' padding-right: 1.0em; color:#5776b0' onClick=javascript:exibirBotaoRelatorio('".$dado['ano']."-".$mes[0]['descricaoMes']."');>".$mes[0]['descricaoMes']."</a>";
                    $tabelasRow .= "<div class='row botoes2 w100' style='display: none;' id=".$dado['ano']."-".$mes[0]['descricaoMes'].">";
					$anexo = $mes[0]['anexo'];
					$tabelasRow .= "<a style='width: 60%;text-align: center;text-decoration: none;' class='box box-col-3' href='../gestao-orcamentaria/resultado-pdf?/id=".$anexo['id']."&MOD=SV21&niveis=".urlencode("GESTÃO ORÇAMENTÁRIA/LIMITAÇÃO DE EMPENHO E MOVIMENTAÇÃO FINANCEIRA/".$dado['ano']."/".$mes[0]['descricaoMes']."/".retiraBarras($anexo['descricao']))."'>";
					$tabelasRow .= $anexo['descricao']."</a>";
                    $tabelasRow .="</div><div class='space'></div><div class='clearfix'></div>";
                endforeach;    													?>
                <div class="row report">
                    <ul>
<?=					$liAno														?>
<?=					$liMes														?>
                    </ul>
                </div>
<?php 				echo $tabelasRow; 
            };   																?>
		</div>
	</div>

</div>
