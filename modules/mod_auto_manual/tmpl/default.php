<?php defined('_JEXEC') or die;

include_once 'func.php';


$dados['manual'] =  array_sort($dados['manual'], 'tipoManual', SORT_ASC);

?>

<div class="container demonstrativo bg_azul_fundo">
    <div class="row conteudo selecionado" data-aba-id="1">
        <div class="col-12">
            <div class="row">
                <div class="titulo">MANUAIS DE ORIENTAÇÃO </div>
            </div>
            <div class="row">
                <small>Última atualização: <?php  echo getDataAtualizacao2($dados['manual']); ?></small>
            </div>

            <?php
			$ano = 0;
			$manualTipo = "";
			foreach($dados['manual'] as $manual){
					if ($manualTipo != $manual['tipoManual']) :
						$manualTipo = $manual['tipoManual'];
						?>
						<br><br>
            <div class="row ">
                <ul>
                    <li class="titulo" style="border-right: 0px"><?php echo $manual['tipoManual']; ?></li>
                </ul>
            </div>
            <div class="row botoes w100" style="display: block;">
                <div class="clearfix"></div>
                <div class="spacer"></div>
                <div class="spacer"></div>
                <table id="tabela_<?= $ano; ?>">
                    <tr>
                        <th>DESCRIÇÃO</th>
                        <th>DATA DE PUBLICAÇÃO</th>
                        <th>OBSERVAÇÕES</th>
                    </tr>
                    <?php
					$texto  = "";
					foreach($dados['manual'] as $manual){
			
					if ($manualTipo == $manual['tipoManual']) :
						
					$texto .= "<tbody>
							<tr>
								<td>
									<a href='../index.php/gestao-orcamentaria/resultado-pdf?/id=" . $manual['id'] . "&MOD=".$dados['params']['servico_pdf']."&niveis=" . urlencode("PJE/MANUAL/" . $manual['descricao']) . "'>
													" . $manual['descricao'] . "
												</a>
								
								</td>
								<td>" . $manual['dataAtualizacao'] . "</td>

								<td>" . $manual['observacoes'] . "</td>
								</tbody>
								</tr>
					";

			endif;
		}

		echo  $texto;
		?>
                </table>
            <div class="clearfix"></div>
        </div>
        <?php
endif;
} ?>
    </div>
</div>
</div> 