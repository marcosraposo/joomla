<?php 

$secao = $_GET['secao'];
$url_webservice = $_GET['sv'];

ini_set("soap.wsdl_cache_enabled", "0");
ini_set('soap.wsdl_cache_ttl', 900);
ini_set('default_socket_timeout', 15);
$client = new SoapClient($url_webservice);        			

function ajustarData($data){
	
	$data = trim($data);
	$pos = strpos($data, '-');
	if ($pos === false) {
		return $data;
	} else {
		$dataArray = explode(" ", $data);
		$dataArray = explode("-", $dataArray[0]);
		$dataAjustada = $dataArray[2]."/".$dataArray[1]."/".$dataArray[0];
		return $dataAjustada;
	}
}

function getDataAtualizacao($array){
	$dataAtualizacao = new DateTime();
	if(is_array($array) && !empty($array)){
		$first = true;
		foreach ($array as $ano) {
			for ($i = 0; $i < count($ano->meses); $i++) {
				if(is_array($ano->meses)){
					$mes = $ano->meses[$i];
				}else{
					$mes = $ano->meses;
				}
				if($mes->exibe){
					if($first){
						$dataAjustada = ajustarData($mes->dataAtualizacao);
						$dataAtualizacao = DateTime::createFromFormat('d/m/Y', $dataAjustada);
						$first = false;
					}else{
						$dataAjustada = ajustarData($mes->dataAtualizacao);
						$dataTemp = DateTime::createFromFormat('d/m/Y', $dataAjustada);
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

function getDescricaoSecao($secao){

	$descSecao = "";
	if(strcasecmp($secao, "TRF5") == 0){
		$descSecao = "TRIBUNAL REGIONAL DA 5ª REGIÃO";
	}elseif (strcasecmp($secao, "Alagoas") == 0) {
		$descSecao = "JUSTIÇA FEDERAL EM ALAGOAS";
	}elseif (strcasecmp($secao, "Ceará") == 0) {
		$descSecao = "JUSTIÇA FEDERAL NO CEARÁ";
	}elseif (strcasecmp($secao, "Paraíba") == 0) {
		$descSecao = "JUSTIÇA FEDERAL NA PARAÍBA";
	}elseif (strcasecmp($secao, "Pernambuco") == 0) {
		$descSecao = "JUSTIÇA FEDERAL EM PERNAMBUCO";
	}elseif (strcasecmp($secao, "Rio Grande do Norte") == 0) {
		$descSecao = "JUSTIÇA FEDERAL NO RIO GRANDE DO NORTE";
	}elseif (strcasecmp($secao, "Sergipe") == 0) {
		$descSecao = "JUSTIÇA FEDERAL EM SERGIPE";
	}

	return $descSecao;
}

function retiraBarras($string){
	$string = str_replace("/", "&#47;", $string);
	return $string;
}

function detalhamentoRelatorio($divisao, $botaoResultado, $anoMes){
	$botao = "";
	if( strpos( $divisao, "FINA" )){
		$botao .= "
			<div class='row botoes2' style='display: none' id='".$anoMes."'> 
				<ul>
				    $botaoResultado 
				</ul>    
				<div class='clearfix'></div>                         
			</div>
			";
	}
	if( strpos( $divisao, "REMU" )){
		$botao .= "
			<div class='row botoes2' style='display: none' id='".$anoMes."'> 
				<ul>
				    $botaoResultado
				</ul>    
				<div class='clearfix'></div>                         
			</div>
			";
	}

	if( strpos( $divisao, "CARGOS" )){
		$botao .= "
			<div class='row botoes2' style='display: none' id='".$anoMes."'> 
				<ul>
				    $botaoResultado
				</ul>    
				<div class='clearfix'></div>                         
			</div>
			";
	}
	
	if( strpos( $divisao, "DETALHA" )){
		$botao .= "
			<div class='row botoes2' style='display: none' id='".$anoMes."'> 
				<ul>
				    $botaoResultado
				</ul>    
				<div class='clearfix'></div>                         
			</div>
			";
	}
	
	return $botao;
}

$arguments = array('getDemonstrativoGestaoOrcamentaria' => array('arg0' => $secao));
$demonstrativoGestaoOrcamentaria = $client->__soapCall("getDemonstrativoGestaoOrcamentaria", $arguments ); 

$listaIdElementos = array();

foreach($demonstrativoGestaoOrcamentaria->return as $list){
	if(!empty($list->demonstrativo)){
		foreach($list->demonstrativo as $lista){
			if(is_array($lista) ){
				$contadorDivisao = 0;
				foreach($lista as $listb){
					if(!empty($listb)){
						$contadorDivisao++;
						echo "	<div class='row'>
						<div class='titulo'>".$listb->descricao."</div>                
						</div>   
							<div class='row'>
								<small>Última atualização: ".getDataAtualizacao($listb->anos)."</small>                
							</div>";
						$anoDesc = "";	
						foreach ($listb as $listBano){
							if(is_array($listBano)){
								foreach ($listBano as $anoTemp) {
									$anoDesc = $anoTemp->ano;
									echo "<div class='row report'>
									<ul id='nav'>";
									echo "<li>".$anoTemp->ano."</li>";
									$conjBotoes = "";
									$mesRepetido = "";
									if(is_object($anoTemp->meses)){
										$listBanoMes = $anoTemp->meses;
										if($listBanoMes->descricaoMes != $mesRepetido){
											$mesRepetido = $listBanoMes->descricaoMes;
											$idAnoMes = $anoTemp->ano.$listBanoMes->descricaoMes;
											if($listBanoMes->visaoRegistrada == 1){
												echo "<li><a href='#conteudo' role='button' onClick=\"javascript:exibirBotaoRelatorio('".$contadorDivisao.$idAnoMes."', this)\">".$listBanoMes->descricaoMes."</a></li>";
											}
											if($listBanoMes->visaoRegistrada == 2){
												echo "<li><a href='#conteudo' role='button' onclick=\"window.location.href='../gestao-orcamentaria/resultado-pdf?/id=".$listBanoMes->id."&amp;MOD=SV18&niveis=".urlencode("GESTÃO ORÇAMENTÁRIA/GESTÃO - DEMONSTRATIVOS E RELATÓRIOS/DEMONSTRATIVOS/".getDescricaoSecao($list->demonstrativo->descricaoSecao)."/".retiraBarras($listb->descricao)."/".$anoTemp->ano)."'\">".$listBanoMes->descricaoMes."</a></li>";
											}
											if($listBanoMes->visaoRegistrada == 3){
												echo "<li><a href='#conteudo' role='button' onClick=\"javascript:exibirModalDemostrativoRelatorio(".$listBanoMes->id.") \">".$listBanoMes->descricaoMes."</a></li>";
											}
											$botao = "";
											$idRepetido = $listBanoMes->id;
											foreach($listBanoMes as $anexo){
												if(is_object($anexo)){
													$id = $anexo->id;
													$botao .= "<li><a href='#conteudo' role='button' class='box' onClick=window.location.href='../gestao-orcamentaria/resultado-pdf?/id=$id&MOD=SV17&niveis=".urlencode("GESTÃO ORÇAMENTÁRIA/GESTÃO - DEMONSTRATIVOS E RELATÓRIOS/DEMONSTRATIVOS/".getDescricaoSecao($list->demonstrativo->descricaoSecao)."/".$listb->descricao."/".$anexo->descricao."/".$anoTemp->ano)."'>".$anexo->descricao."</a></li>";
												}
											}
											$conjBotoes .= detalhamentoRelatorio($listb->descricao, $botao, $contadorDivisao.$anoTemp->ano.$listBanoMes->descricaoMes );
										}
									}else if(is_array($anoTemp->meses)){
										foreach($anoTemp->meses as $listBanoMes){
											if($listBanoMes->descricaoMes != $mesRepetido){
												$mesRepetido = $listBanoMes->descricaoMes;
												$idAnoMes = $anoTemp->ano.$listBanoMes->descricaoMes;
												if($listBanoMes->visaoRegistrada == 1){
													echo "<li><a href='#conteudo' role='button' onClick=\"javascript:exibirBotaoRelatorio('".$contadorDivisao.$idAnoMes."', this)\">".$listBanoMes->descricaoMes."</a></li>";
												}
												if($listBanoMes->visaoRegistrada == 2){
													echo "<li><a href='#conteudo' role='button' onclick=\"window.location.href='../gestao-orcamentaria/resultado-pdf?/id=".$listBanoMes->id."&amp;MOD=SV18&niveis=".urlencode("GESTÃO ORÇAMENTÁRIA/GESTÃO - DEMONSTRATIVOS E RELATÓRIOS/DEMONSTRATIVOS/".getDescricaoSecao($list->demonstrativo->descricaoSecao)."/".retiraBarras($listb->descricao)."/".$anoTemp->ano)."'\">".$listBanoMes->descricaoMes."</a></li>";
												}
												if($listBanoMes->visaoRegistrada == 3){
													echo "<li><a href='#conteudo' role='button' onClick=\"javascript:exibirModalDemostrativoRelatorio(".$listBanoMes->id.") \">".$listBanoMes->descricaoMes."</a></li>";
												}
												$botao = "";
												$idRepetido = "";
												foreach($anoTemp->meses as $listBanoMesBotao){
													if($mesRepetido == $listBanoMesBotao->descricaoMes){
														if($listBanoMesBotao->id != $idRepetido){
															$idRepetido = $listBanoMesBotao->id;
															foreach($listBanoMesBotao as $anexo){
																if(is_object($anexo)){
																	$id = $anexo->id;
																	$botao .= "<li><a href='#conteudo' role='button' class='box' onClick=window.location.href='../gestao-orcamentaria/resultado-pdf?/id=$id&MOD=SV17&niveis=".urlencode("GESTÃO ORÇAMENTÁRIA/GESTÃO - DEMONSTRATIVOS E RELATÓRIOS/DEMONSTRATIVOS/".getDescricaoSecao($list->demonstrativo->descricaoSecao)."/".$listb->descricao."/".$anexo->descricao."/".$anoTemp->ano)."'>".$anexo->descricao."</a></li>";
																}
															}
														}
													}
												}
												$conjBotoes .= detalhamentoRelatorio($listb->descricao, $botao, $contadorDivisao.$anoTemp->ano.$listBanoMes->descricaoMes );
											}	
										}
									}
									echo "</ul></div>";
									echo $conjBotoes;	
								}
							}
							else if(is_object($listBano)){
								$anoDesc = $listBano->ano;
								echo "<div class='row report'>
								<ul id='nav'>";
								echo "<li>".$listBano->ano."</li>";
								$conjBotoes = "";
								$mesRepetido = "";
								foreach($listBano->meses as $listBanoMes){
									if($listBanoMes->descricaoMes != $mesRepetido){
										$mesRepetido = $listBanoMes->descricaoMes;
										$idAnoMes = $listBano->ano.$listBanoMes->descricaoMes;
										if($listBanoMes->visaoRegistrada == 1){
											echo "<li><a href='#conteudo' role='button' onClick=\"javascript:exibirBotaoRelatorio('".$contadorDivisao.$idAnoMes."', this)\">".$listBanoMes->descricaoMes."</a></li>";
										}
										if($listBanoMes->visaoRegistrada == 2){
											echo "<li><a href='#conteudo' role='button' onclick=\"window.location.href='../gestao-orcamentaria/resultado-pdf?/id=".$listBanoMes->id."&amp;MOD=SV18&niveis=".urlencode("GESTÃO ORÇAMENTÁRIA/GESTÃO - DEMONSTRATIVOS E RELATÓRIOS/DEMONSTRATIVOS/".getDescricaoSecao($list->demonstrativo->descricaoSecao)."/".retiraBarras($listb->descricao)."/".$listBano->ano)."'\">".$listBanoMes->descricaoMes."</a></li>";
										}
										if($listBanoMes->visaoRegistrada == 3){
											echo "<li><a href='#conteudo' role='button' onClick=\"javascript:exibirModalDemostrativoRelatorio(".$listBanoMes->id.") \">".$listBanoMes->descricaoMes."</a></li>";
										}
										$botao = "";
										$idRepetido = "";
										foreach($listBano->meses as $listBanoMesBotao){
										if($mesRepetido == $listBanoMesBotao->descricaoMes){
											if($listBanoMesBotao->id != $idRepetido){
											$idRepetido = $listBanoMesBotao->id;
													foreach($listBanoMesBotao as $anexo){
														if(is_object($anexo)){
														$id = $anexo->id;
														$botao .= "<li><a href='#conteudo' role='button' class='box' onClick=window.location.href='../gestao-orcamentaria/resultado-pdf?/id=$id&MOD=SV17&niveis=".urlencode("GESTÃO ORÇAMENTÁRIA/GESTÃO - DEMONSTRATIVOS E RELATÓRIOS/DEMONSTRATIVOS/".getDescricaoSecao($list->demonstrativo->descricaoSecao)."/".$listb->descricao."/".$anexo->descricao."/".$listBano->ano)."'>".$anexo->descricao."</a></li>";
														}
													}
												}
											}
										}
										$conjBotoes .= detalhamentoRelatorio($listb->descricao, $botao, $contadorDivisao.$listBano->ano.$listBanoMes->descricaoMes );
									}	
								}
								echo "</ul></div>";
								echo $conjBotoes;	
							}
						}
					}
				}
			}
		}
	}
}
 ?>