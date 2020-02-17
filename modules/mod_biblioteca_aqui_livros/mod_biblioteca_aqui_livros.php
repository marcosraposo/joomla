<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the latest functions only once
JLoader::register('ModBibliotecaLivros', __DIR__ . '/helper.php');



$limite = "12";
$pagina = "0";
if(!empty($_GET['pagina'])){
	$pagina = $_GET['pagina'];
}

$list            = ModBibliotecaLivros::getList($params, $pagina, $limite);


$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');

require JModuleHelper::getLayoutPath('mod_biblioteca_aqui_livros', $params->get('layout', 'default'));

?>