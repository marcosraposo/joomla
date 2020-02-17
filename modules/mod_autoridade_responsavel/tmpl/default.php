<?php defined('_JEXEC') or die; ?>

<?php 

$nomeAutoridade  = $list['title'] ? $list['title'] : "";
$cargoAutoridade = $list['introtext'] ? $list['introtext'] : "";
$dataAtualizacao = "";

if (!empty($list['publish_up'])) {
  $dataAtualizacao = new DateTime($list['publish_up']);
  $dataAtualizacao = $dataAtualizacao->format('d/m/Y');
} else {
  $dataAtualizacao = new DateTime(date('Y-m-d H:m:s'));
  $dataAtualizacao = $dataAtualizacao->format('d/m/Y');
}

?>

<div class="box_me duplo linha_clicavel">
  <div class="linha visivel" style="cursor: pointer;">
    <div class="coluna_a">
      <div class="icone">
        <img src="templates/portalTRF5/images/folhas_setas.svg">
      </div>
    </div>
    <div class="coluna_b">
      Autoridade Responsável pelo Monitoramento da Implementação da Lei de acesso à Informação
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="linha oculta box_texto">
    <div class="col-12">
      <div class="row">
        <div class="titulo branco">
          Autoridade responsáel pelo monitoramento da implementação da Lei de Acesso à Informação
        </div>
      </div>
      <div class="row">
        <small>
          Última atualização: <?= $dataAtualizacao; ?>
        </small>
      </div>
      <div class="row">
        <small style="font-weight: bold; margin-bottom: -7px;">
          <?= $nomeAutoridade; ?>
        </small>
      </div>
      <div class="row">
        <small><?= $cargoAutoridade; ?></small>
      </div>
    </div>
  </div>
</div>
