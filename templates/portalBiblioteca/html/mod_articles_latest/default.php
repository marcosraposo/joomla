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

<?php foreach ($list as $item) : ?>

	<?php $date = new DateTime($item->publish_up); ?>

	<div class="box_upd">
		<div class="data"><?= $date->format('d.m.Y'); ?> às <?= $date->format('H:i') ?></div>
		<div class="titulo"><?= $item->title; ?></div>
		<div class="descricao">
			<?= mb_strimwidth(strip_tags($item->introtext), 0, 50, "..."); ?>
		</div>            
		<div class="icone-rb">+</div>
	</div>
<?php endforeach; ?>
