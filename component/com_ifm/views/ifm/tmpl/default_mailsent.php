<?php
/**
*	default_mailsent.php
*
*	Template for sending an email to the sales contact
*	and displaying the email sent message for the
*	interactive filtering module component
*/

// No direct access
defined('_JEXEC') or die('Restricted access');

require_once('send_mail.php');

//	Send an email to a sales rep so that this user can
//	be contacted for further equipment discussions.

		$id = JRequest::getVar('Itemid');

		//
		// Build the email message for the sales rep
		//
		$body = "<body>Hello,<br /><br />";
		$body .= "The following customer has inquired about the products listed below.<br /><br /><br />";
		$body .= "  Customer name:  " . $this->contact['FirstName'] . " " . $this->contact['LastName'] . "<br />";
		if ($this->contact['Company'] != "") {
			$body .= "  Company:        " . $this->contact['Company'] . "<br />";
		}
		$body .= "  Email:          " . $this->contact['Email'] . "<br />";
		if ($this->contact['Phone'] != "") {
			$body .= "  Phone:            " . $this->contact['Phone'] . "<br />";
		}
		$body .= "<br />";
		$body .= "Have you used our equipment before?<br />";
		if ($this->contact['UsedEquip'] == "used") {
			$body .= "    Yes, I have used Somero equipment on the job<br />";
		}
		else if ($this->contact['UsedEquip'] == "rented") {
			$body .= "    Yes, I have rented Somero equipment for a job<br />";
		}
		else if ($this->contact['UsedEquip'] == "no") {
			$body .= "    No, I have not used Somero equipment before<br />";
		}
		$body .= "<br />";
		$body .= "Are you familiary with laser operated equipment?<br />";
		if ($this->contact['Familiar'] == "yes") {
			$body .= "    Yes<br />";
		}
		else if ($this->contact['Familiar'] == "no") {
			$body .= "    No<br />";
		}
		$body .= "<br />";
		$body .= "Purchase preference<br />";
		if ($this->contact['PurchPref'] == "finance") {
			$body .= "    Finance<br />";
		}
		else if ($this->contact['PurchPref'] == "lease") {
			$body .= "    Lease<br />";
		}
		else if ($this->contact['PurchPref'] == "loan") {
			$body .= "    Loan<br />";
		}
		else if ($this->contact['PurchPref'] == "cash") {
			$body .= "    Pay cash<br />";
		}
		$body .= "<br />";
		$body .= "Products:<br />";
		foreach ($this->prodList as $prod) {
			$body .= "    " . $prod["ProdName"] . "<br />";
		}
		$body .= "<br />";
		$body .= "<br />";
		$body .= "</body>";

		//
		// Send the email
		//
		$EmailSent = true;
		$Err = "";
		$fh = fopen("/home/inhausd1/somero.data.txt", "r");
		if ($fh) {
			$To = "";
			while (!feof($fh)) {
				$tmp = fgets($fh);
				$tmp = substr($tmp, 0, strlen($tmp) - 1);
				$tmp = str_replace("/|\\", "@", $tmp);
				$To .= $tmp . ",";
			}
			$To = substr($To, 0, strlen($To) - 1);
			fclose($fh);
			$Subj = "Contact request";
			$From = $this->contact['Email'];
			$Name = $this->contact['FirstName'] . " " . $this->contact['LastName'];

			$domain = explode("@", $From);
			$valid = checkdnsrr($domain[1], "ANY");
			if ($valid) {
				$stat = send_mail($To, $body, $Subj, $From, $Name, false);
				if (!$stat) {
					$Err = "Error from send_email !";
					$EmailSent = false;
				}
			}
			else {
				$Err = "The input email address ( " . $From . " ) could not be valididated.  No contact information will be sent.  Please contact Somero for help with the products that were listed.";
				$EmailSent = false;
			}
		}
		else {
			$Err = "Somero data file could not be opened";
			$EmailSent = false;
		}
			
		if ($this->status['errno'] != 0) {
?>
<div style="background-color:#FF99FF">
<br />
<h4>Database Insert Error</h4>
<br />
SQL: <?php echo $this->status['query']; ?>
<br />
<br />
Error: <?php echo $this->status['errmsg']; ?>
<br />
</div>
<?php
		}
		if ($Err != "") {
?>
<div style="background-color:#FF99FF">
<br />
<h4>Email</h4>
<br />
<?php echo $Err; ?>
<br />
</div>
<?php
		}
?>
<form name="frmSent" id="id_frmSent" method="post" action="index.php?option=com_ifm&Itemid=<?php echo $id; ?>">
<?php
		if ($EmailSent) {
?>

<div style="height:5px;"></div>
<div style="border:1px solid #ccc;width:684px;" align="left">
<img src="images/stories/decisioncenter/decisioncenter.jpg" width="684" height="285" border="0" /><br />
<img src="images/stories/decisioncenter/speakdirectly.jpg" width="684" height="88" border="0" />

	<h2 style="padding-left:15px;">Email sent</h2>
	<p style="padding-left:15px;">An email was sent with your contact information to a Somero rep.  The rep will be  contacting you soon.  Thank you for your interest in Somero products.</p>
<?php
		}
?>
	<br />
	<br />
	<input style="margin-left:150px;" name="continue" value="Continue" type="image" src="images/stories/decisioncenter/backto_decisioncenter.png" />

</div>
</div>
</form>
