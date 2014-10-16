<?php
/*
 * The page shown when the user requests to see this form. Allows the user to edit form contents, and save. has a button for printing the saved form contents.
 */

/* for $GLOBALS[], ?? */
require_once('../../globals.php');
/* for acl_check(), ?? */
require_once($GLOBALS['srcdir'].'/api.inc');
/* for generate_form_field, ?? */
require_once($GLOBALS['srcdir'].'/options.inc.php');
/* note that we cannot include options_listadd.inc here, as it generates code before the <html> tag */

/** CHANGE THIS - name of the database table associated with this form **/
$table_name = 'form_aec_ros';

/** CHANGE THIS name to the name of your form. **/
$form_name = 'Ashford Review of Symptoms Checks';

/** CHANGE THIS to match the folder you created for this form. **/
$form_folder = 'aec_ros';

/* Check the access control lists to ensure permissions to this page */
if (!acl_check('patients', 'med')) {
 die(text($form_name).': '.xlt("Access Denied"));
}
$thisauth_write_addonly=FALSE;
if ( acl_check('patients','med','',array('write','addonly') )) {
 $thisauth_write_addonly=TRUE;
}

/* perform a squad check for pages touching patients, if we're in 'athletic team' mode */
if ($GLOBALS['athletic_team']!='false') {
  $tmp = getPatientData($pid, 'squad');
  if ($tmp['squad'] && ! acl_check('squads', $tmp['squad']))
   die(text($form_name).': '.xlt("Access Denied"));
}

if (!$thisauth_write_addonly)
  die(text($form_name).': '.xlt("Adding is not authorized"));
/* Use the formFetch function from api.inc to load the saved record */
$obj = formFetch($table_name, $_GET['id']);


$submiturl = $GLOBALS['rootdir'].'/forms/'.$form_folder.'/save.php?mode=update&amp;return=encounter&amp;id='.$_GET['id'];
if ($_GET['mode']) {
 if ($_GET['mode']=='noencounter') {
 $submiturl = $GLOBALS['rootdir'].'/forms/'.$form_folder.'/save.php?mode=new&amp;return=show&amp;id='.$_GET['id'];
 $returnurl = 'show.php';
 }
}
else
{
 $returnurl = $GLOBALS['concurrent_layout'] ? 'encounter_top.php' : 'patient_encounter.php';
}


/* define check field functions. used for translating from fields to html viewable strings */

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>

<!-- declare this document as being encoded in UTF-8 -->
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" ></meta>

<!-- supporting javascript code -->
<!-- for dialog -->
<script type="text/javascript" src="<?php echo $GLOBALS['webroot']; ?>/library/dialog.js"></script>
<!-- For jquery, required by the save, discard, and print buttons. -->
<script type="text/javascript" src="<?php echo $GLOBALS['webroot']; ?>/library/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['webroot']; ?>/library/textformat.js"></script>

<!-- Global Stylesheet -->
<link rel="stylesheet" href="<?php echo $css_header; ?>" type="text/css"/>
<!-- Form Specific Stylesheet. -->
<link rel="stylesheet" href="../../forms/<?php echo $form_folder; ?>/style.css" type="text/css"/>



<script type="text/javascript">
// this line is to assist the calendar text boxes
var mypcc = '<?php echo $GLOBALS['phone_country_code']; ?>';

<!-- FIXME: this needs to detect access method, and construct a URL appropriately! -->
function PrintForm() {
    newwin = window.open("<?php echo $rootdir.'/forms/'.$form_folder.'/print.php?id='.$_GET['id']; ?>","print_<?php echo $form_name; ?>");
}

</script>
<title><?php echo htmlspecialchars('View '.$form_name); ?></title>

</head>
<body class="body_top">

<div id="title">
<a href="<?php echo $returnurl; ?>" onclick="top.restoreSession()">
<span class="title"><?php htmlspecialchars(xl($form_name,'e')); ?></span>
<span class="back">(<?php xl('Back','e'); ?>)</span>
</a>
</div>

<form method="post" action="<?php echo $submiturl; ?>" id="<?php echo $form_folder; ?>"> 

