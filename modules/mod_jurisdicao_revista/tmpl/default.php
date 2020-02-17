<?php defined('_JEXEC') or die;
$dataHoje = date("d/m/Y");
require_once 'func.php';

$listRevistas = array();
$listRevistasComemorativa = array();

$ordernar = false;
$i = 0;
foreach ($list as $lista) {
	//Validacao para exibir apenas os registros que NAO contem link.
	if(empty($lista['linkImagem']) || $lista['linkImagem'] == ""){
		$pos = strpos(strtoupper($lista['descricao']), 'COMEMORATIVA');
		if ($pos === false) {
			array_push($listRevistas, $lista);
		} else {
			array_push($listRevistasComemorativa, $lista);
		}
	}
}

foreach ($listRevistasComemorativa as $group) {
	$horarioAno2 = explode("/", $group['dataPublicacao']);
	if (!empty($horarioAno2[2])) {
		$ordernar = true;
		$listRevistasComemorativa[$i]['anorevista'] = $horarioAno2[2];
		$listRevistasComemorativa[$i]['datarevista'] = $horarioAno2[2] . $horarioAno2[1] . $horarioAno2[0];

		$i++;
	}
}

if ($ordernar) {
	array_sort_by3($listRevistasComemorativa, 'anorevista', $order = SORT_ASC);
}

$ordernar = false;
$i = 0;
foreach ($listRevistas as $group) {
	$horarioAno2 = explode("/", $group['dataPublicacao']);
	if (!empty($horarioAno2[2])) {
		$ordernar = true;
		$listRevistas[$i]['anorevista'] = $horarioAno2[2];
		$listRevistas[$i]['datarevista'] = $horarioAno2[2] . $horarioAno2[1] . $horarioAno2[0];

		$i++;
	}
}

if ($ordernar) {
	array_sort_by3($listRevistas, 'anorevista', $order = SORT_ASC);
}

?>
<div class="row conteudo" data-aba-id="2">
	<div class="col-12">
		<div class="row">
			<div class="titulo">Listas das Revistas Comemorativas</div>
		</div>
		<div class="row">
			<small>Última atualização: <?php echo getDataAtualizacaoRevista($listRevistasComemorativa); ?></small>
		</div>

		<?php
		$ano = 0;
		for ($i = count($listRevistasComemorativa) - 1; $i >= 0; $i--) {
			$atas = $listRevistasComemorativa[$i];
			$horarioAno = explode("/", $atas['dataPublicacao']);
			if ($ano != $horarioAno[2]) {
				$ano = $horarioAno[2];
				?>
				<div class="row report">
					<ul>
						<li><?php echo $horarioAno[2]; ?></li>
						<table id="tabela_<?= $ano; ?>">
							<thead>
								<tr>
									<?php
										$listRevistasComemorativaTemp = $listRevistasComemorativa;
										array_sort_by3($listRevistasComemorativaTemp, 'datarevista', $order = SORT_DESC);
										$texto = "";
										foreach ($listRevistasComemorativaTemp as $listDados) {
											$horarioAno2 = explode("/", $listDados['dataPublicacao']);
											if ($horarioAno2[2] == $ano) {
												$texto .= "<li>
											<a href='../index.php/gestao-orcamentaria/resultado-pdf?/id=" . $listDados['id'] . "&MOD=SV31&niveis=" . urlencode("GABINETE REVISTA/JURISDIÇÃO - PUBLICAÇÕES/REVISTAS") . "'>
											" . $listDados['descricao'] . "
											</a></li>
												";
											}
										}
										echo $texto;
									?>
								</tr>
							</thead>
						</TABLE>
					</ul>
				</div>
		<?php	}
		}
		?>
	</div>
</div>
<div class="row conteudo" data-aba-id="3">
	<div class="col-12">
		<div class="row">
			<div class="titulo">Histórico das Revistas</div>
		</div>
		<div class="row">
			<small>Última atualização: <?php echo getDataAtualizacaoRevista($listRevistas); ?></small>
		</div>

		<?php
		$ano = 0;
		for ($i = count($listRevistas) - 1; $i >= 0; $i--) {
			$atas = $listRevistas[$i];
			$horarioAno = explode("/", $atas['dataPublicacao']);
			if ($ano != $horarioAno[2]) {
				$ano = $horarioAno[2];
				?>
				<div class="row report">
					<ul>
						<li><?php echo $horarioAno[2]; ?></li>
						<table id="tabela_<?= $ano; ?>">
							<thead>
								<tr>
									<?php
										$listRevistasTemp = $listRevistas;
										array_sort_by3($listRevistasTemp, 'datarevista', $order = SORT_DESC);

										$texto = "";
										foreach ($listRevistasTemp as $listDados) {
											$horarioAno2 = explode("/", $listDados['dataPublicacao']);
											if ($horarioAno2[2] == $ano) {
												$texto .= "<li>
													<a href='../index.php/gestao-orcamentaria/resultado-pdf?/id=" . $listDados['id'] . "&MOD=SV31&niveis=" . urlencode("GABINETE REVISTA/JURISDIÇÃO - PUBLICAÇÕES/REVISTAS") . "'>
													" . $listDados['descricao'] . "
													</a></li>
												";
											}
										}
										echo $texto;
									?>
								</tr>
							</thead>
						</TABLE>
					</ul>
				</div>
	<?php	}
		}
		?>
	</div>
</div>