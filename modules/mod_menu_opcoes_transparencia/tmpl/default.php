



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


<div class="container">
    <div class="row nopadding">
        <div class="col-12 nopadding colmainbox">
		
<?php 
$i = 0;
foreach ($list as $i => &$item) :
	 $Janela = "window.location.href=";
	 $Janela2 = "";
	 if($item->browserNav == 1){
		$Janela = "window.open(";
		$Janela2 = ")";
	 }
	 if($i >= 4 ){ 
	 
	 
	 ?>
			<div class="main_box_medio">
                <div class="linha">
                    <div class="coluna_a">
                        <div class="icone"><div class="icone"><img src="<?php echo $item->menu_image; ?>"></div></div>
                    </div>
                    <a href="#conteudo" role="button" style="color:#fff" class="coluna_b" onclick="<?php echo $Janela; ?>'<?php echo $item->link; ?>'<?php echo $Janela2; ?>" >
						<?php echo $item->title;?>
                        <div class="small"><?php echo $item->anchor_title; ?></div>
                    </a>
                </div>
            </div>

		<?php  }else{ 

		if($item->link == "#"){?>
			<a href="#conteudo" role="button"  style="color:#fff" class="main_box <?php echo $item->menu_image_css; ?>" onclick="javascript:<?php echo $item->anchor_css; ?>;"  >
		<?php }else{ ?>
			<a href="#conteudo" role="button"  style="color:#fff" class="main_box <?php echo $item->menu_image_css; ?>"   onclick="<?php echo $Janela; ?>'<?php echo $item->link; ?>'<?php echo $Janela2; ?>" >
		<?php } ?>	
			    <div class="icone"><img src="<?php echo $item->menu_image; ?>"></div>
				<?php echo $item->title; ?>
            </a>
		<?php 
	}
$i++;
endforeach; ?>
					
        </div>
    </div>

</div>

