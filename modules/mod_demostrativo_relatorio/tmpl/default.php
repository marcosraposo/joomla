<?php defined('_JEXEC') or die;
$WService = $dados['dados']['url_webservice'];

	function getDataAtualizacao($array){
		$dataAtualizacao = new DateTime();

		if(is_array($array) && !empty($array)){
			for ($i = 0; $i < count($array); $i++) {
				$relatorio = $array[$i];
				if($i==0){
					$dataAtualizacao = DateTime::createFromFormat('d/m/Y', $relatorio['dataAtualizacao']);
				}else{
					$dataTemp = DateTime::createFromFormat('d/m/Y', $relatorio['dataAtualizacao']);
					if($dataTemp > $dataAtualizacao){
						$dataAtualizacao = $dataTemp;
					}
				}
			}
		}

		$dataAtualizacao = $dataAtualizacao->format('d/m/Y');
		return $dataAtualizacao;
	}

	function getAnos($array){
		$anos = array();
		foreach ($array as $registro) {
			$ano = $registro['ano'];
			if(!in_array($ano, $anos)){
				array_push($anos, $ano);
			}
		}
		rsort($anos);
		return $anos;
	}

	function getAnosDescricao($list, $ano){
		$listDesc = array();
		foreach ($list as $registro) {
			if($registro['ano'] == $ano){
				$desc = explode("-", $registro['descricao']);
				$descricao = trim($desc[1]);
				if(!in_array($ano."-".$descricao, $listDesc)){
					array_push($listDesc, $ano."-".$descricao);
				}
			}
		}
		sort($listDesc);
		return $listDesc;
	}

	function getDadosAnoDesc($list, $desc){
		$listAnoDesc = array();
		$anoDesc = explode("-", $desc);
		$ano = $anoDesc[0]; //ano
		$descricao = $anoDesc[1]; //descricao
        foreach ($list as $registro) {
			if($registro['ano'] == $ano){
				$regDesc = explode("-", $registro['descricao']);
				$regDescricao = trim($regDesc[1]);
				if($descricao == $regDescricao){
					array_push($listAnoDesc, $registro);
				}
            }
        }
        return $listAnoDesc;
	}

?>

<div class="spacer"></div>
<div class="spacer"></div>
<div class="container demonstrativo bg_azul_fundo">
    <div class="row">
        <div class="col-md-6 aba selecionado" data-aba="1">
            <div><a class="textoSemSublinhado" href="#container">Demonstrativos</a></div>
        </div>
        <div class="col-md-6 aba" data-aba="2">
            <div><a class="textoSemSublinhado" href="#container">Relatórios</a></div>
        </div>
    </div>
</div>


<div class="container demonstrativo bg_azul_fundo">
    <div class="row conteudo" data-aba-id="2">
        <div class="col-12">

<?php

function detalhamentoRelatorio2($divisao, $botaoResultado, $anoMes){
	$botao = "";
	$botao .= "
		<div class='row botoes2' style='display: none' id='".$anoMes."'> 
			<ul>
				$botaoResultado 
			</ul>    
			<div class='clearfix'></div>                         
		</div>
		";
	return $botao;
}

foreach($dados['distribuicaoOrcamentaria'] as $list){
	echo "	<div class='row'>
		<div class='titulo'>".$list['descricao']."</div>
	</div>
	<div class='row'>
               <small>Última atualização: ".getDataAtualizacao($list['relatorio'])."</small>                
        </div> 
";

	if(strtoupper(trim($list['descricao'])) ==  "FISCAL"){
		$arrayAnos = getAnos($list['relatorio']);
		$listAnoDesc = array();
		foreach ($arrayAnos as $ano) {
			array_push($listAnoDesc, getAnosDescricao($list['relatorio'], $ano));   
		}
		
		$listRelatorios = array();
		foreach ($listAnoDesc as $anoDesc){
			foreach ($anoDesc as $desc){
				array_push($listRelatorios, getDadosAnoDesc($list['relatorio'], $desc));   
			}
		}

		$anoTemp = "";
		$conjBotoes = "";
		$index = 0;
		$botao = "";
		//Montando os anos
		foreach ($listRelatorios as $ano) {
			if(is_array($ano)){
				if($anoTemp != $ano[0]['ano']){
					$anoTemp = $ano[0]['ano'];
					/*Se o ano for diferente e o index maior que zero, deve-se fechar a lista anterior
					para começar uma nova, referente ao novo ano. */
					if($index > 0){
						echo "</ul></div>";
						echo $conjBotoes;
						$conjBotoes = "";
					}
					$index++;
					echo "<div class='row report'>
						<ul>";
					echo "<li>".$anoTemp."</li>";
				}

				$descTemp = "";
				//Montando as descricoes por ano.
				$botao = "";
				$index2 = 1;
				foreach ($ano as $desc){
					if(is_array($desc)){
						$arrayDesc = explode("-", $desc['descricao']);
						$descricao = trim($arrayDesc[1]); //desc
						if($descTemp != $descricao){
							$descTemp = $descricao;
							echo "<li onClick=javascript:exibirBotaoRelatorio('".$anoTemp."-".(explode("º", $descTemp)[0])."');>".$descTemp."</li>";
						}
						$id = $anoTemp."-".(explode("º", $descTemp)[0]);
						$botao .= "<li><a href='#conteudo' class='box' onClick=window.location.href='../gestao-orcamentaria/resultado-pdf?/id=".$desc['id']."&MOD=SV18&niveis=".urlencode("GESTÃO ORÇAMENTÁRIA/GESTÃO - DEMONSTRATIVOS E RELATÓRIOS/RELATÓRIOS/".$list['descricao']."/".$anoTemp."/".trim($arrayDesc[1]))."'>".$index2." - ".trim($arrayDesc[0])."</a></li>";
						$index2++;
					}
				}
				$conjBotoes .= detalhamentoRelatorio2("", $botao, $id );
			}
		}
		echo "</ul></div>";
		echo $conjBotoes;

	}else{
		$anoTemp = "";
		foreach($list as $relatorio){
			if(is_array($relatorio)){
				for ($i=0; $i <= count($relatorio)-1; $i++) { 
					$listaRelatorio = $relatorio[$i];

					if($anoTemp != $listaRelatorio['ano']){
						if($i > 0){
							echo "</ul></div>";
						}
						$anoTemp = $listaRelatorio['ano'];
						echo "<div class='row'>
							<ul>";
						echo "<li>".$anoTemp."</li>";
					}
					?>
						<li><a href="#conteudo " class="textoSemSublinhado" onClick="window.location.href='../gestao-orcamentaria/resultado-pdf?/id=<?php echo $listaRelatorio['id']; ?>&MOD=SV18&niveis=<?php echo urlencode("GESTÃO ORÇAMENTÁRIA/GESTÃO - DEMONSTRATIVOS E RELATÓRIOS/RELATÓRIOS/".$list['descricao']."/".$listaRelatorio['ano'])?>'"><?php echo $listaRelatorio['descricao'];?></a></li>
					<?php
				}
				echo "</ul></div>";
			}
		}
	}
}
?>
     </div>
