
<?php 
	$WService  = (!empty($_GET['WService']))? urldecode($_GET['WService']) : "" ;
	$nivel = (!empty($_GET['nivel']))? $_GET['nivel'] : "0" ;
	$arg0 = (!empty($_GET['arg0']))? $_GET['arg0'] : "servicos";
	$origem = (!empty($_GET['origem']))? $_GET['origem'] : "1";
	$params = (!empty($_GET['params']))? $_GET['params'] : "0";
	$tituloNiveis = (!empty($_GET['tituloNiveis']))? $_GET['tituloNiveis'] : "0";
	$sentido = (!empty($_GET['sentido']))? $_GET['sentido'] : "avancar";

	//Rotina para navegar adiante nas telas
	$origens = "";
	$listaOrigem = explode("/", $origem);
	if(!empty($listaOrigem[ count($listaOrigem) - 2  ])){
		$origens = $listaOrigem[ count($listaOrigem) - 2  ]; //pega a penultima posição para preencher a opção do botão voltar
		unset($listaOrigem[ count($listaOrigem) - 1  ]);//elimina a ultima posição da lista de string da origem
	}
	
	//Rotina para o botão voltar
	$origem1 = "";
	foreach($listaOrigem as $teste){
		$origem1 .= "/".$teste;
	}
	$tituloNiveis = str_replace("//","/",$tituloNiveis);
	
	//remover ultima posição da lista de itens quando voltar apra tela anterior
	if($sentido == "voltar"){
		$listaTitulo = explode("/", $tituloNiveis);
		unset($listaTitulo[ count($listaTitulo) - 1  ]);//elimina a ultima posição da lista de string da origem
		$tituloNiveis = "";
		foreach($listaTitulo as $titulo){
			$tituloNiveis .= $titulo."/";
		}
		 $tituloNiveis = substr($tituloNiveis,0,-1);
	}
	
	
		try {
			ini_set("soap.wsdl_cache_enabled", "0");
			$client = new SoapClient($WService);
			$arguments = array('buscaGuiada' => array('arg0' => $arg0, 'origem' => $origem, 'nivel' => $nivel, 'params' => $params, 'title' => $tituloNiveis));
			$buscaGuiadaServico = $client->__soapCall("buscaGuiada", $arguments); 
		} catch (Exception $e) {
			$nivel = "resultado";
		}
	
	
	$numeroElementoBotao = (!empty($buscaGuiadaServico->return->conteudo) && count($buscaGuiadaServico->return->conteudo)> 4)? "" : "noborder";	

	
	function tamanhoFontBotao($str){
		if(strlen($str) > 30){
			return "font-size: 10px;";
		}
	return "";
	}

/*
						foreach($buscaGuiadaServico as $retorno){
							foreach($retorno->categoria as $botoes){
								if(is_object($botoes)){ 
									?>
									<pre>
									<?php var_dump($botoes);?>
									</pre>
									<?php	
								}
							}
						}
*/
?>


<?php 
	if($nivel == "resultado"){	?>	
			<div class="row">
                <div class="col-2">
                    <div class="searchlbox">
                        <img src="../templates/portalTransparencia/images/lupa.svg">
                        servicos
                    </div>
                    <div class="searchlbox">
                        <?php // echo utf8_encode("Opção");?>
                    </div>
                </div>
                <div class="col-1"></div>
                <div class="col-9 consultacontainer">
                    <div class="fecha"  onClick="fecharBuscaGuiada();">
                        X
                    </div>
					<div class="option margin">
                        <div class="chevron volta" onclick="javascript:resultadoBuscaGuiada('servicos','1','0','avancar')";><</div>
                        Escolha uma opção
                    </div>
                    <div class="box noborder block">
						Não foi possível encontrar o documento.
                        <div class='clearfix'></div>
                    </div>
                </div>
            </div>
<?php 	exit;}	?>			
	
	<?php 
	if($nivel == 0){
	?>
			<div class="row">
                <div class="col-2">
                    <div class="searchlbox">
                        <img src="../templates/portalTransparencia/images/lupa.svg">
                        servicos
                    </div>
                </div>
                <div class="col-1"></div>
                <div class="col-9 consultacontainer">
                    <div class="fecha" onClick="fecharBuscaGuiada();">
                        X
                    </div>
                    <div class="box">
                        <div class="titulo-consulta-box">Consulta Guiada</div>
                        <div class="descricao">
							Em caso de dúvida na sua busca, nossa consulta guiada pode te auxiliar através de filtros
						</div>
						<?php 	
						foreach($buscaGuiadaServico as $retorno){
							foreach($retorno->categoria as $botoes){
								if(is_object($botoes)){ 
									if(!empty($botoes->link) && $botoes->link != ""){
										$link = str_replace("servicos/","",$botoes->link);
										?>
										<a class="box" style="<?php echo tamanhoFontBotao($botoes->title);?>" href="<?php echo $link; ?>" <?php echo strpos($link, 'index.php/') ? '' : 'target="_blank"'; ?>>
											<img src="../templates/portalTransparencia/images/folha.svg">
											<?php echo $botoes->title; ?>
										</a>
									<?php }else{ ?>
										<div class="box" onclick="javascript:resultadoBuscaGuiada('<?php echo $botoes->id; ?>','<?php echo "servicos/".$botoes->id;?>','<?php echo $nivel+1; ?>','','<?php echo $botoes->title; ?>', 'avancar')";>
											<img src="../templates/portalTransparencia/images/folha.svg">
											<?php echo $botoes->title; ?>
										</div>
							  <?php }
								}
							}
						}
						?>
                        <div class='clearfix'></div>
                    </div>
                </div>
            </div>
<?php 	}	?>
			
			
			