<!-- Save/Cancel buttons -->
<div id="top_buttons" class="top_buttons">
<fieldset class="top_buttons">
<input type="button" class="save" value="<?php xl('Save Changes','e'); ?>" />
<input type="button" class="dontsave" value="<?php xl('Don\'t Save Changes','e'); ?>" />
<input type="button" class="print" value="<?php xl('Print','e'); ?>" />
</fieldset>
</div><!-- end top_buttons -->

<!-- container for the main body of the form -->
<div id="form_container">
<fieldset>
<span class="title"><?php xl('Review of Systems Checks','e'); ?></span><Br><br>

<span class="title"><?php xl('Ashford Review of Systems Checks','e'); ?></span><br>
<br>

<table>
	<tr>
		<td valign="top">
			<span class="bold"><?php xl('General','e'); ?></span><br>
			<input type=checkbox name="weight_loss"  <?php if ($obj{"weight_loss"} == "on") {echo "checked";};?>><span class="text"><?php xl('Weight Loss','e'); ?></span><br>
			<input type=checkbox name="weight_gain"  <?php if ($obj{"weight_gain"} == "on") {echo "checked";};?>><span class="text"><?php xl('Weight Gain','e'); ?></span><br>
			<input type=checkbox name="fatigue"  <?php if ($obj{"fatigue"} == "on") {echo "checked";};?>><span class="text"><?php xl('Fatigue','e'); ?></span><br>
			<input type=checkbox name="sleep_problems"  <?php if ($obj{"sleep_problems"} == "on") {echo "checked";};?>><span class="text"><?php xl('Sleep Problems','e'); ?></span><br>
		</td>
		<td valign="top">
			<span class="bold"><?php xl('Eyes','e'); ?></span><br>
			<input type=checkbox name="vision_changes"  <?php if ($obj{"vision_changes"} == "on") {echo "checked";};?>><span class="text"><?php xl('Change in Vision','e'); ?></span><br>
			<input type=checkbox name="blurry_vision"  <?php if ($obj{"blurry_vision"} == "on") {echo "checked";};?>><span class="text"><?php xl('Blurry Vision','e'); ?></span><br>
			<input type=checkbox name="wear_glasses"  <?php if ($obj{"wear_glasses"} == "on") {echo "checked";};?>><span class="text"><?php xl('Wear Glasses','e'); ?></span><br>
			<input type=checkbox name="floaters"  <?php if ($obj{"floaters"} == "on") {echo "checked";};?>><span class="text"><?php xl('Floaters','e'); ?></span><br>
			<input type=checkbox name="glaucoma"  <?php if ($obj{"glaucoma"} == "on") {echo "checked";};?>><span class="text"><?php xl('Glaucoma','e'); ?></span><br>
		</td>
		<td valign="top">
			<span class="bold"><?php xl('Ears','e'); ?></span><br>
			<input type=checkbox name="hearing_loss"  <?php if ($obj{"hearing_loss"} == "on") {echo "checked";};?>><span class="text"><?php xl('Hearing Loss','e'); ?></span><br>
			<input type=checkbox name="ringing"  <?php if ($obj{"ringing"} == "on") {echo "checked";};?>><span class="text"><?php xl('Ringing','e'); ?></span><br>
			<input type=checkbox name="roaring"  <?php if ($obj{"roaring"} == "on") {echo "checked";};?>><span class="text"><?php xl('Roaring','e'); ?></span><br>
			<input type=checkbox name="dizziness"  <?php if ($obj{"dizziness"} == "on") {echo "checked";};?>><span class="text"><?php xl('Dizziness','e'); ?></span><br>
			<input type=checkbox name="vertigo"  <?php if ($obj{"vertigo"} == "on") {echo "checked";};?>><span class="text"><?php xl('Vertigo','e'); ?></span><br>
			<input type=checkbox name="ear_pain"  <?php if ($obj{"ear_pain"} == "on") {echo "checked";};?>><span class="text"><?php xl('Ear Pain','e'); ?></span><br>
			<input type=checkbox name="ear_drainage"  <?php if ($obj{"ear_drainage"} == "on") {echo "checked";};?>><span class="text"><?php xl('Ear Drainage','e'); ?></span><br>
			<input type=checkbox name="ear_surgery"  <?php if ($obj{"ear_surgery"} == "on") {echo "checked";};?>><span class="text"><?php xl('Ear Surgery','e'); ?></span><br>
			<input type=checkbox name="ear_infections"  <?php if ($obj{"ear_infections"} == "on") {echo "checked";};?>><span class="text"><?php xl('Ear Infections','e'); ?></span><br>
		</td>
		<td valign="top">
			<span class="bold"><?php xl('Nose','e'); ?></span><br>
			<input type=checkbox name="allergies"  <?php if ($obj{"allergies"} == "on") {echo "checked";};?>><span class="text"><?php xl('Allergies','e'); ?></span><br>
			<input type=checkbox name="congestion"  <?php if ($obj{"congestion"} == "on") {echo "checked";};?>><span class="text"><?php xl('Congestion','e'); ?></span><br>
			<input type=checkbox name="stuffiness"  <?php if ($obj{"stuffiness"} == "on") {echo "checked";};?>><span class="text"><?php xl('Stuffiness','e'); ?></span><br>
			<input type=checkbox name="sinus_pain"  <?php if ($obj{"sinus_pain"} == "on") {echo "checked";};?>><span class="text"><?php xl('Pain','e'); ?></span><br>
			<input type=checkbox name="sinus_pressure"  <?php if ($obj{"sinus_pressure"} == "on") {echo "checked";};?>><span class="text"><?php xl('Pressure','e'); ?></span><br>
			<input type=checkbox name="sinus_surgery"  <?php if ($obj{"sinus_surgery"} == "on") {echo "checked";};?>><span class="text"><?php xl('Sinus Surgery','e'); ?></span><br>
			<input type=checkbox name="blocked_breathing"  <?php if ($obj{"blocked_breathing"} == "on") {echo "checked";};?>><span class="text"><?php xl('Blocked Breathing','e'); ?></span><br>
		</td>
		<td valign="top">
			<span class="bold"><?php xl('Throat','e'); ?></span><br>
			<input type=checkbox name="hoarseness"  <?php if ($obj{"hoarseness"} == "on") {echo "checked";};?>><span class="text"><?php xl('Hoarseness','e'); ?></span><br>
			<input type=checkbox name="dryness"  <?php if ($obj{"dryness"} == "on") {echo "checked";};?>><span class="text"><?php xl('Dryness','e'); ?></span><br>
			<input type=checkbox name="voice_fatigue"  <?php if ($obj{"voice_fatigue"} == "on") {echo "checked";};?>><span class="text"><?php xl('Voice Fatigue','e'); ?></span><br>
			<input type=checkbox name="frequent_throat_clearing"  <?php if ($obj{"frequent_throat_clearing"} == "on") {echo "checked";};?>><span class="text"><?php xl('Frequent Throat Clearing','e'); ?></span><br>
			<input type=checkbox name="increased_phlegm"  <?php if ($obj{"increased_phlegm"} == "on") {echo "checked";};?>><span class="text"><?php xl('Increased Phlegm','e'); ?></span><br>
			<input type=checkbox name="post_nasal_drip"  <?php if ($obj{"post_nasal_drip"} == "on") {echo "checked";};?>><span class="text"><?php xl('Post Nasal Drip','e'); ?></span><br>
		</td>
		<td valign="top">
			<span class="bold"><?php xl('Face','e'); ?></span><br>
			<input type=checkbox name="face_pain"  <?php if ($obj{"face_pain"} == "on") {echo "checked";};?>><span class="text"><?php xl('Pain','e'); ?></span><br>
			<input type=checkbox name="face_numbness"  <?php if ($obj{"face_numbness"} == "on") {echo "checked";};?>><span class="text"><?php xl('Numbness','e'); ?></span><br>
			<input type=checkbox name="twitching"  <?php if ($obj{"twitching"} == "on") {echo "checked";};?>><span class="text"><?php xl('Twitching','e'); ?></span><br>
			<input type=checkbox name="face_weakness"  <?php if ($obj{"face_weakness"} == "on") {echo "checked";};?>><span class="text"><?php xl('Weakness','e'); ?></span><br>
			<input type=checkbox name="lopsided"  <?php if ($obj{"lopsided"} == "on") {echo "checked";};?>><span class="text"><?php xl('Lopsided','e'); ?></span><br>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<span class="bold"><?php xl('Neck','e'); ?></span><br>
			<input type=checkbox name="neck_pain"  <?php if ($obj{"neck_pain"} == "on") {echo "checked";};?>><span class="text"><?php xl('Pain','e'); ?></span><br>
			<input type=checkbox name="mass"  <?php if ($obj{"mass"} == "on") {echo "checked";};?>><span class="text"><?php xl('Mass','e'); ?></span><br>
			<input type=checkbox name="lump"  <?php if ($obj{"lump"} == "on") {echo "checked";};?>><span class="text"><?php xl('Lump','e'); ?></span><br>
			<input type=checkbox name="goiter"  <?php if ($obj{"goiter"} == "on") {echo "checked";};?>><span class="text"><?php xl('Goiter','e'); ?></span><br>
			<input type=checkbox name="spine_surgery"  <?php if ($obj{"spine_surgery"} == "on") {echo "checked";};?>><span class="text"><?php xl('Spine Surgery','e'); ?></span><br>
			<input type=checkbox name="decreased_mobility"  <?php if ($obj{"decreased_mobility"} == "on") {echo "checked";};?>><span class="text"><?php xl('Decreased Mobility','e'); ?></span><br>
			<input type=checkbox name="noisy_breathing"  <?php if ($obj{"noisy_breathing"} == "on") {echo "checked";};?>><span class="text"><?php xl('Noisy Breathing','e'); ?></span><br>
		</td>
		<td valign="top">
			<span class="bold"><?php xl('Neuro','e'); ?></span><br>
			<input type=checkbox name="headache"  <?php if ($obj{"headache"} == "on") {echo "checked";};?>><span class="text"><?php xl('Headache','e'); ?></span><br>
			<input type=checkbox name="numbness"  <?php if ($obj{"numbness"} == "on") {echo "checked";};?>><span class="text"><?php xl('Numbness','e'); ?></span><br>
			<input type=checkbox name="weakness"  <?php if ($obj{"weakness"} == "on") {echo "checked";};?>><span class="text"><?php xl('Weakness','e'); ?></span><br>
			<input type=checkbox name="walking_problems"  <?php if ($obj{"walking_problems"} == "on") {echo "checked";};?>><span class="text"><?php xl('Walking Problems','e'); ?></span><br>
		</td>
		<td valign="top">
			<span class="bold"><?php xl('Heart','e'); ?></span><br>
			<input type=checkbox name="chest_pain"  <?php if ($obj{"chest_pain"} == "on") {echo "checked";};?>><span class="text"><?php xl('Chest Pain','e'); ?></span><br>
			<input type=checkbox name="heart_attack"  <?php if ($obj{"heart_attack"} == "on") {echo "checked";};?>><span class="text"><?php xl('Heart Attack','e'); ?></span><br>
			<input type=checkbox name="heart_failure"  <?php if ($obj{"heart_failure"} == "on") {echo "checked";};?>><span class="text"><?php xl('Heart Failure','e'); ?></span><br>
			<input type=checkbox name="abnormal_rhythm"  <?php if ($obj{"abnormal_rhythm"} == "on") {echo "checked";};?>><span class="text"><?php xl('Abnormal Rhythm','e'); ?></span><br>
		</td>
		<td valign="top">
			<span class="bold"><?php xl('Lungs','e'); ?></span><br>
			<input type=checkbox name="breathing_changes"  <?php if ($obj{"breathing_changes"} == "on") {echo "checked";};?>><span class="text"><?php xl('Breathing Changes','e'); ?></span><br>
			<input type=checkbox name="asthma"  <?php if ($obj{"asthma"} == "on") {echo "checked";};?>><span class="text"><?php xl('Asthma','e'); ?></span><br>
			<input type=checkbox name="copd"  <?php if ($obj{"copd"} == "on") {echo "checked";};?>><span class="text"><?php xl('COPD','e'); ?></span><br>
			<input type=checkbox name="smoking"  <?php if ($obj{"smoking"} == "on") {echo "checked";};?>><span class="text"><?php xl('Smoking','e'); ?></span><br>
			<input type=checkbox name="cough"  <?php if ($obj{"cough"} == "on") {echo "checked";};?>><span class="text"><?php xl('Cough','e'); ?></span><br>
		</td>
		<td valign="top">
			<span class="bold"><?php xl('Gastrointestinal','e'); ?></span><br>
			<input type=checkbox name="stomach_pain"  <?php if ($obj{"stomach_pain"} == "on") {echo "checked";};?>><span class="text"><?php xl('Stomach Pain','e'); ?></span><br>
			<input type=checkbox name="diarrhea"  <?php if ($obj{"diarrhea"} == "on") {echo "checked";};?>><span class="text"><?php xl('Diarrhea','e'); ?></span><br>
			<input type=checkbox name="constipation"  <?php if ($obj{"constipation"} == "on") {echo "checked";};?>><span class="text"><?php xl('Constipation','e'); ?></span><br>
			<input type=checkbox name="nausea"  <?php if ($obj{"nausea"} == "on") {echo "checked";};?>><span class="text"><?php xl('Nausea','e'); ?></span><br>
			<input type=checkbox name="vomiting"  <?php if ($obj{"vomiting"} == "on") {echo "checked";};?>><span class="text"><?php xl('Vomiting','e'); ?></span><br>
			<input type=checkbox name="cramping"  <?php if ($obj{"cramping"} == "on") {echo "checked";};?>><span class="text"><?php xl('Cramping','e'); ?></span><br>
			<input type=checkbox name="appetite_changes"  <?php if ($obj{"appetite_changes"} == "on") {echo "checked";};?>><span class="text"><?php xl('Appetite Changes','e'); ?></span><br>
		</td>
		<td valign="top">
			<span class="bold"><?php xl('Immune System','e'); ?></span><br>
			<input type=checkbox name="abnormal_lymph_nodes"  <?php if ($obj{"abnormal_lymph_nodes"} == "on") {echo "checked";};?>><span class="text"><?php xl('Abnormal Lymph Nodes','e'); ?></span><br>
			<input type=checkbox name="rheumatoid_arthritis"  <?php if ($obj{"rheumatoid_arthritis"} == "on") {echo "checked";};?>><span class="text"><?php xl('Rheumatoid Arthritis','e'); ?></span><br>
			<input type=checkbox name="lupus"  <?php if ($obj{"lupus"} == "on") {echo "checked";};?>><span class="text"><?php xl('Lupus','e'); ?></span><br>
			<input type=checkbox name="sjogrens"  <?php if ($obj{"sjogrens"} == "on") {echo "checked";};?>><span class="text"><?php xl('Sjogren\'s','e'); ?></span><br>
			<input type=checkbox name="wegeners"  <?php if ($obj{"wegeners"} == "on") {echo "checked";};?>><span class="text"><?php xl('Wegener\'s','e'); ?></span><br>
			<input type=checkbox name="psoriasis"  <?php if ($obj{"psoriasis"} == "on") {echo "checked";};?>><span class="text"><?php xl('Psoriasis','e'); ?></span><br>
			<input type=checkbox name="osteoarthritis"  <?php if ($obj{"osteoarthritis"} == "on") {echo "checked";};?>><span class="text"><?php xl('Osteoarthritis','e'); ?></span><br>
		</td>
	</tr>
</table>
</fieldset>
</div> <!-- end form_container -->

<!-- Save/Cancel buttons -->
<div id="bottom_buttons" class="button_bar">
<fieldset>
<input type="button" class="save" value="<?php xl('Save Changes','e'); ?>" />
<input type="button" class="dontsave" value="<?php xl('Don\'t Save Changes','e'); ?>" />
<input type="button" class="print" value="<?php xl('Print','e'); ?>" />
</fieldset>
</div><!-- end bottom_buttons -->
</form>
<script type="text/javascript">
// jQuery stuff to make the page a little easier to use

$(document).ready(function(){
    $(".save").click(function() { top.restoreSession(); document.forms["<?php echo $form_folder; ?>"].submit(); });
    $(".dontsave").click(function() { location.href='<?php echo $returnurl; ?>'; });
    $(".print").click(function() { PrintForm(); });
    
    $(".sectionlabel input").click( function() {
    	var section = $(this).attr("data-section");
		if ( $(this).attr('checked' ) ) {
			$("#"+section).show();
		} else {
			$("#"+section).hide();
		}
    });

    $(".sectionlabel input").attr( 'checked', 'checked' );
    $(".section").show();
});
</script>
</body>
</html>

