<?php
/**
* @version $Id: admin.ifm.php 2009-12-16 4:19
* @copyright Copyright (C) 2009 InHaus Media, LLC.  All rights reserved.
* @package ifm
*
* This module is the administrative piece of the interactive filtering
* module component for the Somero web site.
*/

// no direct access
defined ('_JEXEC') or die ('Restricted access');

//Check the input task variable and dispatch
switch (JRequest::getVar('task')) {
	case 'change' :
		changeProd();
		break;
	case 'update' :
		updateProd();
		break;
	case 'add' :
		addProd();
		break;
	case 'insert' :
		insertProd();
		break;
	default :
		showProd();
		break;
}


// ChangeProd()
//
//	Show all options for the selected product and allow them
//	to be changed.
//
function changeProd() {
//	JMenuBar::title(JText::_('Change product answers'), 'addedit.php');

	$db =& JFactory::getDBO();
	$pid = JRequest::getVar('id');
	$query = sprintf("SELECT * FROM #__ifm_product_answers WHERE id = %d", $pid);
	$db->setQuery($query, 0);
	if ($rows = $db->loadObjectList()) {
		$prodName = $rows[0]->prodName;
		$prodDesc = $rows[0]->prodDesc;
		$prodImage = $rows[0]->prodImage;
		$conTyp = $rows[0]->concreteType;
		$pourTyp = $rows[0]->pourType;
		$slmp = $rows[0] ->slump;
		$pourSiz = $rows[0]->pourSize;
		$pourRat = $rows[0]->pourRate;
		$rein = $rows[0]->reinforcement;
		$flat = $rows[0]->flatness;
		$grad = $rows[0]->grade;
		$plac = $rows[0]->placement;
		$prep = $rows[0]->prepSubGrade;
		$wt = $rows[0]->weight;

?>
<script type="text/javascript" language="javascript">
//
// Cancel button action routine
//
function cancelUpd () {
	var frm = document.getElementById('frmChange');
	frm.action = "index.php?option=com_ifm";
	frm.submit();
	return true;
}
</script>

<h3>Change interactive filtering module product answers</h3>
<form name="frmChange" id="frmChange" method="post" action="index.php?option=com_ifm&amp;task=update">
	<input type="hidden" name="id" value="<?php echo $pid; ?>" />
	<h4 style="margin-left: 10px;">Product: <?php echo $prodName; ?></h4>
	<br />

	<div style="position: relative; margin-left:25px; height:30px;">
	  <div style="position: absolute; left:0; top:0;">
	  Product Description:
	  </div>
	  <div style="position: absolute; left:180px; top:0;">
	  <input type="text" name="prodDesc" size="100" maxlength="255" value="<?php echo $prodDesc; ?>" />
	  </div>
	</div>
	<br />
	<div style="position: relative; margin-left:25px; height:30px;">
	  <div style="position: absolute; left:0; top:0;">
	  Product Image:
	  </div>
	  <div style="position: absolute; left:180px; top:0">
	  <input type="text" name="prodImage" size="35" maxlength="255" value="<?php echo $prodImage; ?>" />
	  </div>
	</div>
	<br />
	<hr style="width:85%" />

    <div style="position: relative; margin-left: 25px; height: 25px;">
	What type of concrete will you be using?
	</div>
<?php
		if (strpos(" " . $conTyp, "A")) {
			$y = 'checked="checked"';
			$n = "";
		}
		else {
			$y = "";
			$n = 'checked="checked"';
		}
?>
	<div style="position: relative; height: 60px;">
	<div style="position: absolute; left: 50px; top: 0;">
	  <span>Standard</span>
	</div>
	<div style="position: absolute; left: 150px; top: 0;">
	  <input type="radio" name="ConTypStd" value="Y" <?php echo $y; ?> />Yes
	  <input type="radio" name="ConTypStd" value="N" <?php echo $n; ?> />No
	</div>
<?php
		if (strpos(" " . $conTyp, "B")) {
			$y = 'checked="checked"';
			$n = "";
		}
		else {
			$y = "";
			$n = 'checked="checked"';
		}
?>
	<div style="position:absolute; left:50px; top:20px;">
	<span>Lite Weight</span>
	</div>
	<div style="position:absolute; left:150px; top:20px;">
	<input type="radio" name="ConTypLW" value="Y" <?php echo $y; ?> />Yes
	<input type="radio" name="ConTypLW" value="N" <?php echo $n; ?> />No
	</div>
<?php
		if (strpos(" " . $conTyp, "C")) {
			$y = 'checked="checked"';
			$n = "";
		}
		else {
			$y = "";
			$n = 'checked="checked"';
		}
?>
	<div style="position:absolute; left:50px; top:40px;">
	<span>Pervious</span>
	</div>
	<div style="position:absolute; left:150px; top:40px;">
	<input type="radio" name="ConTypPerv" value="Y" <?php echo $y; ?> />Yes
	<input type="radio" name="ConTypPerv" value="N" <?php echo $n; ?> />No
	</div>
	</div>

	<div style="position:relative; margin-left: 25px; margin-top: 20px; height:25px;">
	Is your project interior or exterior?
	</div>
<?php
		if (strpos(" " . $pourTyp, "A")) {
			$y = 'checked="checked"';
			$n = "";
		}
		else {
			$y = "";
			$n = 'checked="checked"';
		}
?>
	<div style="position:relative; height:40px;">
	<div style="position:absolute; left:50px; top:0;">
	  <span>Interior</span>
	</div>
	<div style="position:absolute; left:150px; top:0;">
	  <input type="radio" name="PourTypInt" value="Y" <?php echo $y; ?> />Yes
	  <input type="radio" name="PourTypInt" value="N" <?php echo $n; ?> />No
	</div>
<?php
		if (strpos(" " . $pourTyp, "B")) {
			$y = 'checked="checked"';
			$n = "";
		}
		else {
			$y = "";
			$n = 'checked="checked"';
		}
?>
	<div style="position:absolute; left:50px; top:20px;">
	  <span>Exterior</span>
	</div>
	<div style="position:absolute; left:150px; top:20px;">
	  <input type="radio" name="PourTypExt" value="Y" <?php echo $y; ?> />Yes
	  <input type="radio" name="PourTypExt" value="N" <?php echo $n; ?> />No
	</div>
	</div>



	<div style="position:relative; margin-left:25px; margin-top:20px; height: 25px;">
	What is the grade of your pour? (check all that applies)
	</div>
<?php
		if (strpos(" " . $grad, "A")) {
			$y = 'checked="checked"';
			$n = "";
		}
		else {
			$y = "";
			$n = 'checked="checked"';
		}
?>
	<div style="position:relative; height:60px;">
	<div style="position:absolute; left:50px; top:0;">
	  <span>Single slope</span>
	</div>
	<div style="position:absolute; left:150px; top:0;">
	  <input type="radio" name="GradSingle" value="Y" <?php echo $y; ?> />Yes
	  <input type="radio" name="GradSingle" value="N" <?php echo $n; ?> />No
	</div>
<?php
		if (strpos(" " . $grad, "B")) {
			$y = 'checked="checked"';
			$n = "";
		}
		else {
			$y = "";
			$n = 'checked="checked"';
		}
?>
	<div style="position:absolute; left:50px; top:20px;">
	  <span>Dual slope</span>
	</div>
	<div style="position:absolute; left:150px; top:20px;">
	  <input type="radio" name="GradDual" value="Y" <?php echo $y; ?> />Yes
	  <input type="radio" name="GradDual" value="N" <?php echo $n; ?> />No
	</div>
<?php
		if (strpos(" " . $grad, "C")) {
			$y = 'checked="checked"';
			$n = "";
		}
		else {
			$y = "";
			$n = 'checked="checked"';
		}
?>
	<div style="position:absolute; left:50px; top:40px;">
	  <span>Multi grade<br />changes</span>
	</div>
	<div style="position:absolute; left:150px; top:40px;">
	  <input type="radio" name="GradMulti" value="Y" <?php echo $y; ?> />Yes
	  <input type="radio" name="GradMulti" value="N" <?php echo $n; ?> />No
	</div>
	</div>



	<div style="position:relative; margin-left: 25px; margin-top: 20px; height:25px;">
	What is your projects typical slump?
	</div>
<?php
		if (strpos(" " . $slmp, "A")) {
			$y = 'checked="checked"';
			$n = "";
		}
		else {
			$y = "";
			$n = 'checked="checked"';
		}
?>
	<div style="position:relative; height:60px;">
	<div style="position:absolute; left:50px; top:0;">
	  <span>1 - 3&quot;</span>
	</div>
	<div style="position:absolute; left:150px; top:0;">
	  <input type="radio" name="Slump3" value="Y" <?php echo $y; ?> />Yes
	  <input type="radio" name="Slump3" value="N" <?php echo $n; ?> />No
	</div>
<?php
		if (strpos(" " . $slmp, "B")) {
			$y = 'checked="checked"';
			$n = "";
		}
		else {
			$y = "";
			$n = 'checked="checked"';
		}
?>
	<div style="position:absolute; left:50px; top:20px;">
	  <span>4 - 6&quot;</span>
	</div>
	<div style="position:absolute; left:150px; top:20px;">
	  <input type="radio" name="Slump4" value="Y" <?php echo $y; ?> />Yes
	  <input type="radio" name="Slump4" value="N" <?php echo $n; ?> />No
	</div>
<?php
		if (strpos(" " . $slmp, "C")) {
			$y = 'checked="checked"';
			$n = "";
		}
		else {
			$y = "";
			$n = 'checked="checked"';
		}
?>
	<div style="position:absolute; left:50px; top:40px;">
	  <span>7&quot; or more</span>
	</div>
	<div style="position:absolute; left:150px; top:40px;">
	  <input type="radio" name="Slump5" value="Y" <?php echo $y; ?> />Yes
	  <input type="radio" name="Slump5" value="N" <?php echo $n; ?> />No
	</div>
	</div>


	<div style="position:relative; margin-left: 25px; margin-top: 20px; height:25px;">
	What is the average pour size?
	</div>
<?php
		if (strpos(" " . $pourSiz, "A")) {
			$y = 'checked="checked"';
			$n = "";
		}
		else {
			$y = "";
			$n = 'checked="checked"';
		}
?>
	<div style="position:relative; height:100px;">
	<div style="position:absolute; left:50px; top:0;">
	  <span>1 - 5K</span>
	</div>
	<div style="position:absolute; left:150px; top:0;">
	  <input type="radio" name="PourSize1" value="Y" <?php echo $y; ?> />Yes
	  <input type="radio" name="PourSize1" value="N" <?php echo $n; ?> />No
	</div>
<?php
		if (strpos(" " . $pourSiz, "B")) {
			$y = 'checked="checked"';
			$n = "";
		}
		else {
			$y = "";
			$n = 'checked="checked"';
		}
?>
	<div style="position:absolute; left:50px; top:20px;">
	  <span>6 - 10K</span>
	</div>
	<div style="position:absolute; left:150px; top:20px;">
	  <input type="radio" name="PourSize6" value="Y" <?php echo $y; ?> />Yes
	  <input type="radio" name="PourSize6" value="N" <?php echo $n; ?> />No
	</div>
<?php
		if (strpos(" " . $pourSiz, "C")) {
			$y = 'checked="checked"';
			$n = "";
		}
		else {
			$y = "";
			$n = 'checked="checked"';
		}
?>
	<div style="position:absolute; left:50px; top:40px;">
	  <span>11 - 15K</span>
	</div>
	<div style="position:absolute; left:150px; top:40px;">
	  <input type="radio" name="PourSize11" value="Y" <?php echo $y; ?> />Yes
	  <input type="radio" name="PourSize11" value="N" <?php echo $n; ?> />No
	</div>
<?php
		if (strpos(" " . $pourSiz, "D")) {
			$y = 'checked="checked"';
			$n = "";
		}
		else {
			$y = "";
			$n = 'checked="checked"';
		}
?>
	<div style="position:absolute; left:50px; top:60px;">
	  <span>16 - 20K</span>
	</div>
	<div style="position:absolute; left:150px; top:60px;">
	  <input type="radio" name="PourSize16" value="Y" <?php echo $y; ?> />Yes
	  <input type="radio" name="PourSize16" value="N" <?php echo $n; ?> />No
	</div>
<?php
		if (strpos(" " . $pourSiz, "E")) {
			$y = 'checked="checked"';
			$n = "";
		}
		else {
			$y = "";
			$n = 'checked="checked"';
		}
?>
	<div style="position:absolute; left:50px; top:80px;">
	  <span>21K or more</span>
	</div>
	<div style="position:absolute; left:150px; top:80px;">
	  <input type="radio" name="PourSize21" value="Y" <?php echo $y; ?> />Yes
	  <input type="radio" name="PourSize21" value="N" <?php echo $n; ?> />No
	</div>
	</div>


	<div style="position:relative; margin-left: 25px; margin-top: 20px; height:25px;">
	Average production per hour
	</div>
<?php
		if (strpos(" " . $pourRat, "A")) {
			$y = 'checked="checked"';
			$n = "";
		}
		else {
			$y = "";
			$n = 'checked="checked"';
		}
?>
	<div style="position:relative; height:80px;">
	<div style="position:absolute; left:50px; top:0;">
	  <span>1 - 5K</span>
	</div>
	<div style="position:absolute; left:150px; top:0;">
	  <input type="radio" name="PourRate1" value="Y" <?php echo $y; ?> />Yes
	  <input type="radio" name="PourRate1" value="N" <?php echo $n; ?> />No
	</div>
<?php
		if (strpos(" " . $pourRat, "B")) {
			$y = 'checked="checked"';
			$n = "";
		}
		else {
			$y = "";
			$n = 'checked="checked"';
		}
?>
	<div style="position:absolute; left:50px; top:20px;">
	  <span>6 - 10K</span>
	</div>
	<div style="position:absolute; left:150px; top:20px;">
	  <input type="radio" name="PourRate6" value="Y" <?php echo $y; ?> />Yes
	  <input type="radio" name="PourRate6" value="N" <?php echo $n; ?> />No
	</div>
<?php
		if (strpos(" " . $pourRat, "C")) {
			$y = 'checked="checked"';
			$n = "";
		}
		else {
			$y = "";
			$n = 'checked="checked"';
		}
?>
	<div style="position:absolute; left:50px; top:40px;">
	  <span>11 - 20K</span>
	</div>
	<div style="position:absolute; left:150px; top:40px;">
	  <input type="radio" name="PourRate11" value="Y" <?php echo $y; ?> />Yes
	  <input type="radio" name="PourRate11" value="N" <?php echo $n; ?> />No
	</div>
<?php
		if (strpos(" " . $pourRat, "D")) {
			$y = 'checked="checked"';
			$n = "";
		}
		else {
			$y = "";
			$n = 'checked="checked"';
		}
?>
	<div style="position:absolute; left:50px; top:60px;">
	  <span>21K or more</span>
	</div>
	<div style="position:absolute; left:150px; top:60px;">
	  <input type="radio" name="PourRate21" value="Y" <?php echo $y; ?> />Yes
	  <input type="radio" name="PourRate21" value="N" <?php echo $n; ?> />No
	</div>
	</div>


	<div style="position:relative; margin-left: 25px; margin-top: 20px; height:25px;">
	Type of slab reinforcement
	</div>
<?php
		if (strpos(" " . $rein, "A")) {
			$y = 'checked="checked"';
			$n = "";
		}
		else {
			$y = "";
			$n = 'checked="checked"';
		}
?>
	<div style="position:relative; height:60px;">
	<div style="position:absolute; left:50px; top:0;">
	  <span>Rebar</span>
	</div>
	<div style="position:absolute; left:150px; top:0;">
	  <input type="radio" name="ReinRebar" value="Y" <?php echo $y; ?> />Yes
	  <input type="radio" name="ReinRebar" value="N" <?php echo $n; ?> />No
	</div>
<?php
		if (strpos(" " . $rein, "B")) {
			$y = 'checked="checked"';
			$n = "";
		}
		else {
			$y = "";
			$n = 'checked="checked"';
		}
?>
	<div style="position:absolute; left:50px; top:20px;">
	  <span>Wire mesh</span>
	</div>
	<div style="position:absolute; left:150px; top:20px;">
	  <input type="radio" name="ReinWire" value="Y" <?php echo $y; ?> />Yes
	  <input type="radio" name="ReinWire" value="N" <?php echo $n; ?> />No
	</div>
<?php
		if (strpos(" " . $rein, "C")) {
			$y = 'checked="checked"';
			$n = "";
		}
		else {
			$y = "";
			$n = 'checked="checked"';
		}
?>
	<div style="position:absolute; left:50px; top:40px;">
	  <span>Post tension</span>
	</div>
	<div style="position:absolute; left:150px; top:40px;">
	  <input type="radio" name="ReinPost" value="Y" <?php echo $y; ?> />Yes
	  <input type="radio" name="ReinPost" value="N" <?php echo $n; ?> />No
	</div>
	</div>

	<div style="position:relative; margin-left: 25px; margin-top: 20px; height:25px;">
	What floor flatness are you trying to achieve?
	</div>
<?php
		if (strpos(" " . $flat, "A")) {
			$y = 'checked="checked"';
			$n = "";
		}
		else {
			$y = "";
			$n = 'checked="checked"';
		}
?>
	<div style="position:relative; height:40px;">
	<div style="position:absolute; left:50px; top:0;">
	  <span>10 - 40 FL#s</span>
	</div>
	<div style="position:absolute; left:150px; top:0;">
	  <input type="radio" name="FlatQ1" value="Y" <?php echo $y; ?> />Yes
	  <input type="radio" name="FlatQ1" value="N" <?php echo $n; ?> />No
	</div>
<?php
		if (strpos(" " . $flat, "B")) {
			$y = 'checked="checked"';
			$n = "";
		}
		else {
			$y = "";
			$n = 'checked="checked"';
		}
?>
	<div style="position:absolute; left:50px; top:20px;">
	  <span>40 or more FL#s</span>
	</div>
	<div style="position:absolute; left:150px; top:20px;">
	  <input type="radio" name="FlatQ2" value="Y" <?php echo $y; ?> />Yes
	  <input type="radio" name="FlatQ2" value="N" <?php echo $n; ?> />No
	</div>
	</div>


	<div style="position:relative; margin-left: 25px; margin-top: 20px; height:25px;">
	Typical slab placement (check all that applies)
	</div>
<?php
		if (strpos(" " . $plac, "A")) {
			$y = 'checked="checked"';
			$n = "";
		}
		else {
			$y = "";
			$n = 'checked="checked"';
		}
?>
	<div style="position:relative; height:40px;">
	<div style="position:absolute; left:50px; top:0;">
	  <span>Slab on grade</span>
	</div>
	<div style="position:absolute; left:150px; top:0;">
	  <input type="radio" name="PlacGrade" value="Y" <?php echo $y; ?> />Yes
	  <input type="radio" name="PlacGrade" value="N" <?php echo $n; ?> />No
	</div>
<?php
		if (strpos(" " . $plac, "B")) {
			$y = 'checked="checked"';
			$n = "";
		}
		else {
			$y = "";
			$n = 'checked="checked"';
		}
?>
	<div style="position:absolute; left:50px; top:20px;">
	  <span>Slab on deck</span>
	</div>
	<div style="position:absolute; left:150px; top:20px;">
	  <input type="radio" name="PlacDeck" value="Y" <?php echo $y; ?> />Yes
	  <input type="radio" name="PlacDeck" value="N" <?php echo $n; ?> />No
	</div>
	</div>

	<div style="position:relative; margin-left: 25px; margin-top: 20px; height:25px;">
	Do you prepare sub-grade?
	</div>
<?php
		if (strpos(" " . $prep, "A")) {
			$y = 'checked="checked"';
			$n = "";
		}
		else {
			$y = "";
			$n = 'checked="checked"';
		}
?>
	<div style="position:relative; height:40px;">
	<div style="position:absolute; left:50px; top:0;">
	  <span>Yes</span>
	</div>
	<div style="position:absolute; left:150px; top:0;">
	  <input type="radio" name="PrepY" value="Y" <?php echo $y; ?> />Yes
	  <input type="radio" name="PrepY" value="N" <?php echo $n; ?> />No
	</div>
<?php
		if (strpos(" " . $prep, "B")) {
			$y = 'checked="checked"';
			$n = "";
		}
		else {
			$y = "";
			$n = 'checked="checked"';
		}
?>
	<div style="position:absolute; left:50px; top:20px;">
	  <span>No</span>
	</div>
	<div style="position:absolute; left:150px; top:20px;">
	  <input type="radio" name="PrepN" value="Y" <?php echo $y; ?> />Yes
	  <input type="radio" name="PrepN" value="N" <?php echo $n; ?> />No
	</div>
	</div>


	<div style="position:relative; margin-left: 25px; margin-top: 20px; height:25px;">
	Are there weight concerns (with machinery) if pouring on a deck?
	</div>
<?php
		if (strpos(" " . $wt, "A")) {
			$y = 'checked="checked"';
			$n = "";
		}
		else {
			$y = "";
			$n = 'checked="checked"';
		}
?>
	<div style="position:relative; height:100px;">
	<div style="position:absolute; left:50px; top:0;">
	  <span>Yes, we have<br />concerns about<br />heavy equipment<br />on the deck</span>
	</div>
	<div style="position:absolute; left:150px; top:0;">
	  <input type="radio" name="WtY" value="Y" <?php echo $y; ?> />Yes
	  <input type="radio" name="WtY" value="N" <?php echo $n; ?> />No
	</div>
<?php
		if (strpos(" " . $wt, "B")) {
			$y = 'checked="checked"';
			$n = "";
		}
		else {
			$y = "";
			$n = 'checked="checked"';
		}
?>
	<div style="position:absolute; left:50px; top:60px;">
	  <span>No, deck can<br />handle heavy<br />equipment</span>
	</div>
	<div style="position:absolute; left:150px; top:60px;">
	  <input type="radio" name="WtN" value="Y" <?php echo $y; ?> />Yes
	  <input type="radio" name="WtN" value="N" <?php echo $n; ?> />No
	</div>
	</div>


	<div style="position:relative; margin-left:100px; margin-top:50px; height:40px;">
	<div style="position:absolute; left:50px; top:0;">
	  <input type="submit" name="Submit" value="Update" />
	</div>
	<div style="position:absolute; left:150px; top:0;">
	  <input type="button" name="Cancel" value="Cancel" onclick="return cancelUpd();" />
	</div>
	</div>
</form>
<?php
	}

}

