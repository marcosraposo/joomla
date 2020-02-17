<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the menu functions only once
JLoader::register('ModMiniMenuHelper', __DIR__ . '/helper.php');

$list       = ModMiniMenuHelper::getList($params);
$base       = ModMiniMenuHelper::getBase($params);
$active     = ModMiniMenuHelper::getActive($params);
$default    = ModMiniMenuHelper::getDefault();
$active_id  = $active->id;
$default_id = $default->id;
$path       = $base->tree;
$showAll    = $params->get('showAllChildren');
$class_sfx  = htmlspecialchars($params->get('class_sfx'), ENT_COMPAT, 'UTF-8');

if (count($list)) {
	require JModuleHelper::getLayoutPath('mod_mini_menu', $params->get('layout', 'default'));
}
