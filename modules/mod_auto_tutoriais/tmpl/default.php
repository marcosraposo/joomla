<?php defined('_JEXEC') or die;

include_once 'func.php';


$dados['tutoriaisPJE'] =  array_sort($dados['tutoriaisPJE'], 'descricaoNorma', SORT_ASC);


/*echo "<pre>";
var_dump($dados['responseProducao']);
echo "</pre>";*/

?>
		

 
      
            <div class="row">
                <div class="titulo">TUTORIAIS</div>
            </div>
            <div class="row">
				<small>Última atualização: <?php echo getDataAtualizacao2($dados['tutoriaisPJE']); ?></small>
            </div>
            <div class="spacer"></div>

            
            <div class="clearfix"></div>
            <div class="spacer"></div>

         
			<div class="container">
			<div class="row">
				<div class="titulo">Passo a Passo</div>
			</div>
			<div class="clearfix">&nbsp;</div>
			<div class="row botoes w100" style="display: block;">
			<table>
				<tbody>
				<tr>
					<th>Ordem</th>
					<th>Título</th>
				</tr>
<?php				$texto  = "";
					foreach($dados['tutoriaisPJE'] as $lista){ 	
					$texto .= "<tbody>
								<tr>
								<td>" . $lista['descricaoNorma'] . "</td>
								<td>
									<a href='../index.php/gestao-orcamentaria/resultado-pdf?/id=" . $lista['id'] . "&MOD=SV44&niveis=" . urlencode("BIBLIOTECA/PRODUÇÃO INTELECTUAL/" . $lista['descricao']) . "'>
													" . $lista['descricao'] . "</a>
								</td>
								</tbody>
								</tr>";
					};
					echo  $texto;
					?>
				</tbody>
			</table>
		</div>
	</div>