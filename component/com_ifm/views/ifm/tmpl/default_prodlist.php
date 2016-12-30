<?php
/**
*	default.php
*
*	Template for displaying the results list 
*	of the interactive filtering module component
*/

// No direct access
defined('_JEXEC') or die('Restricted access');


//	Show all matching equipment based on the user's answers
//	to the list of questions

$id = JRequest::getVar('Itemid');
?>
<script language="javascript" type="text/javascript">
//
// Contact Me
//
function sendContact(list) {
	var prod = document.getElementById('id_prodList');
	prod.value = list;
	var frm = document.getElementById('frmProdList');
	frm.action = "index.php?option=com_ifm&task=gather&Itemid=<?php echo $id; ?>";
	frm.submit();
	return true;
}
	
</script>
<form name="frmProdList" id="frmProdList" method="post" action="index.php?option=com_ifm&Itemid=<?php echo $id; ?>">
	<input type="hidden" name="prodList" id="id_prodList" />
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

<div style="border:1px solid #ccc;width:684px;">
<img src="images/stories/decisioncenter/decisioncenter.jpg" width="684" height="285" border="0" /><br />
<img src="images/stories/decisioncenter/speakdirectly.jpg" width="684" height="88" border="0" />
 <h2 style="padding-left:15px;">Based on your answers, these are some of the Somero products that might suit your job!</h2>
 <div style="border:17px solid #fff;padding:0px;">

	<br />
<?php
		$plist = "";
		if (count($this->products) > 0) {
?>

	<table cellpadding="0" cellspacing="0" border="0">
<?php

			foreach ($this->products as $prod) {
?>
		<tr bgcolor="#f5f5f5">
		  <td style="padding:20px;border-top:1px solid #ccc;border-bottom:2px solid #ccc;border-left:1px solid #ccc;">
		  	<table cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td style="font-weight:bold;font-size:16px;"><?php echo $prod["ProdName"]; ?></td>
				</tr>
				<tr>
					<td><?php echo $prod["ProdDesc"]; ?></td>
				</tr>
			</table>
		  </td>
		  <td bgcolor="#ffffff" style="padding-left:20px;border-top:1px solid #ccc;border-right:1px solid #ccc;border-bottom:2px solid #ccc;" align="center">
		    <img src="images/stories/decisioncenter/<?php echo $prod["ProdImage"]; ?>" />
		  </td>
		</tr>
		<tr>
		  <td height="10">&nbsp;</td>
		</tr>
<?php
				$plist .= $prod["id"] . ",";
			}
			$plist = substr($plist, 0, strlen($plist)-1);
?>
	</table>

	<br />
<?php
		}
		else {
?>
	<h5>No products were found to match - try again</h5>
<?php
		}
?>
	<br />
	<input type="image" name="Submit" src="images/stories/decisioncenter/back_to_questions.png" value="Return to questions" />
<?php
		if (strlen($plist) > 0) {
?>
	&nbsp;&nbsp;&nbsp;
	<input type="image" name="AskAPro" src="images/stories/decisioncenter/contact_me_about_these.png" value="Contact Me About These" onclick="return sendContact('<?php echo $plist; ?>')" />
	<br />
<?php
		}
?>
	<br />
	
 </div>
</div>
</form>