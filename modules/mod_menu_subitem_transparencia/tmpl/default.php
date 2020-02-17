<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>

<?php 
$i = 0;

foreach ($list as $i => &$item) :
$i++;
$display  = "";

	if($item->level == 2){
		$display = " style = 'display: none;' ";
	}
?>

<?php 
	$image = '';

	if (isset($item->menu_image) && !empty($item->menu_image)) {
		$image = explode('images/', $item->menu_image); 
		$image = $image[0].'images/branco_'.$image[1];
	}
?>

 <a href="<?= $item->flink; ?>">
	<div class='menu_box' <?= $display; ?>>
	  <div class='linha <?php echo $item->params['menu-anchor_css']; ?>' id='<?php echo $item->params['menu-anchor_title']; //esses atributos � salvo na configura��o do modulo?>' >
		  <div class='coluna_a' style=' width: 40px;   '>
			<div class='icone'>
				<div class='icone'>
					<?php if ($item->menutype != 'menu-processos-e-consult' && $item->menutype != 'menu-imprensa'): ?>
						<img src="<?= $item->menu_image;?>">
					<?php else: ?>
						<img src="<?= $image; ?>">
					<?php endif; ?>
				</div>
			</div>
		  </div>
		  <div class='coluna_b' style='width: 120px;'>
			 <p><?= $item->title; ?></p>
		  </div>
	  </div>
	</div>
	</a>
<?php endforeach; ?>
