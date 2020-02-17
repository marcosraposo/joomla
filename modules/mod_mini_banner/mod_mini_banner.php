<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_banners
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the banners functions only once
JLoader::register('ModMiniBannerHelper', __DIR__ . '/helper.php');

$headerText = trim($params->get('header_text'));
$footerText = trim($params->get('footer_text'));

JLoader::register('BannersHelper', JPATH_ADMINISTRATOR . '/components/com_banners/helpers/banners.php');
BannersHelper::updateReset();
$list = &ModMiniBannerHelper::getList($params);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');

require JModuleHelper::getLayoutPath('mod_mini_banner', $params->get('layout', 'default'));
