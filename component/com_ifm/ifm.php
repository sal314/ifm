<?php
/**
* @version $Id: ifm.php 1.1 2009-12-18 11:13
* @copyright Copyright (C) 2009 InHaus Media, LLC
* @package IFM
*
* This component asks a series of questions and then uses the
* answers to suggest possible products to meet the customers
* needs.
*/

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
 
//Pull in the CSS
$document=& JFactory::getDocument();
$stylesheet = 'components/com_ifm/css/ifm.css';
$document->addStyleSheet($stylesheet, 'text/css' );

// Require the base controller
require_once( JPATH_COMPONENT.DS.'controller.php' );

// Require specific controller if requested
if($controller = JRequest::getVar('controller')) {
    $path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
    if (file_exists($path)) {
        require_once $path;
    } else {
        $controller = '';
    }
}

// Require the helper
require_once (JPATH_COMPONENT.DS.'helpers'.DS.'helper.php');
 
// Create the controller
$classname    = 'IFMController'.$controller;
$controller   = new $classname( );
 
// Perform the Request task
$controller->execute( JRequest::getVar( 'task' ) );
 
// Redirect if set by the controller
$controller->redirect();
