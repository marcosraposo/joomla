<?php

defined('_JEXEC') or die;

JLoader::register('BannerHelper', JPATH_ROOT . '/components/com_banners/helpers/banner.php');
?>

<div class="main_box_medio duplo cinza" >

	<div class="owl-carousel owl-theme">
		<?php foreach ($list as $index => $item) : ?>

			<?php $link     = JRoute::_('index.php?option=com_banners&task=click&id=' . $item->id); ?>
			<?php $imageurl = $item->params->get('imageurl'); ?>
			<?php $width = $item->params->get('width'); ?>
			<?php $height = $item->params->get('height'); ?>

			<?php $baseurl = strpos($imageurl, 'http') === 0 ? '' : JUri::base(); ?>
			<?php $alt = $item->params->get('alt'); ?>
			<?php $alt = $alt ?: $item->name; ?>
			<?php $alt = $alt ?: JText::_('MOD_BANNERS_BANNER'); ?>

			<?php if (empty($item->clickurl) || $item->clickurl == "#") : ?>
				<div class="miniBannerItem">
					<div class="miniBannerItem__content">
						<div class="miniBannerItem__img">
							<img src="<?= $baseurl.$imageurl ?>" style="width:70px" height="65"/>
						</div>
						<div class="miniBannerItem__text">
							<span><?= $item->name; ?></span>
							<strong style="font-size: 14px; display: block;">
								<?= substr(strip_tags($item->description), 0, 18); ?>
							</strong>
						</div>
					</div>
				</div>
			<?php else: ?>
				<a href="<?= $link; ?>" <?= empty($item->clickurl) || $item->clickurl == "#" ? '' : 'target="_blank"'; ?> style="text-decoration: none; color: #fff;">
					<div class="miniBannerItem">
						<div class="miniBannerItem__content">
							<div class="miniBannerItem__img">
								<img src="<?= $baseurl.$imageurl ?>"  style="width:70px" height="65"/>
							</div>
							<div class="miniBannerItem__text">
								<span><?= $item->name; ?></span>
								<strong style="font-size: 14px; display: block;">
									<?= substr(strip_tags($item->description), 0, 18); ?>
								</strong>
							</div>
						</div>
					</div>
				</a>
			<?php endif; ?>

		<?php endforeach; ?>
	</div>

</div>