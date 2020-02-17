<?php

//arg0=portal-da-transparencia&origem=1&nivel=1
//nivel=portal-da-transparencia&origem=1&id_categoria=1

	$nivel = (!empty($_GET['nivel']))? $_GET['nivel'] : "1" ;
	$arg0 = (!empty($_GET['arg0']))? $_GET['arg0'] : "portal-da-transparencia";
	$origem = (!empty($_GET['origem']))? $_GET['origem'] : "1";

		try {
			ini_set("soap.wsdl_cache_enabled", "0");
			$client = new SoapClient("http://localhost:8087/feeder2/FeedService?wsdl");

			//if($id_categoria == "portal-da-transparencia"){
				$id_categoria = 1;
				$arguments = array('buscaGuiada' => array('arg0' => $arg0, 'origem' => $origem, 'nivel' => $nivel));
				$buscaGuiadaServico = $client->__soapCall("buscaGuiada", $arguments); 
			/*}else{
				$arguments = array('buscaContent' => array('arg0' => $id_categoria, 'origem' => $origem ));
				$buscaGuiadaServico = $client->__soapCall("buscaContent", $arguments); 
			}*/
		} catch (Exception $e) {
			$id_categoria = "resultado";
		}

	
	
	

						foreach($buscaGuiadaServico as $retorno){
							foreach($retorno->categoria as $botoes){
								if(is_object($botoes)){ 
									?>
									<pre>
									<?php //var_dump($botoes);?>
									</pre>
									<?php	
								}
							}
						}

