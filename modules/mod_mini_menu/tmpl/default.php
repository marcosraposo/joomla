<?php defined('_JEXEC') or die; ?>

<?php foreach ($list as $i => $item): ?>

	<a href="<?= $item->link; ?>" class="col-sm-12 col-md-4 text-center itemBoxMenu" style="text-decoration: none; padding: 0 20px">
		<div class="main_box_branco">           
			<div class="icone icone_branco" style="position: absolute; top: -30px; left: 50%; margin-left: -44px;">
				<img src="<?= $item->menu_image; ?>">
			</div>                
			<?= $item->title; ?>
			<div class="small">
				<?= mb_strimwidth($item->anchor_title, 0, 60, "..."); ?>
			</div>
		</div>                  
	</a>

<?php endforeach; ?>
