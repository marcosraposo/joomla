<?php defined('_JEXEC') or die; 
date_default_timezone_set('America/Sao_Paulo');
?>  

<script langauge="javascript">
var counter = 0;
window.setInterval(refreshDiv, 30000);

function refreshDiv(){
	location.reload();
}
</script>


<div class="container demonstrativo bg_azul_fundo" id="monitor">
	<div class="row conteudo selecionado" data-aba-id="1">
		<div class="col-12">
			<div class="row">
				<div class="titulo">Monitoramento dos serviços do Portal</div>
			</div>
			<div class="row">
				<small>Última atualização: <?php   echo date('H:i:s d/m/Y'); ?></small>
			</div>
			<br><br>
		<div class="row botoes w100" style="display: block;">
			<table id="tabela_2018">
			<thead>
				<tr>
					<th>Nome do Serviço</th>
					<th>Estado</th>
				</tr>
			</thead>
			<tbody>

<?php  foreach($dados['servico'] as $servico){
				echo "<tr><td>";
				echo $servico['nome']."</td><td>";
				if($servico['estado'] =="S"){
					echo "<img src='../templates/portalTransparencia/images/imagem_v.png' width='30' height='30' title='O Serviço se encontra disponível no FEEDER.' >";
				}else{
					echo "<img src='../templates/portalTransparencia/images/imagem_x.png' width='28' height='28' title='O Serviço está temporariamente indisponível no FEEDER.' >";
				}
				echo "</td></tr>";
			 } 							?>
			</tbody>
			</table>
		</div>
		</div>
	</div>
</div>