?>




	<?php 
	if($nivel == 1){
	?>
			<div class="row">
                <div class="col-2">
                    <div class="searchlbox">
                        <img src="/joomla/templates/portalTransparencia/images/lupa.svg">
                        <?php echo utf8_encode("Portal da transpar�ncia")?>
                    </div>
                </div>
                <div class="col-1"></div>
                <div class="col-9 consultacontainer">
                    <div class="fecha" onClick="fecharBuscaGuiada();">
                        X
                    </div>
                    <div class="box margin">
                        <div class="titulo-consulta-box">Consulta Aberta</div>
                        <input type="text" placeholder="<?php echo utf8_encode("digite aqui o que est� procurando"); ?>">
                    </div>
                    <div class="box">
                        <div class="titulo-consulta-box">Consulta Guiada</div>
                        <div class="descricao"><?php echo utf8_encode("em caso de d�vida na sua busca, nossa consulta guiada pode te auxiliar atrav�s de filtros");?></div>
						<?php 	
						foreach($buscaGuiadaServico as $retorno){
							foreach($retorno->categoria as $botoes){
								if(is_object($botoes)){ ?>
								<div class="box" onclick="javascript:resultadoBuscaGuiada('<?php echo $botoes->path; ?>','portal-da-transparencia','<?php echo $botoes->nivel; ?>')";>
									<img src="/joomla/templates/portalTransparencia/images/folha.svg">
									<?php echo $botoes->title; ?>
								</div>
				    	<?php	
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
	if($nivel >= 2){	?>
			<div id="id_tela_busca" style="display:none;"><?php //echo $buscaGuiadaServico->return->origem; ?></div>	
			<div class="row">
                <div class="col-2">
                    <div class="searchlbox">
                        <img src="/joomla/templates/portalTransparencia/images/lupa.svg">
                        Portal da transparência
                    </div>
					<?php
						foreach($buscaGuiadaServico as $retorno){
							foreach($retorno->nivel as $niveis){
								if(is_object($niveis)){
									?>
									 <div class="searchlbox " onClick="javascript:resultadoBuscaGuiada(<?php echo $niveis->nivel;?>,<?php echo $niveis->descricaoNivel;?>,<?php echo $niveis->nivel;?>)"><?php echo $niveis->descricaoNivel;?></div>
									<?php
								}
							}
						}
						?>
                    <div class="searchlbox">
                        Opção
                    </div>
                </div>
                <div class="col-1"></div>
                <div class="col-9 consultacontainer">
                    <div class="fecha"  onClick="fecharBuscaGuiada();">
                        X
                    </div>
                    <div class="option margin">
                        <div class="chevron volta" onclick="javascript:resultadoBuscaGuiada('1','<?php echo $buscaGuiadaServico->return->origem; ?>','<?php echo $buscaGuiadaServico->return->origem; ?>')";><</div>
                        Escolha uma opção
                    </div>
                    <div class="box noborder center">
						<div style="display:block;align-items: center; border: 0px solid #fff;">
						<?php 	
						foreach($buscaGuiadaServico as $retorno){
							foreach($retorno->categoria as $botoes){
								if(is_object($botoes)){
								?>
								<div class="box center txt_regular" onclick="javascript:resultadoBuscaGuiada('<?php echo $botoes->alias; ?>','<?php echo $botoes->assetsId; ?>','<?php echo $botoes->catId; ?>')";>
									<img src="/joomla/templates/portalTransparencia/images/folha.svg">
									<?php echo $botoes->title; ?>
								</div>
						<?php	
								}
							}
						}
						?>
						<div>
                        <div class='clearfix'></div>
                    </div>
                </div>
            </div>
<?php 	}	?>			
			
			
			
			
		
			
			
<?php 
	if($id_categoria == "resultado"){	?>	
			<div class="row">
                <div class="col-2">
                    <div class="searchlbox">
                        <img src="/joomla/templates/portalTransparencia/images/lupa.svg">
                        Portal da transparência
                    </div>
                    <div class="searchlbox">
                        Opção
                    </div>
                </div>
                <div class="col-1"></div>
                <div class="col-9 consultacontainer">
                    <div class="fecha"  onClick="fecharBuscaGuiada();">
                        X
                    </div>
					<div class="option margin">
                        <div class="chevron volta" onclick="javascript:resultadoBuscaGuiada('1','portal-da-transparencia','portal-da-transparencia')";><</div>
                        Escolha uma opção
                    </div>
                    <div class="box noborder block">
						Não foi possível encontrar o documento.
                        <div class='clearfix'></div>
                    </div>
                </div>
            </div>
<?php 	}	?>			
			
				
			
	




























<?php /*
$dados = array();
	
	function buscaGuiada($nivel, $id_categoria){
	$dados = array();
		if($id_categoria == "1"){
			$nivel_busca = 1;
			$dados[0] = array(2,"Gest�o Or�ament�ria", "2");
			$dados[1] = array(2,"LICITA��ES E CONTRATA��ES","2");
			$dados[2] = array(2,"CONV�NIOS E ACORDOS","2");
			$dados[3] = array(2,"GEST�O PATRIMONIAL","2");
		}
		
		if($id_categoria == "2"){
			$nivel_busca = 1;
			$dados[0] = array(4,"Atas de Registro de Pre�o","4");
			$dados[1] = array(4,"Consultas de Contratos","4");
			$dados[2] = array(4,"Participa��es do TRF5 em Licita��es de Outros Org�os","4");		
			$dados[3] = array(4,"Processos De Aplica��o de Penalidades","4");
		}
			
		if($id_categoria == "4"){
			$nivel_busca = 2;
			$dados[0] = array(5,"DEMOSTRATIVO","5");
			$dados[1] = array(5,"RELAT�RIO","5");
		}
		
		if($id_categoria == "5"){
			$nivel_busca = 3;
			$dados[0] = array(6,"TRF5 geral da 5� regi�o","6");
			$dados[1] = array(6,"Justi�a federal em alagoas","6");
			$dados[2] = array(6,"Justi�a federal no cear�","6");
			$dados[3] = array(6,"Justi�a federal em Pernambuco","6");
		}
		
		if($id_categoria == "6"){
			$nivel_busca = 4;
			$dados[0] = array(7,"Or�ament�rio e financeiro detalhado ","7");
			$dados[1] = array(7,"Or�ament�rio e financeiro consolidado","7");
			$dados[2] = array(7,"Estrutura remunerat�ria","7");
			$dados[3] = array(7,"Servidores e/ou empregados n�o integrantes do quadro pr�prio ","7");
		}
		
		if($id_categoria == "7"){
			$nivel_busca = 5;
			$dados[0] = array(8,"2010","8");
			$dados[1] = array(8,"2011","8");
			$dados[2] = array(8,"2013","8");
			$dados[3] = array(8,"2016","8");
		}
		
		if($id_categoria == "8"){
			$nivel_busca = 6;
			$dados[0] = array(7,"JANEIRO","30");
			$dados[1] = array(7,"FEVEREIRO","31");
			$dados[2] = array(7,"MAR�O","32");
			$dados[3] = array(7,"JUNHO","33");
		}
		return $dados;
	}

	$dados = buscaGuiada($nivel, $id_categoria);
*/
?>


	