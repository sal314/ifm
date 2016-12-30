<?php
/**
* ifm.php
*
*	Interactive Filtering Module model class
*/

// No direct access
 
defined( '_JEXEC' ) or die( 'Restricted access' );
 
jimport( 'joomla.application.component.model' );
 
/**
 *  IFM Model
 *
 */
class IFMModelIFM extends JModel
{
	var $questions = null;
	
	/**
	* Placeholder function for generic version
	*/
	function _loadQuestions() {
		// This accesses a database with question data
		return;
	}


    /**
    * Uses the input from the display page and searches
	* the database for possible matches.  Returns an array
	* of product names and descriptions
    */
    function getMatchingProducts()
	{
		$db =& JFactory::getDBO();

		$answers = $this->getUsersAnswers();

		$ct = $answers['concreteType'];
		$pt = $answers['pourType'];
		$slmp = $answers['slump'];
		$ps = $answers['pourSize'];
		$pr = $answers['pourRate'];
		$rif = $answers['reinforcement'];
		$flat = $answers['flatness'];
		$grA = $answers['gradeA'];
		$grB = $answers['gradeB'];
		$grC = $answers['gradeC'];
		$plA = $answers['placementA'];
		$plB = $answers['placementB'];
		$psg = $answers['prepSubGrade'];
		$wt = $answers['weight'];

		$where = "WHERE ";
		if ($ct != "") {
			$where .= "concreteType LIKE '%" . $ct . "%' AND ";
		}

		if ($pt != "") {
			$where .= "pourType LIKE '%" . $pt . "%' AND ";
		}

		if ($slmp != "") {
			$where .= "slump LIKE '%" . $slmp . "%' AND ";
		}
	
		if ($ps != "") {
			$where .= "pourSize LIKE '%" . $ps . "%' AND ";
		}

		if ($pr != "") {
			$where .= "pourRate LIKE '%" . $pr . "%' AND ";
		}

		if ($rif != "") {
			$where .= "reinforcement LIKE '%" . $rif . "%' AND ";
		}

		if ($flat != "") {
			$where .= "flatness LIKE '%" . $flat . "%' AND ";
		}
	
		$gr = "";
		if ($grA == "on") {
			$gr .= "grade LIKE '%A%' OR ";
		}
		if ($grB == "on") {
			$gr .= "grade LIKE '%B%' OR ";
		}
		if ($grC == "on") {
			$gr .= "grade LIKE '%C%' OR ";
		}
		if ($gr != "") {
			$gr = substr($gr, 0, strlen($gr)-4);
			$where .= "(" . $gr . ") AND ";
		}

		$pl = "";
		if ($plA == "on") {
			$pl .= "placement LIKE '%A%' OR ";
		}
		if ($plB == "on") {
			$pl .= "placement LIKE '%B%' OR ";
		}
		if ($pl != "") {
			$pl = substr($pl, 0, strlen($pl)-4);
			$where .= "(" . $pl . ") AND ";
		}

		if ($psg != "") {
			$where .= "prepSubGrade LIKE '%" . $psg . "%' AND ";
		}

		if ($wt != "") {
			$where .= "weight LIKE '%" . $wt . "%' AND ";
		}

		if ($where == "WHERE ") {
			$where .= "1";
		}
		else {
			$where = substr($where, 0, strlen($where) - 5);
		}

    	$query = "SELECT id, prodName, prodDesc, prodImage " .
	    	     	"FROM #__ifm_product_answers " . $where;

	    $db->setQuery($query, 0);
		$retArray = array();
		if ($rows = $db->loadObjectList()) {
			if (count($rows) == 0) {
				$where = "WHERE ";
				if ($ps != "") {
					$where .= "pourSize LIKE '%" . $ps . "%' AND ";
				}
				if ($pr != "") {
					$where .= "pourRate LIKE '%" . $pr . "%' AND ";
				}
				if ($where == "WHERE ") {
					$where .= "1";
				}
				else {
					$where = substr($where, 0, strlen($where) - 5);
				}
				$query = "SELECT id, prodName, prodDesc, prodImage " .
							"FROM #__ifm_product_answers " . $where;
				$db->setQuery($query, 0);
				$rows = $db->loadObjectList();
			}
		    foreach ($rows as $row) {
				array_push($retArray, array ("id"          => $row->id,
											 "ProdName"    => $row->prodName,
											 "ProdDesc"    => $row->prodDesc,
											 "ProdImage"   => $row->prodImage));
			}
		}
		else {
		}
		return $retArray;
	}