//
// updateProd ()
//
//	Update the fields in the database for the requested product
//
function updateProd () {
//	JMenuBar::title(JText::_('Update product answers'), 'addedit.png');

	$db =& JFactory::getDBO();
	$pid = JRequest::getVar('id');
	$prodName = JRequest::getVar('prodName');
	$prodDesc = mysql_real_escape_string(JRequest::getVar('prodDesc'));
	$prodImage = mysql_real_escape_string(JRequest::getVar('prodImage'));

	$conTyp = "";
	if (JRequest::getVar('ConTypStd') == "Y") {
		$conTyp .= "A";
	}
	if (JRequest::getVar('ConTypLW') == "Y") {
		$conTyp .= "B";
	}
	if (JRequest::getVar('ConTypPerv') == "Y") {
		$conTyp .= "C";
	}


	$pourTyp = "";
	if (JRequest::getVar('PourTypInt') == "Y") {
		$pourTyp .= "A";
	}
	if (JRequest::getVar('PourTypExt') == "Y") {
		$pourTyp .= "B";
	}

	$slmp = "";
	if (JRequest::getVar('Slump3') == "Y") {
		$slmp .= "A";
	}
	if (JRequest::getVar('Slump4') == "Y") {
		$slmp .= "B";
	}
	if (JRequest::getVar('Slump5') == "Y") {
		$slmp .= "C";
	}

	$pourSiz = "";
	if (JRequest::getVar('PourSize1') == "Y") {
		$pourSiz .= "A";
	}
	if (JRequest::getVar('PourSize6') == "Y") {
		$pourSiz .= "B";
	}
	if (JRequest::getVar('PourSize11') == "Y") {
		$pourSiz .= "C";
	}
	if (JRequest::getVar('PourSize16') == "Y") {
		$pourSiz .= "D";
	}
	if (JRequest::getVar('PourSize21') == "Y") {
		$pourSiz .= "E";
	}

	$pourRat = "";
	if (JRequest::getVar('PourRate1') == "Y") {
		$pourRat .= "A";
	}
	if (JRequest::getVar('PourRate6') == "Y") {
		$pourRat .= "B";
	}
	if (JRequest::getVar('PourRate11') == "Y") {
		$pourRat .= "C";
	}
	if (JRequest::getVar('PourRate21') == "Y") {
		$pourRat .= "D";
	}

	$rein = "";
	if (JRequest::getVar('ReinRebar') == "Y") {
		$rein .= "A";
	}
	if (JRequest::getVar('ReinWire') == "Y") {
		$rein .= "B";
	}
	if (JRequest::getVar('ReinPost') == "Y") {
		$rein .= "C";
	}

	$flat = "";
	if (JRequest::getVar('FlatQ1') == "Y") {
		$flat .= "A";
	}
	if (JRequest::getVar('FlatQ2') == "Y") {
		$flat .= "B";
	}

	$grad = "";
	if (JRequest::getVar('GradSingle') == "Y") {
		$grad .= "A";
	}
	if (JRequest::getVar('GradDual') == "Y") {
		$grad .= "B";
	}
	if (JRequest::getVar('GradMulti') == "Y") {
		$grad .= "C";
	}

	$plac = "";
	if (JRequest::getVar('PlacGrade') == "Y") {
		$plac .= "A";
	}
	if (JRequest::getVar('PlacDeck') == "Y") {
		$plac .= "B";
	}

	$prep = "";
	if (JRequest::getVar('PrepY') == "Y") {
		$prep .= "A";
	}
	if (JRequest::getVar('PrepN') == "Y") {
		$prep .= "B";
	}

	$wt = "";
	if (JRequest::getVar('WtY') == "Y") {
		$wt .= "A";
	}
	if (JRequest::getVar('WtN') == "Y") {
		$wt .= "B";
	}


	$query = sprintf("UPDATE #__ifm_product_answers SET prodDesc = '%s', " .
						"prodImage = '%s', concreteType = '%s', " .
						"pourType = '%s', slump = '%s', pourSize = '%s', " .
						"pourRate = '%s', reinforcement = '%s', flatness = '%s', " .
						"grade = '%s', placement = '%s', prepSubGrade = '%s', " .
						"weight = '%s' WHERE id = %d",
						$prodDesc, $prodImage, $conTyp, $pourTyp, $slmp,
						$pourSiz, $pourRat, $rein, $flat, $grad, $plac,
						$prep, $wt, $pid);

	$db->setQuery($query, 0);
	$db->query();
	$errno = $db->getErrorNum();
	if ($errno == 0) {
		$txt = $prodName . "successfully updated!";
		$errmsg = "";
	}
	else {
		$txt = "An error occured while attempting to update " . $prodName . ".";
		$errmsg = $db->getErrorMsg();
	}
?>
<h3>Update interactive filtering module product answers</h3>
<form name="frmUpd" id="frmUpd" method="post" action="index.php?option=com_ifm">
	<h4><?php echo $txt; ?></h4>
	<p><?php echo $errmsg; ?></p>
	<br />
	<input type="submit" name="Submit" Value="Return to list" />
</form>

<?php
}


