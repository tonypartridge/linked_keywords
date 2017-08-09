<?php
/**
 * @version    1.0.3
 * @package    Com_Xws_linked_keywords
 * @author     Tony Partridge <tony@xws.im>
 * @copyright  2017 Tony Partridge - Xtech Web Services Ltd
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include dependancies
jimport('joomla.application.component.controller');

JLoader::registerPrefix('Xws_linked_keywords', JPATH_COMPONENT);
JLoader::register('Xws_linked_keywordsController', JPATH_COMPONENT . '/controller.php');


// Execute the task.
$controller = JControllerLegacy::getInstance('Xws_linked_keywords');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