<?php 
	if($nivel >= 1 and $nivel  <= 100){
	?>
		<div id="id_tela_busca" style="display:none;"><?php //echo $buscaGuiadaServico->return->origem; ?></div>	
		<div class="row">
            <div class="col-2">
                <div class="searchlbox">
                    <img src="../templates/portalTransparencia/images/lupa.svg">
                    <?php echo utf8_encode("servicos");?>
                 </div>
				<?php
				$listaTitulos = explode("/", $tituloNiveis);
				foreach($listaTitulos as $titulos){
					echo "<div class='searchlbox' >".$titulos."</div>";
				} ?>
                </div>
                <div class="col-1"></div>
                <div class="col-9 consultacontainer">
                    <div class="fecha"  onClick="fecharBuscaGuiada();">
                        X
                    </div>
                    <div class="option margin">
                        <div class="chevron volta" onclick="javascript:resultadoBuscaGuiada('<?php echo $origens; ?>','<?php echo $origem1; ?>','<?php echo  $nivel-1; ?>','0','<?php echo $tituloNiveis; ?>','voltar')";>< </div>
                        Escolha uma opção
                    </div>
					
					<div class="box <?php echo $numeroElementoBotao; ?>">
							<?php 
							foreach($buscaGuiadaServico as $retorno){
								if(!empty($retorno->conteudo)){
									foreach($retorno->conteudo as $botoes){

										if(is_object($botoes)){
											if($botoes->exibe){
											
											$palavras = array('SUSTENTAÇÃO ORAL POR VIDEOCONFERÊN-CIA','aaa');
											

											$titulo = $botoes->title;
											if(	strpos($botoes->title, "VIDEOCONFE") == true ||
												strpos($botoes->title, "INDISPONIB") == true	){
												$titulo = str_replace("-", "", $botoes->title);
											}
									
												if(!empty($botoes->sv) && $botoes->sv != ""){ ?>
												<div class="box" onClick="window.location.href='../index.php/gestao-orcamentaria/resultado-pdf?/id=<?php echo $botoes->id; ?>&MOD=<?php echo $botoes->sv; ?>&niveis=<?php echo $tituloNiveis; ?>'" >
													<img src="../templates/portalTransparencia/images/folha.svg">
													<?php echo $titulo; ?>
												</div>
												<?php 
												}else if(!empty($botoes->link) && $botoes->link != ""){
												$link = str_replace("servicos/","",$botoes->link);
												//echo "<pre>";
												//var_dump($botoes);
												//echo "</pre>";
												?>
												
												
												<a class="box" style="<?php echo tamanhoFontBotao($titulo);?>" href="<?php echo $link; ?>" <?php echo strpos($botoes->link, 'index.php/') ? '' : 'target="_blank"'; ?>>
													<img src="../templates/portalTransparencia/images/folha.svg">
													<?php echo $titulo; ?>
												</a>
												
												
												<?php }else{ ?>
												<div class="box" style="<?php echo tamanhoFontBotao($titulo);?>" onclick="javascript:resultadoBuscaGuiada('<?php echo $botoes->path; ?>','<?php echo $origem."/".$botoes->path; ?>','<?php echo $nivel+1; ?>','<?php echo $botoes->params; ?>','<?php echo $tituloNiveis."/".$titulo; ?>','avancar')";>
													<img src="../templates/portalTransparencia/images/folha.svg">
													<?php echo $titulo; ?>
												</div>
											<?php }
											}else{
												//echo utf8_encode("Não existe Conteúdo.");
											}
										}
									}
								}else{
									echo "Não existe Conteúdo.";
								}
							}
							?>
							
							<div class='clearfix'></div>
					</div>
				</div>
			</div>
		</div>	
<?php 	}	?>			
			
			