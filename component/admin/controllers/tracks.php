<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_wsmusic
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Tracks list controller class.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_wsmusic
 * @since       0.0.1
 */
class WsnusicControllerTracks extends JControllerAdmin
{
	/**
	 * Proxy for getModel.
	 *
	 * @param   string  $name    The name of the model.
	 * @param   string  $prefix  The prefix for the PHP class name.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  JModel
	 * 
	 * @since   1.6
	 */
	public function getModel($name = 'Track', $prefix = 'WsmusicModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);

		return $model;
	}
}
