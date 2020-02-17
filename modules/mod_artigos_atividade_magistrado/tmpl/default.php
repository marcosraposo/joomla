<?php 
    defined('_JEXEC') or die;

    //var_dump($list); die();

    function getDataAtualizacao($array) {
        $dataAtualizacao = new DateTime();
        
		if (is_array($array) && !empty($array)) {
			$first = true;
            for ($i = 0; $i < count($array); $i++) {
                $mes = $array[$i];
                if ($first) {
                    $dataAtualizacao = DateTime::createFromFormat('d/m/Y', $mes['dataAtualizacao']);
                    $first = false;
                } else {
                    $dataTemp = DateTime::createFromFormat('d/m/Y', $mes['dataAtualizacao']);
                    if ($dataTemp > $dataAtualizacao) {
                        $dataAtualizacao = $dataTemp;
                    }
                }
			}
		}

		$dataAtualizacao = $dataAtualizacao->format('d/m/Y');
		return $dataAtualizacao;
	}

    // Percorrerá a lista de Professores.
    $textoExibicaoProfessor = "";
    foreach($list['listaDocentes'] as $atividade): 
        $texto = "<tr>";
            $texto .= "<td>".$atividade['nome']."</td>";
            $texto .= "<td>".$atividade['matricula']."</td>";
            $texto .= "<td>".$atividade['atividade']."</td>";
            $texto .= "<td>".$atividade['instituicao']."</td>";
            $texto .= "<td>".$atividade['disciplina']."</td>";
            $texto .= "<td>".$atividade['cargaHoraria']."</td>";
            $texto .= "<td>".$atividade['diasSemana']."</td>";
        $texto .= "</tr>";
        
        $textoExibicaoProfessor .= $texto;
    endforeach; 

    // Percorrerá a lista de Outras Atividades.
    $textoExibicaoOutras = "";
    foreach($list['listaNaoDocentes'] as $atividade):
        $texto = "<tr>";
            $texto .= "<td>".$atividade['nome']."</td>";
            $texto .= "<td>".$atividade['matricula']."</td>";
            $texto .= "<td>".$atividade['atividade']."</td>";
            $texto .= "<td>".$atividade['instituicao']."</td>";
            $texto .= "<td>".$atividade['evento']."</td>";
            $texto .= "<td>".$atividade['tema']."</td>";
            $texto .= "<td>".$atividade['periodo']."</td>";
            $texto .= "<td>".$atividade['observacao']."</td>";
        $texto .= "</tr>";
        
        $textoExibicaoOutras .= $texto;
    endforeach; 

    //Recebe o rodape da pagina que foi informado como parametro no modulo.
    $rodape = $params->get('footer');
    $rodape = str_replace("<p>", "", $rodape);
    $rodape = str_replace("</p>", "", $rodape);
?>


<div class="container demonstrativo bg_azul_fundo">
  <div class="row">
    <div class="col-md-6 aba selecionado" data-aba="1">
      <div><a class="textoSemSublinhado" href="#container">Professores</a></div>
    </div>
    <div class="col-md-6 aba" data-aba="2">
      <div><a class="textoSemSublinhado" href="#container">Outras Atividades</a></div>
    </div>
  </div>
</div>

<div class="container demonstrativo bg_azul_fundo">
    <div class="row conteudo selecionado" data-aba-id="1">
        <div class="col-12">           
            <div class="row">
                <div class="titulo">Lista de Atividades de Docêntes dos Magistrados</div>                
            </div>   
            <div class="row">
                <small>Última atualização: <?= date('d/m/y'); ?></small>                
            </div>         
        </div> 
        <br/>
        <br/>
        <div class="row botoes w100" style="display:block">       
            <div class="spacer"></div>
            <div class="spacer"></div>
            <div class="spacer"></div>
            <div class="spacer"></div>
            <table>
                <tr>
                    <th>Nome</th>
                    <th>Matrícula</th>
                    <th>Atividade</th>
                    <th>Instituição</th>
                    <th>Disciplina</th>
                    <th>Carga Horária</th>
                    <th>Dias da semana</th>
                </tr>
                <?= $textoExibicaoProfessor; ?>
            </table>
            <div class="spacer"></div>
            <div class="spacer"></div>

            <?php echo html_entity_decode($rodape); ?>
        </div>
    </div>
    <div class="row conteudo" data-aba-id="2">
        <div class="col-12">
            <div class="row">
                <div class="titulo">Lista de outras Atividades dos Magistrados</div>                
            </div>   
            <div class="row">
                <small>Última atualização: <?= date('d/m/y'); ?></small>                
            </div> 
        </div>
        <br/>
        <br/>
        <div class="row botoes w100" style="display:block">       
            <div class="spacer"></div>
            <div class="spacer"></div>
            <div class="spacer"></div>
            <div class="spacer"></div>
            <table>
                <tr>
                    <th>Nome</th> 
                    <th>Matrícula</th> 
                    <th>Atividade</th> 
                    <th>Instituição</th>
                    <th>Evento</th>
                    <th>Tema</th>
                    <th>Período</th>
                    <th>Observação</th>
                </tr>
                <?= $textoExibicaoOutras; ?>
            </table>
            <div class="spacer"></div>
            <div class="spacer"></div>
            <?php echo html_entity_decode($rodape); ?>
        </div> 
    </div>

    
</div>