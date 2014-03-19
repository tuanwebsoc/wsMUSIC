<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_wsmusic
 *
 * @copyright   Copyright (C) 2005 - 2014 WebSoc company
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * View class for a list of tracks.
 *
 * @package     Wsmusic.Administrator
 * @subpackage  com_wsmusic
 * @since       0.0.1
 */
class WsmusicViewTracks extends JViewLegacy
{
	protected $state;

	protected $items;

	protected $pagination;

	/**
	 * Display the view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	public function display($tpl = null)
	{
		WsmusicHelper::addSubmenu('Tracks');

		$this->items         = $this->get('Items');
		$this->pagination    = $this->get('Pagination');
		$this->state    	 = $this->get('State');
		$this->authors       = $this->get('Authors');
		$this->filterForm    = $this->get('FilterForm');
		$this->activeFilters = $this->get('ActiveFilters');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));

			return false;
		}

		// Levels filter.
		$options		= array();
		$options_list	= 4;

		for ( $i = 1; $i <= $options_list; $i++ )
		{
			$options[] = JHtml::_('select.option', $i, JText::_('J' . $i));
		}

		$this->f_levels = $options;

		// Add toolbar and sidebar
		$this->addToolbar();
		$this->sidebar = JHtmlSidebar::render();

		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function addToolbar()
	{
		$canDo = JHelperContent::getActions('com_wsmusic', 'component', 0);
		$user  = JFactory::getUser();

		// Get the toolbar object instance
		$bar = JToolBar::getInstance('toolbar');

		JToolbarHelper::title(JText::_('COM_WSMUSIC_TRACKS_TITLE'), 'stack article');

		if ($canDo->get('core.create') || (count($user->getAuthorisedCategories('com_wsmusic', 'core.create'))) > 0 )
		{
			JToolbarHelper::addNew('track.add');
		}

		if ($canDo->get('core.edit.state'))
		{
			JToolbarHelper::publish('tracks.publish', 'JTOOLBAR_PUBLISH', true);
			JToolbarHelper::unpublish('tracks.unpublish', 'JTOOLBAR_UNPUBLISH', true);
			JToolbarHelper::archiveList('tracks.archive');
		}

		if ($this->state->get('filter.published') == -2 && $canDo->get('core.delete'))
		{
			JToolbarHelper::deleteList('', 'tracks.delete', 'JTOOLBAR_EMPTY_TRASH');
		}
		elseif ($canDo->get('core.edit.state'))
		{
			JToolbarHelper::trash('tracks.trash');
		}

		if ($user->authorise('core.admin', 'com_wsmusic'))
		{
			JToolbarHelper::preferences('com_wsmusic');
		}

		JToolbarHelper::help('JHELP_CONTENT_ARTICLE_MANAGER');
	}

	/**
	 * Returns an array of fields the table can be sorted by
	 *
	 * @return  array  Array containing the field name to sort by as the key and display text as value
	 *
	 * @since   3.0
	 */
	protected function getSortFields()
	{
		return array(
				't.ordering'     => JText::_('JGRID_HEADING_ORDERING'),
				't.state'        => JText::_('JSTATUS'),
				't.title'        => JText::_('JGLOBAL_TITLE'),
				'category_title' => JText::_('JCATEGORY'),
				'access_level'   => JText::_('JGRID_HEADING_ACCESS'),
				't.created_by'   => JText::_('JAUTHOR'),
				't.created'      => JText::_('JDATE'),
				't.id'           => JText::_('JGRID_HEADING_ID'),
		);
	}
}
