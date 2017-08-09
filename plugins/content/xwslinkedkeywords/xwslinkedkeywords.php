<?php

/**
 * @package     Joomla.Plugin
 * @subpackage  com_xws_linked_keywords
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

/**
 * Content search plugin.
 *
 * @package     Joomla.Plugin
 * @subpackage  com_xws_linked_keywords
 * @since       3.7
 */
class PlgContentXwsLinkedKeywords extends JPlugin
{

	public function onContentPrepare($context, &$row, &$params, $page = 0)
	{
		$app = JFactory::getApplication();
		$menu = $app->getMenu();

		$com_params = JComponentHelper::getParams('com_xws_linked_keywords');
		$global_limit = (int) $com_params->get('replacements_limit', 1);

		// Get a db connection.
		$db = JFactory::getDbo();

		// Create a new query object.
		$query = $db->getQuery(true);

		// Select all records from the user profile table where key begins with "custom.".
		// Order it by the ordering field.
		$query->select($db->quoteName(array('name', 'menuitem', 'link_type', 'externalurl', 'tag', 'limit_use_global', 'limit')));
		$query->from($db->quoteName('#__xws_linked_keywords'));
		$query->where($db->quoteName('state') . ' = 1');
		$query->order('ordering ASC');

		// Reset the query using our newly populated query object.
		$db->setQuery($query);

		// Load the results as a list of stdClass objects (see later for more options on retrieving data).
		$results = $db->loadObjectList();

		// Make case sensitive
		$case = 'i';
		$html_link ='#';

		foreach ($results as $result) {
			$limit = $global_limit;
			if ((int) $result->limit_use_global === 0) {
				$limit = (int) $result->limit;
			}
			if ((int)$result->link_type === 0)
			{
				$m_item    = $menu->getItem((int)$result->menuitem);
				$route     = JRoute::_($m_item->link);
				$target    = 'target="_self"';

				$html_link = '<a href="' . $route . '" alt="' . $result->name . '" class="xwslinked_keyword" ' . $target .'>' . $result->name . '</a>';

			} else if((int)$result->link_type === 1) {
				$route     = $result->externalurl;
				$target    = 'target="_blank" rel="noopener noreferrer"';

				$html_link = '<a href="' . $route . '" alt="' . $result->name . '" class="xwslinked_keyword" ' . $target .'>' . $result->name . '</a>';

			} else if((int)$result->link_type === 2)
			{
				 $html_link = '<a href=' . JRoute::_('index.php?option=com_tags&view=tag&id=' . $result->tag) . '>' . $result->name . '</a>';
			}


			$pattern = '\'(?!<a[^>]*?>)(?!<script[^>]*?>)(' . $result->name . ')(?![^<]*?<\/a>)(?![^<]*?<\/script>)\'s';
			$replace = $html_link;

			$row->text = preg_replace($pattern, $replace, $row->text, $limit, $count);

//			if ($count === 0) {
//				$pattern = '\'(?!((<.*?)|(<a.*?)|(<script.*?)|(<style.*?)|(data-jmodediturl=")))(\b '.$result->name.' \b)(?!(([^<>]*?)>)|([^>]*?</a>)|([^>]*?</span></a>)|([^>]*?</script>)|([^>]*?</style>)|([^>]*?"))\'s' . $case;
//				$replace = ' ' . $html_link . ' ';
//
//				$row->text = preg_replace($pattern, $replace, $row->text, $limit, $count2);
//			}
//
//			if (isset($count2) && $count2 === 0) {
//				$pattern = '\'(?!((<.*?)|(<a.*?)|(<script.*?)|(<style.*?)|(data-jmodediturl=")))(\b'.$result->name.' \b)(?!(([^<>]*?)>)|([^>]*?</a>)|([^>]*?</span></a>)|([^>]*?</script>)|([^>]*?</style>)|([^>]*?"))\'s' . $case;
//				$replace = $html_link . ' ';
//
//				$row->text = preg_replace($pattern, $replace, $row->text, $limit, $count2);
//			}


			// Reset the count
			$count = null;
		}

	}
}