</div>
    
    <div class="row conteudo selecionado" data-aba-id="1">
	
	<div id="posiciona2" style="display:none;"> 
		<div id="fechar" style="display: flex; justify-content: space-between;">
			<div align=left>
				<h5>Identificação necessária</h5>
			</div>
			<div align=rigth>
				<a href="javascript:fechar();">FECHAR</a>
			</div>
		</div> 
	
	<input type="hidden" id="idDocumento" >
		<div style="padding:10px; color: #5776B0;">
		
		Nome:<input class="form-control" placeholder="" type="text" id="nomeConsulta"  maxlength="50">

		<br />Tipo de Documento:
		<select name="tipoDocumento" id="tipoDocumentoConsulta" class="form-control" placeholder="">
			<option value=""></option>
			<option value="CPF">Cadastro de Pessoas Físicas (CPF)</option>
			<option value="CNH">Carteira Nacional de Habilitação (CNH)</option>
			<option value="RG">Registro Geral de Identidade Civil (RG)</option>
			<option value="TITULO_ELEITOR">Título de Eleitor</option>
	    </select>
		
		<br />Número Documento:<input class="form-control numeroDocumento" placeholder="" type="text" id="numeroDocumentoConsulta"  maxlength="14">
		<div id="resultadoConsulta"></div>

		<br /><input class="form-control" value="Acessar" placeholder="Consultar por" type="submit" onClick="javascript:salvarDadosConsultaOrcamentaria()">

		</div>
	</div>

        <div class="col-12">
            <div class="row boxes">
                <a  href="#container" class="box textoSemSublinhado selecionado" onclick="exibirSecaoDemostrativoOrcamentario('trf5','<?php echo $WService; ?>')">TRF5</a>
                <a  href="#container" class="box textoSemSublinhado" onclick="exibirSecaoDemostrativoOrcamentario('jfal','<?php echo $WService; ?>')">Alagoas</a>
                <a  href="#container" class="box textoSemSublinhado"  onclick="exibirSecaoDemostrativoOrcamentario('jfce','<?php echo $WService; ?>')">Ceará</a>
                <a  href="#container" class="box textoSemSublinhado"  onclick="exibirSecaoDemostrativoOrcamentario('jfpb','<?php echo $WService; ?>')">Paraíba</a>
                <a  href="#container" class="box textoSemSublinhado"  onclick="exibirSecaoDemostrativoOrcamentario('jfpe','<?php echo $WService; ?>')">Pernambuco</a>
                <a  href="#container" class="box textoSemSublinhado"  onclick="exibirSecaoDemostrativoOrcamentario('jfrn','<?php echo $WService; ?>')">Rio Grande do Norte</a>
                <a  href="#container" class="box textoSemSublinhado"  onclick="exibirSecaoDemostrativoOrcamentario('jfse','<?php echo $WService; ?>')">Sergipe</a>
                <div class="clearfix"></div>
            </div>  
	    <div style="display:none;">
		<input type="text" id="WService" value="<?php echo $WService; ?>"/>
		<input type="text" id="idMesOcultar" value="vazio"/>
	    </div>
	    <div  id="resultado"></div>
    </div>             
    </div>
</div>
