<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_artigos_jornal_mural
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the latest functions only once
JLoader::register('ModJornalMural', __DIR__ . '/helper.php');

$ano = "";
if(!empty($_GET['/ano'])){
	$ano = $_GET['/ano'];
}



$list            = ModJornalMural::getList($params, $ano);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');

require JModuleHelper::getLayoutPath('mod_artigos_jornal_mural', $params->get('layout', 'default'));

?>