	/**
	* Get the answers to the array of questions used
	* to filter the products
	*/
	function getUsersAnswers () {

		$answers = IFMHelper::getInputVars();

		return $answers;
	}


	/**
	* Retrieve the basic product name/description/image
	* from the product filter table
	*/
	function getProductInfo () {

		$list = JRequest::getVar('prodList');

		$db =& JFactory::getDBO();

		$query = "Select id, prodName, prodDesc, prodImage " .
					"From #__ifm_product_answers " .
					"Where id In (" . $list . ")";
		$db->setQuery($query, 0);
		$retArray = array();
		if ($rows = $db->loadObjectList()) {
			foreach ($rows as $row) {
				array_push($retArray, array ("id"        => $row->id,
											 "ProdName"  => $row->prodName,
											 "ProdDesc"  => $row->prodDesc,
											 "ProdImage" => $row->prodImage));
			}
		}

		return $retArray;
	}


	/**
	* Get the posted variables from the contact info page
	*/
	function getUserContactInfo () {

		$contact = array ('FirstName'    => JRequest::getVar('fName'),
						  'LastName'     => JRequest::getVar('lName'),
						  'Company'      => JRequest::getVar('company'),
						  'Email'        => JRequest::getVar('email'),
						  'Phone'        => JRequest::getVar('phone'),
						  'UsedEquip'    => JRequest::getVar('usedEquip'),
						  'Familiar'     => JRequest::getVar('familiar'),
						  'PurchPref'    => JRequest::getVar('purchPref'));

		return $contact;
	}


