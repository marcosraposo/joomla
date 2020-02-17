<?php defined('_JEXEC') or die; ?>

<?php foreach ($list as $i => &$item): ?>
<a role="menu" href="<?= $item->link; ?>" <?= $item->browserNav != "0" ? 'target="_blank"' : '' ?> style="text-decoration: none;">
    <div class="box_me">
        <div class="linha">
            <div class="coluna_a">
                <div class="icone">
                    <img src="<?= $item->menu_image; ?>">
                </div>
            </div>
			<?php
			
			 if(strpos( $item->title, "JEF")!==false){ ?>
				<div class='coluna_b' style=' text-transform: capitalize'>
					<?= $item->title; ?>
				</div>
<?php		 }else{		?>

			<div class='coluna_b' style=" text-transform: uppercase">
                <?= $item->title; ?>
            </div>
<?php		 }		?>
			
			
			
          
            <div class="clearfix"></div>
        </div>
    </div>
</a>
<?php endforeach; ?> 