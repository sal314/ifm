<?php
/**
*	default.php
*
*	Template for displaying the interactive filtering module component
*/

// No direct access
defined('_JEXEC') or die('Restricted access');

// Dispatch to the right display
$task = JRequest::getVar('task');
switch ($task) {

	case 'find' :
		require_once ('default_prodlist.php');
		break;

	case 'gather' :
		require_once ('default_userinfo.php');
		break;

	case 'send' :
		require_once ('default_mailsent.php');
		break;

	default :
		require_once ('default_questions.php');
		break;
}