	/**
	* Save the user's contact information along with all of the
	* answers to all of the questions.
	*/
	function addContactData () {

		$db =& JFactory::getDBO();

		$contact = $this->getUserContactInfo();

		$FirstName = mysql_real_escape_string($contact['fName']);
		$LastName = mysql_real_escape_string($contact['lName']);
		$Company = mysql_real_escape_string($contact['company']);
		$Email = mysql_real_escape_string($contact['email']);
		$Phone = mysql_real_escape_string($contact['phone']);
		$UsedEquip = $contact['usedEquip'];
		$Familiar = $contact['familiar'];
		$PurchPref = $contact['purchPref'];

		$FirstName = str_replace("'", "\\'", $FirstName);
		$LastName = str_replace("'", "\\'", $LastName);
		$Company = str_replace("'", "\\'", $Company);

		if ($UsedEquip == "used") {
			$UsedEquip = "Yes, I have used Somero equipment on the job";
		}
		else if ($UsedEquip == "rent") {
			$UsedEquip = "Yes, I have rented Somero for a job";
		}
		else if ($UsedEquip == "no") {
			$UsedEquip = "No, I have not used Somero equipment before";
		}

		if ($Familiar == "yes") {
			$Familiar = "Yes";
		}
		else if ($Familiar == "no") {
			$Familiar = "No";
		}

		if ($PurchPref == "finance") {
			$PurchPref = "Finance";
		}
		else if ($PurchPref == "lease") {
			$PurchPref = "Lease";
		}
		else if ($PurchPref == "loan") {
			$PurchPref = "Loan";
		}
		else if ($PurchPref == "cash") {
			$PurchPref = "Pay cash";
		}


		$answers = $this->getUsersAnswers();
		
		$ct = $answers['concreteType'];
		$pt = $answers['pourType'];
		$slmp = $answers['slump'];
		$ps = $answers['pourSize'];
		$pr = $answers['pourRate'];
		$rif = $answers['reinforcement'];
		$flat = $answers['flatness'];
		$grA = $answers['gradeA'];
		$grB = $answers['gradeB'];
		$grC = $answers['gradeC'];
		$plA = $answers['placementA'];
		$plB = $answers['placementB'];
		$psg = $answers['prepSubGrade'];
		$wt = $answers['weight'];

		if ($ct == "A") {
			$ct = "Standard";
		}
		else if ($ct == "B") {
			$ct = "Lite Weight";
		}
		else if ($ct == "C") {
			$ct = "Pervious";
		}

		if ($pt == "A") {
			$pt = "Interior";
		}
		else if ($pt == "B") {
			$pt = "Exterior";
		}

		if ($slmp == "A") {
			$slmp = "1 - 3\"";
		}
		else if ($slmp == "B") {
			$slmp = "4 - 6\"";
		}
		else if ($slmp == "C") {
			$slmp = "7\" or more";
		}

		if ($ps == "A") {
			$ps = "1 - 5K";
		}
		else if ($ps == "B") {
			$ps = "6 - 10K";
		}
		else if ($ps == "C") {
			$ps = "11 - 15K";
		}
		else if ($ps == "D") {
			$ps = "16 - 20K";
		}
		else if ($ps == "E") {
			$ps = "21K or more";
		}

		if ($pr == "A") {
			$pr = "1 - 5K";
		}
		else if ($pr == "B") {
			$pr = "6 - 10K";
		}
		else if ($pr == "C") {
			$pr = "10 - 20K";
		}
		else if ($pr == "D") {
			$pr = "21K or more";
		}

		if ($rif == "A") {
			$rif = "rebar";
		}
		else if ($rif == "B") {
			$rif = "wire mesh";
		}
		else if ($rif == "C") {
			$rif = "post tension";
		}

		if ($flat == "A") {
			$flat = "10 - 40 FL#s";
		}
		else if ($flat == "B") {
			$flat = "40 or more FL#s";
		}

		$grade = "";
		if ($grA == "on") {
			$grade .= "Single slope, ";
		}
		if ($grB == "on") {
			$grade .= "Dual slope, ";
		}
		if ($grC == "on") {
			$grade .= "Contour with mutiple grade changes, ";
		}
		$grade = substr($grade, 0, strlen($grade) - 2);

		$place = "";
		if ($plA == "on") {
			$place .= "Slab on grade, ";
		}
		if ($plB == "on") {
			$place .= "Slab on deck, ";
		}
		$place = substr($place, 0, strlen($place) - 2);

		if ($psg == "A") {
			$psg = "Yes";
		}
		else if ($psg == "B") {
			$psg = "No";
		}

		if ($wt == "A") {
			$wt = "Yes, we have concerns about heavy equipment on the deck";
		}
		else if ($wt == "B") {
			$wt = "No, deck can handle heavy equipment";
		}

		$query = "INSERT INTO #__ifm_contact_data (fname, lname, company, " .
						"email, phone, usedEquip, familiar, purchPref, " .
						"concreteType, pourType, slump, pourSize, pourRate, " .
						"reinforcement, flatness, grade, placement, " .
						"prepSubGrade, weight) " .
					"VALUES ('" . $FirstName . "', '" . $LastName . "', '" .
						$Company . "', '" . $Email . "', '" . $Phone . "', '" .
						$UsedEquip . "', '" . $Familiar . "', '" . $PurchPref .
						"', '" . $ct . "', '" . $pt . "', '" . $slmp . "', '" .
						$ps . "', '" . $pr . "', '" . $rif . "', '" . $flat .
						"', '" . $grade . "', '" . $place . "', '" . $psg .
						"', '" . $wt . "')";

		$db->setQuery($query, 0);
		$db->query();

		$StatBlk = array ('errno'   => $db->getErrorNum(),
						  'errmsg'  => $db->getErrorMsg(),
						  'query'   => $query);
		return $StatBlk;
	}

}
