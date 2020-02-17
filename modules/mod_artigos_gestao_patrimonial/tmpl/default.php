<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>

<div class="atualizacoes">
	<h2>Últimas atualizações</h2>

	<?php foreach ($list as $item) : ?>

		<?php $date = new DateTime($item['data_publicacao']); ?>
		<a href="index.php/noticias/leitura-de-noticias?/id=<?= $item['id']; ?>">
			<div class="box_upd teste">
				<div class="data" style="color: #292b2c;"><?= $date->format('d.m.Y'); ?> às <?= $date->format('H:i') ?></div>
				<div class="titulo"><?= $item['titulo']; ?></div>
				<div class="descricao">
					<?= mb_strimwidth(strip_tags($item['texto']), 0, 40, "..."); ?>
				</div>            
				<div class="icone-rb">+</div>
			</div>
		</a>
	<?php endforeach; ?>
	
	<div class="clearfix"></div>
</div>
