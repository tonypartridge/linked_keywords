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

jimport('joomla.application.component.controllerform');

/**
 * Xwskeyword controller class.
 *
 * @since  1.6
 */
class Xws_linked_keywordsControllerXwskeyword extends JControllerForm
{
	/**
	 * Constructor
	 *
	 * @throws Exception
	 */
	public function __construct()
	{
		$this->view_list = 'xwskeywords';
		parent::__construct();
	}
}
