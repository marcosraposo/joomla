<?php 
error_reporting(0);
include_once'func.php';

function getMeses($meses) {
    $retorno = array();
    for ($i = 0; $i < count($meses); $i++) { 
        array_push($retorno, $meses[$i]['meses']);
    }
	// Faz a ordenação do array de meses de forma decrescente(Maior para Menor)
	rsort($retorno);
	
    return $retorno;
}

function getDados($meses) {

    $anos  = array();
    $dados = array();
    $meses = getMeses($meses);

    foreach($meses as $mes) {
        $ano = explode("/", $mes['dataPublicacao'])[2];
        if(!in_array($ano, $anos)) {
            array_push($anos, $ano);
        }
    }
	
	// Faz a ordenação do array de anos de forma decrescente(Maior para Menor)
	rsort($anos);

    foreach($anos as $ano) {
        $arrayAnos = array();

        foreach($meses as $mes) {
            $anoMes = explode("/", $mes["dataPublicacao"])[2];
            if ($anoMes === $ano) {
                array_push($arrayAnos, $mes);
            }
        }
        array_push($dados, array(
            "ano" => $ano,
            "meses" => $arrayAnos
        ));
    }
    return $dados;
}

function getDataAtualizacao($array){
    $dataAtualizacao = new DateTime();
    if(is_array($array) && !empty($array)){
        $first = true;
        foreach($array as $retorno){
            if($retorno['meses']['exibe']){
                foreach ($retorno['meses']['anexos'] as $anexo) {
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
?>

<div class="container demonstrativo bg_azul_fundo">
  <div class="row conteudo selecionado">
    <div class="col-12">
      <div class="row">
        <div class="titulo">Estatísticas</div>
      </div> 
      <div class="row">
        <small>Última atualização: <?php echo getDataAtualizacao($list); ?></small>                
      </div>
      
    <div class="clearfix"></div>
    <div class="spacer"></div>  

    <?php foreach(getDados($list) as $dado): ?>
        <div class="row report">
            <ul>
                <li>
                   <?= $dado['ano']; ?>
                </li>
                <?php foreach($dado['meses'] as $mes):?>
                    <li><a href="#conteudo" onClick="javascript:exibirBoxConteudoMes('<?=$dado['ano']."-".$mes['descricaoMes'];?>')"><?= $mes['descricaoMes'];  ?></a></li>
                <?php endforeach; ?>
            </ul>                
        </div>     
        <?php foreach($dado['meses'] as $mes): 
		
		?>
            <div class="row botoes2 boxConteudoMes" id="<?=$dado['ano']."-".$mes['descricaoMes']?>"> 
                <ol>
					<?php 
					foreach($mes['anexos'] as $anexo): 
					if(is_array($anexo)){?>
						<li>
							<a href="index.php/gestao-orcamentaria/resultado-pdf?/id=<?php echo $anexo['id']."&MOD=SV35&niveis=".urlencode("CORREGEDORIA/ESTATÍSTICA/".$dado['ano']."/".$mes['descricaoMes']."/".$anexo['descricao']) ?>">
								<?=$anexo['descricao'];  ?>
							</a>                             
						</li>
					<?php }else{ ?>
						<li>
							<a href="index.php/gestao-orcamentaria/resultado-pdf?/id=<?php echo $mes['anexos']['id']."&MOD=SV35&niveis=".urlencode("CORREGEDORIA/ESTATÍSTICA/".$mes['anexos']['ano']."/".$mes['anexos']['descricaoMes']."/".$mes['anexos']['descricao']) ?>">
								<?=$mes['anexos']['descricao'];  ?>
							</a>                             
						</li>
					<?php
					break;
					}
					endforeach; 
					?>
                </ol>   
                <div class="clearfix"></div>                      
            </div> 
        <?php 
		
		endforeach;
		


		?>
    <?php endforeach; ?> 

    </div>      
  </div>      
  <div class="clearfix"></div>       
  <div class="spacer"></div>
  <div style="display:none;">
    <input type="text" id="idMesOcultar" value="vazio"/>
  </div>
</div>