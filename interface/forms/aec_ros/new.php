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

$sectionCols = 3;
$radioOptions = array("N/A" => xl('N/A'),"YES" => xl('YES'),"NO" => xl('NO'));
$sections = array(
	array(
		'name' => 'General',
		'fields' => array(
			array('name' => 'weight_loss', 'label' => 'Weight Loss', 'type' => 'radio'),
			array('name' => 'weight_gain', 'label' => 'Weight Gain', 'type' => 'radio'),
			array('name' => 'fatigue', 'label' => 'Fatigue', 'type' => 'radio'),
			array('name' => 'sleep_problems', 'label' => 'Sleep Problems', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Eyes',
		'fields' => array(
			array('name' => 'vision_changes', 'label' => 'Changes in Vision', 'type' => 'radio'),
			array('name' => 'blurry_vision', 'label' => 'Blurry Vision', 'type' => 'radio'),
			array('name' => 'wear_glasses', 'label' => 'Wear Glasses', 'type' => 'radio'),
			array('name' => 'floaters', 'label' => 'Floaters', 'type' => 'radio'),
			array('name' => 'glaucoma', 'label' => 'Glaucoma', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Ears',
		'fields' => array(
			array('name' => 'hearing_loss', 'label' => 'Hearing Loss', 'type' => 'radio'),
			array('name' => 'ringing', 'label' => 'Ringing', 'type' => 'radio'),
			array('name' => 'roaring', 'label' => 'Roaring', 'type' => 'radio'),
			array('name' => 'dizziness', 'label' => 'Dizziness', 'type' => 'radio'),
			array('name' => 'vertigo', 'label' => 'Vertigo', 'type' => 'radio'),
			array('name' => 'ear_pain', 'label' => 'Ear Pain', 'type' => 'radio'),
			array('name' => 'ear_drainage', 'label' => 'Ear Drainage', 'type' => 'radio'),
			array('name' => 'ear_surgery', 'label' => 'Ear Surgery', 'type' => 'radio'),
			array('name' => 'ear_infections', 'label' => 'Ear Infections', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Nose',
		'fields' => array(
			array('name' => 'allergies', 'label' => 'Allergies', 'type' => 'radio'),
			array('name' => 'congestion', 'label' => 'Congestion', 'type' => 'radio'),
			array('name' => 'stuffiness', 'label' => 'Stuffiness', 'type' => 'radio'),
			array('name' => 'sinus_pain', 'label' => 'Sinus Pain', 'type' => 'radio'),
			array('name' => 'sinus_pressure', 'label' => 'Sinus Pressure', 'type' => 'radio'),
			array('name' => 'sinus_surgery', 'label' => 'Sinus Surgery', 'type' => 'radio'),
			array('name' => 'blocked_breathing', 'label' => 'Blocked Breathing', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Throat',
		'fields' => array(
			array('name' => 'hoarseness', 'label' => 'Hoarseness', 'type' => 'radio'),
			array('name' => 'dryness', 'label' => 'Dryness', 'type' => 'radio'),
			array('name' => 'voice_fatigue', 'label' => 'Voice Fatigue', 'type' => 'radio'),
			array('name' => 'frequent_throat_clearing', 'label' => 'Frequent Throat Clearing', 'type' => 'radio'),
			array('name' => 'increased_phlegm', 'label' => 'Increased Phlegm', 'type' => 'radio'),
			array('name' => 'post_nasal_drip', 'label' => 'Post Nasal Drip', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Face',
		'fields' => array(
			array('name' => 'face_pain', 'label' => 'Pain', 'type' => 'radio'),
			array('name' => 'face_numbness', 'label' => 'Numbness', 'type' => 'radio'),
			array('name' => 'twitching', 'label' => 'Twitching', 'type' => 'radio'),
			array('name' => 'face_weakness', 'label' => 'Weakness', 'type' => 'radio'),
			array('name' => 'lopsided', 'label' => 'Lopsided', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Neck',
		'fields' => array(
			array('name' => 'neck_pain', 'label' => 'Pain', 'type' => 'radio'),
			array('name' => 'mass', 'label' => 'Mass', 'type' => 'radio'),
			array('name' => 'lump', 'label' => 'Lump', 'type' => 'radio'),
			array('name' => 'goiter', 'label' => 'Goiter', 'type' => 'radio'),
			array('name' => 'spine_surgery', 'label' => 'Spine Surgery', 'type' => 'radio'),
			array('name' => 'decreased_mobility', 'label' => 'Decreased Mobility', 'type' => 'radio'),
			array('name' => 'noisy_breathing', 'label' => 'Noisy Breathing', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Neuro',
		'fields' => array(
			array('name' => 'headache', 'label' => 'Headache', 'type' => 'radio'),
			array('name' => 'numbness', 'label' => 'Numbness', 'type' => 'radio'),
			array('name' => 'weakness', 'label' => 'Weakness', 'type' => 'radio'),
			array('name' => 'walking_problems', 'label' => 'Walking Problems', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Heart',
		'fields' => array(
			array('name' => 'chest_pain', 'label' => 'Chest Pain', 'type' => 'radio'),
			array('name' => 'heart_attack', 'label' => 'Heart Attack', 'type' => 'radio'),
			array('name' => 'heart_failure', 'label' => 'Heart Failure', 'type' => 'radio'),
			array('name' => 'abnormal_rhythm', 'label' => 'Abnormal Rhythm', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Lungs',
		'fields' => array(
			array('name' => 'breathing_changes', 'label' => 'Changes in Breathing', 'type' => 'radio'),
			array('name' => 'asthma', 'label' => 'Asthma', 'type' => 'radio'),
			array('name' => 'copd', 'label' => 'COPD', 'type' => 'radio'),
			array('name' => 'smoking', 'label' => 'Smoking', 'type' => 'radio'),
			array('name' => 'cough', 'label' => 'Cough', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Gastrointestinal',
		'fields' => array(
			array('name' => 'stomach_pain', 'label' => 'Stomach Pain', 'type' => 'radio'),
			array('name' => 'diarrhea', 'label' => 'Diarrhea', 'type' => 'radio'),
			array('name' => 'constipation', 'label' => 'Constipation', 'type' => 'radio'),
			array('name' => 'nausea', 'label' => 'Nausea', 'type' => 'radio'),
			array('name' => 'vomiting', 'label' => 'Vomiting', 'type' => 'radio'),
			array('name' => 'cramping', 'label' => 'Cramping', 'type' => 'radio'),
			array('name' => 'appetite_changes', 'label' => 'Changes in Appetite', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Immune System',
		'fields' => array(
			array('name' => 'abnormal_lymph_nodes', 'label' => 'Abnormal Lymph Nodes', 'type' => 'radio'),
			array('name' => 'rheumatoid_arthritis', 'label' => 'Rheumatoid Arthritis', 'type' => 'radio'),
			array('name' => 'lupus', 'label' => 'Lupus', 'type' => 'radio'),
			array('name' => 'sjogrens', 'label' => 'Sjorgren\'s', 'type' => 'radio'),
			array('name' => 'wegeners', 'label' => 'Wegener\'s', 'type' => 'radio'),
			array('name' => 'psoriasis', 'label' => 'Psoriasis', 'type' => 'radio'),
			array('name' => 'osteoarthritis', 'label' => 'Osteoarthritis', 'type' => 'radio')
		)
	)
);


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

<?php
foreach($sections as $section):
	$fieldCount = count($section['fields']);
	$sectionRows = ceil($fieldCount/$sectionCols);
?>
<table class="section">
	<tr>
		<td><span class="sectionlabel"><?php echo $section['name'];?></span></td>
	</tr>
	<?php
	$i = 0;
	for($r = 0; $r < $sectionRows; $r++):
	?>
	<tr>
		<?php
		for($c = 0; $c < $sectionCols; $c++):
		?>
		<?php
		if($i < $fieldCount):
		?>
			<td class="response_prompt"><?php echo $section['fields'][$i]['label'];?>:</td>
			<td class="response">
			<?php
			if($section['fields'][$i]['type'] == 'radio'):
				foreach($radioOptions as $optVal => $optLabel):
			?>
					<label><input type="radio" name="<?php echo $section['fields'][$i]['name'];?>" value="<?php echo $optVal;?>" /><?php echo $optLabel;?></label>
			<?php
				endforeach;
			else:
			?>	
			<?php
			endif;
			?>
			</td>
			<?php
			$i++;
			?>
		<?php
		else:
		?>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		<?php
		endif;
		?>
		<?php
		endfor;
		?>
	</tr>
	<?php
	endfor;
	?>
</table>
<?php
endforeach;
?>

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

