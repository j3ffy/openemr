<?php
/*
 * The page shown when the user requests a new form. allows the user to enter form contents, and save.
 */

/* for $GLOBALS[], ?? */
require_once('../../globals.php');
/* for acl_check(), ?? */
require_once($GLOBALS['srcdir'].'/api.inc');
/* for generate_form_field, ?? */
require_once($GLOBALS['srcdir'].'/options.inc.php');
/* note that we cannot include options_listadd.inc here, as it generates code before the <html> tag */

/** CHANGE THIS name to the name of your form. **/
$form_name = 'Ashford Review of Symptoms Checks';

/** CHANGE THIS to match the folder you created for this form. **/
$form_folder = 'aec_reviewofsymptoms';

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

$submiturl = $GLOBALS['rootdir'].'/forms/'.$form_folder.'/save.php?mode=new&amp;return=encounter';
/* no get logic here */
$returnurl = $GLOBALS['concurrent_layout'] ? 'encounter_top.php' : 'patient_encounter.php';

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>

<!-- declare this document as being encoded in UTF-8 -->
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" ></meta>

<!-- supporting javascript code -->
<!-- for dialog -->
<script type="text/javascript" src="<?php echo $GLOBALS['webroot']; ?>/library/dialog.js"></script>
<!-- For jquery, required by the save and discard buttons. -->
<script type="text/javascript" src="<?php echo $GLOBALS['webroot']; ?>/library/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['webroot']; ?>/library/textformat.js"></script>

<!-- Global Stylesheet -->
<link rel="stylesheet" href="<?php echo $css_header; ?>" type="text/css"/>
<!-- Form Specific Stylesheet. -->
<link rel="stylesheet" href="../../forms/<?php echo $form_folder; ?>/style.css" type="text/css"/>

<!-- pop up calendar -->
<style type="text/css">@import url(<?php echo $GLOBALS['webroot']; ?>/library/dynarch_calendar.css);</style>
<script type="text/javascript" src="<?php echo $GLOBALS['webroot']; ?>/library/dynarch_calendar.js"></script>
<?php include_once("{$GLOBALS['srcdir']}/dynarch_calendar_en.inc.php"); ?>
<script type="text/javascript" src="<?php echo $GLOBALS['webroot']; ?>/library/dynarch_calendar_setup.js"></script>

<script type="text/javascript">
// this line is to assist the calendar text boxes
var mypcc = '<?php echo $GLOBALS['phone_country_code']; ?>';

<!-- a validator for all the fields expected in this form -->
function validate() {
  return true;
}

<!-- a callback for validating field contents. executed at submission time. -->
function submitme() {
 var f = document.forms[0];
 if (validate(f)) {
  top.restoreSession();
  f.submit();
 }
}

</script>



<title><?php echo htmlspecialchars('New '.$form_name); ?></title>

</head>
<body class="body_top">

<div id="title">
<a href="<?php echo $returnurl; ?>" onclick="top.restoreSession()">
<span class="title"><?php xl($form_name,'e'); ?></span>
<span class="back">(<?php xl('Back','e'); ?>)</span>
</a>
</div>

<form method="post" action="<?php echo $submiturl; ?>" id="<?php echo $form_folder; ?>"> 

<!-- Save/Cancel buttons -->
<div id="top_buttons" class="top_buttons">
<fieldset class="top_buttons">
<input type="button" class="save" value="<?php xl('Save','e'); ?>" />
<input type="button" class="dontsave" value="<?php xl('Don\'t Save','e'); ?>" />
</fieldset>
</div><!-- end top_buttons -->

<!-- container for the main body of the form -->
<div id="form_container">
<fieldset>

<span class="title"><?php xl('Ashford Review of Systems Checks','e'); ?></span><br>
<br>

