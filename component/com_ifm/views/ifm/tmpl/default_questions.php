<?php
/**
*	default_questions.php
*
*	Template for displaying the interactive filtering module component
*/

// No direct access
defined('_JEXEC') or die('Restricted access');

//	Post a series of questions to the user to ask about
//	his/her concrete usage.  From this get a list of suitable
//	Somero products.

$id = JRequest::getVar('Itemid');
?>

<div style="height:5px;"></div>
<div style="border:1px solid #ccc;width:684px;" align="left">
<img src="images/stories/decisioncenter/decisioncenter.jpg" width="684" height="285" border="0" /><br />
<img src="images/stories/decisioncenter/speakdirectly.jpg" width="684" height="88" border="0" />

 <div style="background-color:#f5f5f5;border:17px solid #fff;padding:0px;">
 
<form name="frmQues" id="frmQues" method="post" action="index.php?option=com_ifm&task=find&Itemid=<?php echo $id; ?>">
  <div class="ques">
    <span class="num">1.</span> What type of concrete will you be using?<br />
    <input type="radio" name="concreteType" value="A" />Standard<br />
    <input type="radio" name="concreteType" value="B" />Lite weight<br />
    <input type="radio" name="concreteType" value="C" />Pervious<br />
  </div>

<img src="images/stories/decisioncenter/horz_divider.png" width="617" height="13" border="0" style="padding-left:15px;" />

  <div class="ques">
    <span class="num">2.</span> Is your pour going to be interior or exterior?<br />
    <input type="radio" name="pourType" value="A" />Interior<br />
    <input type="radio" name="pourType" value="B" />Exterior<br />
  </div>

<img src="images/stories/decisioncenter/horz_divider.png" width="617" height="13" border="0" style="padding-left:15px;" />

  <div class="ques">
    <span class="num">3.</span> What is the grade of your pour? (check all that applies)<br />
	<input type="checkbox" name="gradeA" />Single slope<br />
	<input type="checkbox" name="gradeB" />Dual slope<br />
	<input type="checkbox" name="gradeC" />Contour with multiple grade changes<br />
  </div>

<img src="images/stories/decisioncenter/horz_divider.png" width="617" height="13" border="0" style="padding-left:15px;" />

  <div class="ques">
    <span class="num">4.</span> What is your projects typical slump?<br />
	<input type="radio" name="slump" value="A" />1 - 3&quot;<br />
	<input type="radio" name="slump" value="B" />4 - 6&quot;<br />
	<input type="radio" name="slump" value="C" />7&quot; or more<br />
  </div>

<img src="images/stories/decisioncenter/horz_divider.png" width="617" height="13" border="0" style="padding-left:15px;" />

  <div class="ques">
    <span class="num">5.</span> What is the average pour size?<br />
	<input type="radio" name="pourSize" value="A" />1 - 5K<br />
	<input type="radio" name="pourSize" value="B" />6 - 10K<br />
	<input type="radio" name="pourSize" value="C" />11 - 15K<br />
	<input type="radio" name="pourSize" value="D" />16 - 20K<br />
	<input type="radio" name="pourSize" value="E" />21K or more<br />
  </div>

<img src="images/stories/decisioncenter/horz_divider.png" width="617" height="13" border="0" style="padding-left:15px;" />

  <div class="ques">
    <span class="num">6.</span> Average production per hour<br />
	<input type="radio" name="pourRate" value="A" />1 - 5K<br />
	<input type="radio" name="pourRate" value="B" />6 - 10K<br />
	<input type="radio" name="pourRate" value="C" />11 - 20K<br />
	<input type="radio" name="pourRate" value="D" />21K or more<br />
  </div>

<img src="images/stories/decisioncenter/horz_divider.png" width="617" height="13" border="0" style="padding-left:15px;" />

  <div class="ques">
    <span class="num">7.</span> Type of slab reinforcement<br />
	<input type="radio" name="reinforcement" value="A" />Rebar<br />
	<input type="radio" name="reinforcement" value="B" />Wire mesh<br />
	<input type="radio" name="reinforcement" value="C" />Post tension<br />
  </div>

<img src="images/stories/decisioncenter/horz_divider.png" width="617" height="13" border="0" style="padding-left:15px;" />

  <div class="ques">
    <span class="num">8.</span> What floor flatness are you trying to achieve?<br />
	<input type="radio" name="flatness" value="A" />10 - 40 FL#s<br />
	<input type="radio" name="flatness" value="B" />40 or more FL#s<br />
  </div>

<img src="images/stories/decisioncenter/horz_divider.png" width="617" height="13" border="0" style="padding-left:15px;" />

  <div class="ques">
   <span class="num">9.</span> Typical slab placement (check all that applies)<br />
	<input type="checkbox" name="placementA" />Slab on grade<br />
	<input type="checkbox" name="placementB" />Slab on deck<br />
  </div>

<img src="images/stories/decisioncenter/horz_divider.png" width="617" height="13" border="0" style="padding-left:15px;" />

  <div class="ques">
    <span class="num">10.</span> Do you prepare sub-grade?<br />
	<input type="radio" name="prepSubGrade" value="A" />Yes<br />
	<input type="radio" name="prepSubGrade" value="B" />No<br />
  </div>

<img src="images/stories/decisioncenter/horz_divider.png" width="617" height="13" border="0" style="padding-left:15px;" />

  <div class="ques">
    <span class="num">11.</span> Are there any weight concerns (with machinery) if pouring on a deck?</span><br />
	<input type="radio" name="weight" value="A" />Yes, we have concerns about heavy equipment on the deck<br />
	<input type="radio" name="weight" value="B" />No, deck can handle heavy equipment<br />
  </div>

  <p>
  <div align="center">
  <input type="image" src="images/stories/decisioncenter/submit_button.png"  name="Submit" value="Find Products" />
  </div>
  </p>
</form>
</div></div>