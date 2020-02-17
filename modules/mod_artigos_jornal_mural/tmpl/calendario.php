<?php 
$servico = urldecode($_GET['sv']);
$ano = $_GET['ano'];




		try {
			ini_set("soap.wsdl_cache_enabled", "0");
			$client = new SoapClient($servico);
			$arguments = array('getJornalMural' => array('ano' => $ano));
			$list = $client->__soapCall("getJornalMural", $arguments); 
		} catch (Exception $e) {
			$nivel = "resultado";
		}
		




function buscaUrl($list, $data, $dia){
$retorno = "";
	foreach($list->return as $mes){
		foreach($mes->listaMesAno as $dias){
			if( $dias->dataPublicacao == $data){
				if(!empty($dias->url) && $dias->url != ""){
					echo "<a href='".$dias->url."' target='_blank'><font color=green><b>$dia</b></font></a>";
				}else{
					$retorno = $dia;
				}
				break;
			}
		}
	}
	return  $retorno ;
}



function MostreSemanas()
{
$semanas = "DSTQQSS";
echo "<tr class='diasTr'>";
	for( $i = 0; $i < 7; $i++ ){
		echo "<td align='center'><b>".$semanas{$i}."</b></td>";
	}
echo "</tr>";
}
 
function GetNumeroDias( $mes )
{
	$numero_dias = array( 
			'01' => 31, '02' => 28, '03' => 31, '04' =>30, '05' => 31, '06' => 30,
			'07' => 31, '08' =>31, '09' => 30, '10' => 31, '11' => 30, '12' => 31
	);
 
	if (((date('Y') % 4) == 0 and (date('Y') % 100)!=0) or (date('Y') % 400)==0)
	{
	    $numero_dias['02'] = 29;	// altera o numero de dias de fevereiro se o ano for bissexto
	}
 
	return $numero_dias[$mes];
}
 
function GetNomeMes( $mes )
{
     $meses = array( '01' => "Janeiro", '02' => "Fevereiro", '03' => "Março",
                     '04' => "Abril",   '05' => "Maio",      '06' => "Junho",
                     '07' => "Julho",   '08' => "Agosto",    '09' => "Setembro",
                     '10' => "Outubro", '11' => "Novembro",  '12' => "Dezembro"
                     );
 
      if( $mes >= 01 && $mes <= 12)
        return $meses[$mes];
 
        return "Mês deconhecido";
 }
  
function MostreCalendario( $mes,  $ano, $list )
{

	$numero_dias = GetNumeroDias( $mes );	// retorna o número de dias que tem o mês desejado
	$nome_mes = GetNomeMes( $mes );
	$diacorrente = 0;	
 
	$diasemana = jddayofweek( cal_to_jd(CAL_GREGORIAN, $mes,"01",$ano) , 0 );	// função que descobre o dia da semana

	echo "
			<div class='month'>
			<div class='subtitulo d-flex justify-content-end text-uppercase font-weight-bold mt-0'>".$nome_mes."</div>
			<table class='calendario' >
			<tbody>";
	 echo "<tr>";
	   MostreSemanas();
	for( $linha = 0; $linha < 6; $linha++ ){
	   echo "<tr>";
	   for( $coluna = 0; $coluna < 7; $coluna++ ){
			echo "<td width = 30 height = 30 ";
			if( ($diacorrente == ( date('d') - 1) && date('m') == $mes) ){
				   echo " id = 'dia_atual' ";
			}else{
					if(($diacorrente + 1) <= $numero_dias ){
						if( $coluna < $diasemana && $linha == 0){
							echo " id = 'dia_branco' ";
						}else{
							echo " id = 'dia_comum' ";
						}
					 }else{
					 }
			}
			echo " align = 'center' valign = 'center'>";

		      if( $diacorrente + 1 <= $numero_dias ){
					if( $coluna < $diasemana && $linha == 0){
						 echo " ";
					}else{
							$dia = $diacorrente+1;
							$data = "$dia/$mes/$ano";
							
							echo buscaUrl($list, $data, $dia);
						$diacorrente++;
					}
		      }else{
					break;
		      }
	   }
	   	echo "</td>";
		echo "</tbody>";
	}
	echo "</table>";
	echo "</div>";
	echo "</div>";
}
 
function MostreCalendarioCompleto($ano, $list){
	    echo "<table align = 'center' >";
	    $cont = 1;
	    for( $j = 0; $j < 3; $j++ ){
			echo "<tr>";
			for( $i = 0; $i < 4; $i++ ){
			echo "<td>";
			MostreCalendario( ($cont < 10 ) ? "0".$cont : $cont, $ano, $list );  
			$cont++;
			echo "</td>";
			}
			echo "</tr>";
		   }
	   echo "</table>";
}

?>


 <?php MostreCalendarioCompleto($ano, $list); ?>