<table>
	<tr>
		<td valign="top">
			<span class="bold"><?php xl('General','e'); ?></span><br>
			<input type="checkbox" name='weight_loss'><span class="text"><?php xl('Weight Loss','e'); ?></span><br>
			<input type="checkbox" name='weight_gain'><span class="text"><?php xl('Weight Gain','e'); ?></span><br>
			<input type="checkbox" name='fatigue'><span class="text"><?php xl('Fatigue','e'); ?></span><br>
			<input type="checkbox" name='sleep_problems'><span class="text"><?php xl('Sleep Problems','e'); ?></span><br>
		</td>
		<td valign="top">
			<span class="bold"><?php xl('Eyes','e'); ?></span><br>
			<input type="checkbox" name='vision_changes'><span class="text"><?php xl('Change in Vision','e'); ?></span><br>
			<input type="checkbox" name='blurry_vision'><span class="text"><?php xl('Blurry Vision','e'); ?></span><br>
			<input type="checkbox" name='wear_glasses'><span class="text"><?php xl('Wear Glasses','e'); ?></span><br>
			<input type="checkbox" name='floaters'><span class="text"><?php xl('Floaters','e'); ?></span><br>
			<input type="checkbox" name='glaucoma'><span class="text"><?php xl('Glaucoma','e'); ?></span><br>
		</td>
		<td valign="top">
			<span class="bold"><?php xl('Ears','e'); ?></span><br>
			<input type="checkbox" name='hearing_loss'><span class="text"><?php xl('Hearing Loss','e'); ?></span><br>
			<input type="checkbox" name='ringing'><span class="text"><?php xl('Ringing','e'); ?></span><br>
			<input type="checkbox" name='roaring'><span class="text"><?php xl('Roaring','e'); ?></span><br>
			<input type="checkbox" name='dizziness'><span class="text"><?php xl('Dizziness','e'); ?></span><br>
			<input type="checkbox" name='vertigo'><span class="text"><?php xl('Vertigo','e'); ?></span><br>
			<input type="checkbox" name='ear_pain'><span class="text"><?php xl('Ear Pain','e'); ?></span><br>
			<input type="checkbox" name='ear_drainage'><span class="text"><?php xl('Ear Drainage','e'); ?></span><br>
			<input type="checkbox" name='ear_surgery'><span class="text"><?php xl('Ear Surgery','e'); ?></span><br>
			<input type="checkbox" name='ear_infections'><span class="text"><?php xl('Ear Infections','e'); ?></span><br>
		</td>
		<td valign="top">
			<span class="bold"><?php xl('Nose','e'); ?></span><br>
			<input type="checkbox" name='allergies'><span class="text"><?php xl('Allergies','e'); ?></span><br>
			<input type="checkbox" name='congestion'><span class="text"><?php xl('Congestion','e'); ?></span><br>
			<input type="checkbox" name='stuffiness'><span class="text"><?php xl('Stuffiness','e'); ?></span><br>
			<input type="checkbox" name='sinus_pain'><span class="text"><?php xl('Pain','e'); ?></span><br>
			<input type="checkbox" name='sinus_pressure'><span class="text"><?php xl('Pressure','e'); ?></span><br>
			<input type="checkbox" name='sinus_surgery'><span class="text"><?php xl('Sinus Surgery','e'); ?></span><br>
			<input type="checkbox" name='blocked_breathing'><span class="text"><?php xl('Blocked Breathing','e'); ?></span><br>
		</td>
		<td valign="top">
			<span class="bold"><?php xl('Throat','e'); ?></span><br>
			<input type="checkbox" name='hoarseness'><span class="text"><?php xl('Hoarseness','e'); ?></span><br>
			<input type="checkbox" name='dryness'><span class="text"><?php xl('Dryness','e'); ?></span><br>
			<input type="checkbox" name='voice_fatigue'><span class="text"><?php xl('Voice Fatigue','e'); ?></span><br>
			<input type="checkbox" name='frequent_throat_clearing'><span class="text"><?php xl('Frequent Throat Clearing','e'); ?></span><br>
			<input type="checkbox" name='increased_phlegm'><span class="text"><?php xl('Increased Phlegm','e'); ?></span><br>
			<input type="checkbox" name='post_nasal_drip'><span class="text"><?php xl('Post Nasal Drip','e'); ?></span><br>
		</td>
		<td valign="top">
			<span class="bold"><?php xl('Face','e'); ?></span><br>
			<input type="checkbox" name='face_pain'><span class="text"><?php xl('Pain','e'); ?></span><br>
			<input type="checkbox" name='face_numbness'><span class="text"><?php xl('Numbness','e'); ?></span><br>
			<input type="checkbox" name='twitching'><span class="text"><?php xl('Twitching','e'); ?></span><br>
			<input type="checkbox" name='face_weakness'><span class="text"><?php xl('Weakness','e'); ?></span><br>
			<input type="checkbox" name='lopsided'><span class="text"><?php xl('Lopsided','e'); ?></span><br>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<span class="bold"><?php xl('Neck','e'); ?></span><br>
			<input type="checkbox" name='neck_pain'><span class="text"><?php xl('Pain','e'); ?></span><br>
			<input type="checkbox" name='mass'><span class="text"><?php xl('Mass','e'); ?></span><br>
			<input type="checkbox" name='lump'><span class="text"><?php xl('Lump','e'); ?></span><br>
			<input type="checkbox" name='goiter'><span class="text"><?php xl('Goiter','e'); ?></span><br>
			<input type="checkbox" name='spine_surgery'><span class="text"><?php xl('Spine Surgery','e'); ?></span><br>
			<input type="checkbox" name='decreased_mobility'><span class="text"><?php xl('Decreased Mobility','e'); ?></span><br>
			<input type="checkbox" name='noisy_breathing'><span class="text"><?php xl('Noisy Breathing','e'); ?></span><br>
		</td>
		<td valign="top">
			<span class="bold"><?php xl('Neuro','e'); ?></span><br>
			<input type="checkbox" name='headache'><span class="text"><?php xl('Headache','e'); ?></span><br>
			<input type="checkbox" name='numbness'><span class="text"><?php xl('Numbness','e'); ?></span><br>
			<input type="checkbox" name='weakness'><span class="text"><?php xl('Weakness','e'); ?></span><br>
			<input type="checkbox" name='walking_problems'><span class="text"><?php xl('Walking Problems','e'); ?></span><br>
		</td>
		<td valign="top">
			<span class="bold"><?php xl('Heart','e'); ?></span><br>
			<input type="checkbox" name='chest_pain'><span class="text"><?php xl('Chest Pain','e'); ?></span><br>
			<input type="checkbox" name='heart_attack'><span class="text"><?php xl('Heart Attack','e'); ?></span><br>
			<input type="checkbox" name='heart_failure'><span class="text"><?php xl('Heart Failure','e'); ?></span><br>
			<input type="checkbox" name='abnormal_rhythm'><span class="text"><?php xl('Abnormal Rhythm','e'); ?></span><br>
		</td>
		<td valign="top">
			<span class="bold"><?php xl('Lungs','e'); ?></span><br>
			<input type="checkbox" name='breathing_changes'><span class="text"><?php xl('Breathing Changes','e'); ?></span><br>
			<input type="checkbox" name='asthma'><span class="text"><?php xl('Asthma','e'); ?></span><br>
			<input type="checkbox" name='copd'><span class="text"><?php xl('COPD','e'); ?></span><br>
			<input type="checkbox" name='smoking'><span class="text"><?php xl('Smoking','e'); ?></span><br>
			<input type="checkbox" name='cough'><span class="text"><?php xl('Cough','e'); ?></span><br>
		</td>
		<td valign="top">
			<span class="bold"><?php xl('Gastrointestinal','e'); ?></span><br>
			<input type="checkbox" name='stomach_pain'><span class="text"><?php xl('Stomach Pain','e'); ?></span><br>
			<input type="checkbox" name='diarrhea'><span class="text"><?php xl('Diarrhea','e'); ?></span><br>
			<input type="checkbox" name='constipation'><span class="text"><?php xl('Constipation','e'); ?></span><br>
			<input type="checkbox" name='nausea'><span class="text"><?php xl('Nausea','e'); ?></span><br>
			<input type="checkbox" name='vomiting'><span class="text"><?php xl('Vomiting','e'); ?></span><br>
			<input type="checkbox" name='cramping'><span class="text"><?php xl('Cramping','e'); ?></span><br>
			<input type="checkbox" name='appetite_changes'><span class="text"><?php xl('Appetite Changes','e'); ?></span><br>
		</td>
		<td valign="top">
			<span class="bold"><?php xl('Immune System','e'); ?></span><br>
			<input type="checkbox" name='abnormal_lymph_nodes'><span class="text"><?php xl('Abnormal Lymph Nodes','e'); ?></span><br>
			<input type="checkbox" name='rheumatoid_arthritis'><span class="text"><?php xl('Rheumatoid Arthritis','e'); ?></span><br>
			<input type="checkbox" name='lupus'><span class="text"><?php xl('Lupus','e'); ?></span><br>
			<input type="checkbox" name='sjogrens'><span class="text"><?php xl('Sjogren\'s','e'); ?></span><br>
			<input type="checkbox" name='wegeners'><span class="text"><?php xl('Wegener\'s','e'); ?></span><br>
			<input type="checkbox" name='psoriasis'><span class="text"><?php xl('Psoriasis','e'); ?></span><br>
			<input type="checkbox" name='osteoarthritis'><span class="text"><?php xl('Osteoarthritis','e'); ?></span><br>
		</td>
	</tr>
</table>

</fieldset>
</div> <!-- end form_container -->

<!-- Save/Cancel buttons -->
<div id="bottom_buttons" class="button_bar">
<fieldset>
<input type="button" class="save" value="<?php xl('Save','e'); ?>" />
<input type="button" class="dontsave" value="<?php xl('Don\'t Save','e'); ?>" />
</fieldset>
</div><!-- end bottom_buttons -->
</form>
<script type="text/javascript">
// jQuery stuff to make the page a little easier to use

$(document).ready(function(){
    $(".save").click(function() { top.restoreSession(); document.forms["<?php echo $form_folder; ?>"].submit(); });
    $(".dontsave").click(function() { location.href='<?php echo "$rootdir/patient_file/encounter/$returnurl"; ?>'; });

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

