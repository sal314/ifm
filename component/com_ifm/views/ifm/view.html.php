<?php
/**
 * @package    ifm
 * @subpackage Components
 * @license    GNU/GPL
*/
 
// no direct access
 
defined( '_JEXEC' ) or die( 'Restricted access' );
 
jimport( 'joomla.application.component.view');
 
/**
 * HTML View class for the Interactive Filtering Module Component
 *
 * @package    ifm
 */
 
class ifmViewifm extends JView
{
    function display($tpl = null)
    {
		switch (JRequest::getVar('task')) {
			case 'find' :
				$model =& $this->getModel();

				$answers = IFMHelper::getInputVars();
				$this->assignRef ('answers', $answers);

				$products = $model->getMatchingProducts();
				$this->assignRef ('products', $products);
				break;

			case 'gather' :
				$model =& $this->getModel();

				$answers = IFMHelper::getInputVars();
				$this->assignRef ('answers', $answers);
				break;

			case 'send' :
				$model =& $this->getModel();

				$products = $model->getProductInfo();
				$this->assignRef ('prodList', $products);

				$contact = $model->getUserContactInfo();
				$this->assignRef ('contact', $contact);

				$Status = $model->addContactData();
				$this->assignRef ('status', $Status);
				break;

			default :
				break;
		}

    	parent::display($tpl);
    }
}
