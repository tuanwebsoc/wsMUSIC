<?php
/**
 * @package     wsmusic backend
 * @subpackage  com_wsmusic
 * @version 	0.0.1
 * @copyright   Copyright (C) 2005 - 2014 WebSoc company
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tabstate');

// Access check: is this user allowed to access the backend of this component?
try {
	JFactory::getUser()->authorise('core.manage', 'com_wsmusic');
} catch (Exception $e) {
	JLog::add(JText::_($e->getMessage()), JLog::WARNING, 'jerror');
}

JLoader::register('WsmusicHelper', dirname(__FILE__) . '/helpers/wsmusichelper.php');

$controller=JControllerLegacy::getInstance('wsmusic');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