//
// showProd ()
//
//	Make a list of the products from the database and have each
//	with an associated "change" button
//
function showProd () {
//	JMenuBar::title(JText::_('Somero product list'), 'addedit.png');

	$db =& JFactory::getDBO();
	$query = "SELECT id, prodName, prodDesc FROM #__ifm_product_answers";
	$db->setQuery($query, 0);
	$rows = $db->loadObjectList();

?>
<script type="text/javascript" language="javascript">
//
// Request change function
//
function changeProd(id) {
	var idVar = document.getElementById('id');
	idVar.value = id;
	var frm = document.getElementById('frmProdList');
	frm.submit();
	return true;
}

//
// Add a new prodjuct
//
function addProduct() {
	var frm = document.getElementById('frmProdList');
	frm.action = "index.php?option=com_ifm&task=add";
	frm.submit();
	return true;
}

</script>

<h3>Somero product list</h3>
<form name="frmProdList" id="frmProdList" method="post" action="index.php?option=com_ifm&task=change">
	<input type="hidden" name="id" id="id" value="0" />
	<h4>Somero Product List for Interactive Filtering Module</h4>
	<br />
	<br />
	<input type="button" name="BtnAdd" value="Add Product" onclick="return addProduct();" />
	<br />
	<br />
	<br />
	<br />
<?php
	foreach ($rows as $row) {
?>
	<hr />
	<p>
	<input type="button" name="Btn<?php echo $row->id; ?>" value="Change" onclick="return changeProd(<?php echo $row->id; ?>);" />
<?php 
		echo "    &nbsp;&nbsp;&nbsp;" . $row->prodName . "\n";
		echo "    <br />\n";
		echo "    " . $row->prodDesc . "\n";
		echo "    </p>\n";
	}
?>
	<hr />
</form>
<?php
}

