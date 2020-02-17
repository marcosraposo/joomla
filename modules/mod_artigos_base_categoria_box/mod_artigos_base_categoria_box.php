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
JLoader::register('ModArticlesLatestHelperCategoria', __DIR__ . '/helper.php');

$id = "";
if(!empty($_GET['/id'])){
	$id = $_GET['/id'];
}

$action = "";
if(!empty($_GET['action'])){
	$action = $_GET['action'];
}

$tipo = "";
if(!empty($_GET['tipo'])){
	$tipo = $_GET['tipo'];
}

//var_Dump($params);

$list            = ModArticlesLatestHelperCategoria::getList($params, $id, $action, $tipo);

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');

require JModuleHelper::getLayoutPath('mod_artigos_base_categoria_box', $params->get('layout', 'default'));

?>