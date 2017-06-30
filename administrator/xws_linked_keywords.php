<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Xws_linked_keywords
 * @author     Tony Partridge <tony@xws.im>
 * @copyright  2017 Tony Partridge - Xtech Web Services Ltd
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_xws_linked_keywords'))
{
	throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
}

// Include dependancies
jimport('joomla.application.component.controller');

JLoader::registerPrefix('Xws_linked_keywords', JPATH_COMPONENT_ADMINISTRATOR);
JLoader::register('Xws_linked_keywordsHelper', JPATH_COMPONENT_ADMINISTRATOR . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'xws_linked_keywords.php');

$controller = JControllerLegacy::getInstance('Xws_linked_keywords');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