//
// Add a new product to the database
//
function addProd() {

?>
<script type="text/javascript" language="javascript">
//
// Cancel button action
//
function cancelAdd() {
	var frm = document.getElementById('id_addProd');
	frm.action = "index.php?option=com_ifm";
	frm.submit();
	return true;
}
</script>

<form name="addProd" id="id_addProd" method="post" action="index.php?option=com_ifm&task=insert">
	<h3>Add new product</h3>
	<br />
	<div style="position:relative; height:150px;">
	<span style="position:absolute; left:20px; top:0;">Product Name</span>
	<input type="text" style="position:absolute; left:150px; top:0;" size="35" maxlength="80" name="prName" />
	<span style="position:absolute; left:20px; top:25px;">Product Description</span>
	<input type="text" style="position:absolute; left:150px; top:25px;" size="100" maxlegnth="255" name="prDesc" />
	<span style="position:absolute; left:20px; top:50px;">Image filename</span>
	<input type="text" style="position:absolute; left:150px; top:50px;" size="35" maxlength="255" name="prImage" />
	
	<div style="position:absolute; left:150px; top: 80px;">
	<br />
	<input type="submit" name="Submit" value="Add" />&nbsp;&nbsp;&nbsp;
	<input type="submit" name="Cancel" value="Cancel" onclick="return cancelAdd();" /> 
	</div>
	</div>
</form>
<?php
}

//
// Insert skeletal product into the database
//

function insertProd() {
	
	$db =& JFactory::getDBO();
	$prName = mysql_real_escape_string(JRequest::getVar('prName'));
	$prDesc = mysql_real_escape_string(JRequest::getVar('prDesc'));
	$prImg = mysql_real_escape_string(JRequest::getVar('prImage'));

	$q = "INSERT INTO #__ifm_product_answers (prodName, prodDesc, prodImage) " .
				"VALUES ('" . $prName . "', '" . $prDesc . "', '" . $prImg . "')";
	$db->setQuery($q, 0);
	$db->query();
	$errno = $db->getErrorNum();
	if ($errno == 0) {
		$msg = "Product added successfully.  Remember to change the answers to make the filter work.";
	}
	else {
		$msg = "An error ocurred attempting to add the product<br />" .
				$db->getErrorMsg();
	}
?>
<form name="frmDone" method="post" action="index.php?option=com_ifm">
	<h3>Product add results</h3>
	<br />
	<?php echo $msg; ?>
	<br />
	<br />
	<br />
	<input type="submit" name="Submit" value="Continue" />
	<br />
<?php
}
?>
