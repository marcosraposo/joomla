<?php defined('_JEXEC') or die; ?>

<?php foreach ($list as $i => $item): ?>
	
	<a href="<?= $item->link; ?>" <?= $item->browserNav != "0" ? 'target="_blank"' : ''; ?>>
		<div class="main_box_medio">
			<div class="linha">            
				<div class="coluna_a">
					<div class="icone">
						<img src="<?= $item->menu_image; ?>">
					</div>                
				</div>
				<div class="coluna_b">
					<?= $item->title; ?>
					<div class="small"><?= $item->anchor_title; ?></div>                
				</div>        
			</div>                
		</div>
	</a>

<?php endforeach; ?>
