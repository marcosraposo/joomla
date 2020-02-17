<?php defined('_JEXEC') or die; ?>

<div class="carousel" data-ride="carousel">
  <?php $qtdBanners = 1; ?>

  <?php foreach ($list as $key => $item) :
	$link = explode("noticias/", $item['linkNoticia']);  
	?>

    <?php if ($key == 0) : ?>
      <a href="index.php/noticias/leitura-de-noticias?/id=<?= $link[1]; ?>">
        <div class="banner-item banner-item-active"   style="display: block" id="banner_<?= $qtdBanners; ?>">
          <img class="fundo" src="<?= $item['url']; ?>">
          <div class="titulo">
            <?= $item['titulo']; ?>
            <div class="border"></div>
            <div class="subtitulo" >
              <?= $item['resumoNoticia']; ?>
            </div>            
          </div>
        </div>
      </a>
    <?php else: ?>
      <a href="index.php/noticias/leitura-de-noticias?/id=<?= $link[1]; ?>">
        <div class="banner-item"   style="display: none" id="banner_<?= $qtdBanners; ?>">
          <img class="fundo" src="<?= $item['url']; ?>">
          <div class="titulo">
            <?= $item['titulo']; ?>
            <div class="border"></div>
            <div class="subtitulo" >
              <?= $item['resumoNoticia']; ?>
            </div>            
          </div>
        </div>
      </a>
    <?php endif; ?>

    <?php $qtdBanners++; ?>

  <?php endforeach; ?>

  <div class="ccontainer">
  <div id="contatorBanner">1</div>
    <div class="volta bgBotoesBanner"  onClick="javascript:voltarBannerJS()">
      <img src="templates/portalTRF5/images/seta_esquerda.svg" alt="Voltar para a Notícia em destaque anteior">
    </div>
    <div class="avanca avancarBanner" onClick="javascript:avancarBannerJS()">
      <img src="templates/portalTRF5/images/seta_direita.svg" alt="Ir para proxima Notícia em Destaque">
    </div>
  </div>

</div>
