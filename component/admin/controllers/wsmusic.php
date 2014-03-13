<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_content
 * @version 	0.0.1
 * @copyright   Copyright (C) 2005 - 2014 WebSoc company
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Articles list controller class.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_wsmusic
 * @since       0.0.1
 */

class WsmusicControllerWsmusics extends JControllerAdmin
{
	/**
	 * Constructor.
	 *
	 * @param   array  $config	An optional associative array of configuration settings.
	
	 * @return  WsmusicControllerWsmusics
	 * @see     JController
	 * @since   0.0.1
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);
	
		// Articles default form can come from the articles or featured view.
		// Adjust the redirect view on the value of 'view' in the request.
	
		if ($this->input->get('view') == 'featured')
		{
			$this->view_list = 'featured';
		}
	
		$this->registerTask('unfeatured',	'featured');
	}
	/**
	 * Method to toggle the featured setting of a list of tracks.
	 *
	 * @return  void
	 * @since   0.0.1
	 */
	public function featured()
	{
		// Check for request forgeries
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
	
		$user   = JFactory::getUser();
		$ids    = $this->input->get('cid', array(), 'array');
		$values = array('featured' => 1, 'unfeatured' => 0);
		$task   = $this->getTask();
		$value  = JArrayHelper::getValue($values, $task, 0, 'int');
	
		// Access checks.
		foreach ($ids as $i => $id)
		{
			if (!$user->authorise('core.edit.state', 'com_content.article.'.(int) $id))
			{
				// Prune items that you can't change.
				unset($ids[$i]);
				JError::raiseNotice(403, JText::_('JLIB_APPLICATION_ERROR_EDITSTATE_NOT_PERMITTED'));
			}
		}
	
		if (empty($ids))
		{
			JError::raiseWarning(500, JText::_('JERROR_NO_ITEMS_SELECTED'));
		}
		else
		{
			// Get the model.
			$model = $this->getModel();
	
			// Publish the items.
			if (!$model->featured($ids, $value))
			{
				JError::raiseWarning(500, $model->getError());
			}
		}
	
		$this->setRedirect('index.php?option=com_content&view=articles');
	}
}