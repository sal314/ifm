<?php
/**
*	default_userinfo.php
*
*	Template for displaying the user contact info
*	form for the interactive filtering module component
*/

// No direct access
defined('_JEXEC') or die('Restricted access');

$id = JRequest::getVar('Itemid');

//	Get the user's contact information.
?>
<script language="javascript" type="text/javascript">
//
// Check user input for mandatory fields
//
function checkInput () {
	var fname = document.getElementById('id_fName');
	if (fname.value.length == 0) {
		alert ('First name is required');
		fname.focus();
		return false;
	}

	var lname = document.getElementById('id_lName');
	if (lname.value.length == 0) {
		alert ('Last name is required');
		lname.focus();
		return false;
	}

	var email = document.getElementById('id_email');
	if (email.value.length == 0) {
		alert ('Email address is required');
		email.focus();
		return false;
	}

	var used = document.getElementById('id_used');
	var rent = document.getElementById('id_rent');
	var nouse = document.getElementById('id_use_no');
	if ((!used.checked) &&
	    (!rent.checked) &&
		(!nouse.checked)) {
		alert('Somero equipment use question must be answered');
		return false;
	}

	var fyes = document.getElementById('id_fam_yes');
	var fno = document.getElementById('id_fam_no');
	if ((!fyes.checked) &&
		(!fno.checked)) {
		alert('Laser equipment question must be answered');
		return false;
	}

	var pfin = document.getElementById('id_pur_fin');
	var plea = document.getElementById('id_pur_lease');
	var ploa = document.getElementById('id_pur_loan');
	var pcas = document.getElementById('id_pur_cash');
	if ((!pfin.checked) &&
		(!plea.checked) &&
		(!ploa.checked) &&
		(!pcas.checked)) {
		alert('Purchase preference must be answered');
		return false;
	}

	return true;
}

</script>
<form name="frmCustInfo" id="id_CustInfo" method="post" action="index.php?option=com_ifm&task=send&Itemid=<?php echo $id; ?>">

	<input type="hidden" name="prodList" value="<?php echo JRequest::getVar('prodList'); ?>" />
	<input type="hidden" name="concreteType" value="<?php echo $this->answers['concreteType']; ?>" />
	<input type="hidden" name="pourType" value="<?php echo $this->answers['pourType']; ?>" />
	<input type="hidden" name="slump" value="<?php echo $this->answers['slump']; ?>" />
	<input type="hidden" name="pourSize" value="<?php echo $this->answers['pourSize']; ?>" />
	<input type="hidden" name="pourRate" value="<?php echo $this->answers['pourRate']; ?>" />
	<input type="hidden" name="reinforcement" value="<?php echo $this->answers['reinforcement']; ?>" />
	<input type="hidden" name="flatness" value="<?php echo $this->answers['flatness']; ?>" />
	<input type="hidden" name="gradeA" value="<?php echo $this->answers['gradeA']; ?>" />
	<input type="hidden" name="gradeB" value="<?php echo $this->answers['gradeB']; ?>" />
	<input type="hidden" name="gradeC" value="<?php echo $this->answers['gradeC']; ?>" />
	<input type="hidden" name="placementA" value="<?php echo $this->answers['placementA']; ?>" />
	<input type="hidden" name="placementB" value="<?php echo $this->answers['placementB']; ?>" />
	<input type="hidden" name="prepSubGrade" value="<?php echo $this->answers['prepSubGrade']; ?>" />
	<input type="hidden" name="weight" value="<?php echo $this->answers['weight']; ?>" />

<div style="height:5px;"></div>
<div style="border:1px solid #ccc;width:684px;" align="left">
<img src="images/stories/decisioncenter/decisioncenter.jpg" width="684" height="285" border="0" /><br />
<img src="images/stories/decisioncenter/speakdirectly.jpg" width="684" height="88" border="0" />

	<h2 style="padding-left:15px;">For more information, contact your rep at 906-482-7252</h2>

	<p style="padding-left:15px;">To find how Somero's innovative products can improve the quality and speed of your next project, while reducing manpower, please answer these quick questions and a rep will be in contact with you soon.</p>

 <div style="background-color:#f5f5f5;border:17px solid #fff;padding:0px;">

	<div style="position:relative; height:600px;">

	<span style="position:absolute; left:40px; top:25px;">First Name:</span>
	<input style="position:absolute; left:190px; top:25px;" name="fName" id="id_fName" type="text" />
	<span style="position:absolute; left:40px; top:50px;">Last Name:</span>
	<input style="position:absolute; left:190px; top:50px;" name="lName" id="id_lName" type="text" />
	<span style="position:absolute; left:40px; top:75px;">Company (optional):</span>
	<input style="position:absolute; left:190px; top:75px;" name="company" type="text" />
	<span style="position:absolute; left:40px; top:100px;">Your Email:</span>
	<input style="position:absolute; left:190px; top:100px;" name="email" id="id_email" type="text" />
	<span style="position:absolute; left:40px; top:125px;">Phone (optional):</span>
	<input style="position:absolute; left:190px; top:125px;" name="phone" type="text" />

<img src="images/stories/decisioncenter/horz_divider.png" width="617" height="13" border="0" style="padding-left:15px;position:absolute;top:160px;" />

	<div style="position:absolute; left:40px; top:175px;">
	<span class="num">1.</span> <strong>Have you used our equipment before?</strong><br />
	<input style="margin-left:40px;" name="usedEquip" id="id_used" value="used" type="radio" />Yes, I used Somero equipment on the job<br />
	<input style="margin-left:40px;" name="usedEquip" id="id_rent" value="rented" type="radio" />Yes, I rented Somero for a job<br />
	<input style="margin-left:40px;" name="usedEquip" id="id_use_no" value="no" type="radio" />No, I have not used Somero equipment before<br />
	</div>

<img src="images/stories/decisioncenter/horz_divider.png" width="617" height="13" border="0" style="padding-left:15px;position:absolute;top:265px;" />

	<div style="position:absolute; left:40px; top:275px;">
	<span class="num">2.</span> <strong>Are you familiar with laser operated equipment?</strong><br />
	<input style="margin-left:40px;" name="familiar" value="yes" id="id_fam_yes" type="radio" />Yes<br />
	<input style="margin-left:40px;" name="familiar" value="no" id="id_fam_no" type="radio" />No<br />
	</div>

<img src="images/stories/decisioncenter/horz_divider.png" width="617" height="13" border="0" style="padding-left:15px;position:absolute;top:345px;" />

	<div style="position:absolute; left:40px; top:355px;">
	<span class="num">3.</span> <strong>Purchase Preference</strong><br />
	<input style="margin-left:40px;" name="purchPref" value="finance" id="id_pur_fin" type="radio" />Finance<br />
	<input style="margin-left:40px;" name="purchPref" value="lease" id="id_pur_lease" type="radio" />Lease<br />
	<input style="margin-left:40px;" name="purchPref" value="loan" id="id_pur_loan" type="radio" />Loan<br />
	<input style="margin-left:40px;" name="purchPref" value="cash" id="id_pur_cash" type="radio" />Pay Cash<br />
	</div>

	<div style="position:absolute; left:40px; top:490px;">
	<input style="margin-left:100px;" name="Send" value="Send request" type="image" src="images/stories/decisioncenter/final_submit.png" onclick="return checkInput();" />
	</div>
	
	</div></div></div>
</form>
