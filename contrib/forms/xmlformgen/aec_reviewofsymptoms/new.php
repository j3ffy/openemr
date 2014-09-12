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
$form_name = 'Ashford Review of Symptoms';

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
/* in order to use the layout engine's draw functions, we need a fake table of layout data. */
$manual_layouts = array( 
 'weight_loss' => 
   array( 'field_id' => 'weight_loss',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'weight_gain' => 
   array( 'field_id' => 'weight_gain',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'fatigue' => 
   array( 'field_id' => 'fatigue',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'sleep_problems' => 
   array( 'field_id' => 'sleep_problems',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'vision_changes' => 
   array( 'field_id' => 'vision_changes',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'blurry_vision' => 
   array( 'field_id' => 'blurry_vision',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'wear_glasses' => 
   array( 'field_id' => 'wear_glasses',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'floaters' => 
   array( 'field_id' => 'floaters',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'glaucoma' => 
   array( 'field_id' => 'glaucoma',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'hearing_loss' => 
   array( 'field_id' => 'hearing_loss',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'ringing' => 
   array( 'field_id' => 'ringing',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'roaring' => 
   array( 'field_id' => 'roaring',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'dizziness' => 
   array( 'field_id' => 'dizziness',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'vertigo' => 
   array( 'field_id' => 'vertigo',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'ear_pain' => 
   array( 'field_id' => 'ear_pain',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'ear_drainage' => 
   array( 'field_id' => 'ear_drainage',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'ear_surgery' => 
   array( 'field_id' => 'ear_surgery',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'ear_infections' => 
   array( 'field_id' => 'ear_infections',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'allergies' => 
   array( 'field_id' => 'allergies',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'congestion' => 
   array( 'field_id' => 'congestion',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'stuffiness' => 
   array( 'field_id' => 'stuffiness',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'sinus_pain' => 
   array( 'field_id' => 'sinus_pain',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'sinus_pressure' => 
   array( 'field_id' => 'sinus_pressure',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'sinus_surgery' => 
   array( 'field_id' => 'sinus_surgery',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'blocked_breathing' => 
   array( 'field_id' => 'blocked_breathing',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'hoarseness' => 
   array( 'field_id' => 'hoarseness',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'dryness' => 
   array( 'field_id' => 'dryness',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'voice_fatigue' => 
   array( 'field_id' => 'voice_fatigue',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'frequent_throat_clearing' => 
   array( 'field_id' => 'frequent_throat_clearing',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'increased_phlegm' => 
   array( 'field_id' => 'increased_phlegm',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'post_nasal_drip' => 
   array( 'field_id' => 'post_nasal_drip',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'face_pain' => 
   array( 'field_id' => 'face_pain',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'face_numbness' => 
   array( 'field_id' => 'face_numbness',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'twitching' => 
   array( 'field_id' => 'twitching',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'face_weakness' => 
   array( 'field_id' => 'face_weakness',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'lopsided' => 
   array( 'field_id' => 'lopsided',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'neck_pain' => 
   array( 'field_id' => 'neck_pain',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'mass' => 
   array( 'field_id' => 'mass',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'lump' => 
   array( 'field_id' => 'lump',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'goiter' => 
   array( 'field_id' => 'goiter',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'spine_surgery' => 
   array( 'field_id' => 'spine_surgery',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'decreased_mobility' => 
   array( 'field_id' => 'decreased_mobility',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'noisy_breathing' => 
   array( 'field_id' => 'noisy_breathing',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'headache' => 
   array( 'field_id' => 'headache',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'numbness' => 
   array( 'field_id' => 'numbness',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'weakness' => 
   array( 'field_id' => 'weakness',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'walking_problems' => 
   array( 'field_id' => 'walking_problems',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'chest_pain' => 
   array( 'field_id' => 'chest_pain',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'heart_attack' => 
   array( 'field_id' => 'heart_attack',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'heart_failure' => 
   array( 'field_id' => 'heart_failure',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'abnormal_rhythm' => 
   array( 'field_id' => 'abnormal_rhythm',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'breathing_changes' => 
   array( 'field_id' => 'breathing_changes',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'asthma' => 
   array( 'field_id' => 'asthma',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'copd' => 
   array( 'field_id' => 'copd',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'smoking' => 
   array( 'field_id' => 'smoking',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'cough' => 
   array( 'field_id' => 'cough',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'stomach_pain' => 
   array( 'field_id' => 'stomach_pain',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'diarrhea' => 
   array( 'field_id' => 'diarrhea',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'constipation' => 
   array( 'field_id' => 'constipation',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'nausea' => 
   array( 'field_id' => 'nausea',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'vomiting' => 
   array( 'field_id' => 'vomiting',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'cramping' => 
   array( 'field_id' => 'cramping',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'appetite_changes' => 
   array( 'field_id' => 'appetite_changes',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'abnormal_lymph_nodes' => 
   array( 'field_id' => 'abnormal_lymph_nodes',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'rheumatoid_arthritis' => 
   array( 'field_id' => 'rheumatoid_arthritis',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'lupus' => 
   array( 'field_id' => 'lupus',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'sjogrens' => 
   array( 'field_id' => 'sjogrens',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'wegeners' => 
   array( 'field_id' => 'wegeners',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'psoriasis' => 
   array( 'field_id' => 'psoriasis',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'osteoarthritis' => 
   array( 'field_id' => 'osteoarthritis',
          'data_type' => '27',
          'fld_length' => '3',
          'description' => '',
          'list_id' => 'NA_YES_NO' )
 );
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

<!-- display the form's manual based fields -->
<table border='0' cellpadding='0' width='100%'>
<tr><td class='sectionlabel'><input type='checkbox' id='form_cb_m_1' value='1' data-section="general" checked="checked" />General</td></tr><tr><td><div id="general" class='section'><table>
<!-- called consumeRows 0112--> <!-- just calling --><!-- called consumeRows 2212--> <!-- just calling --><!-- called consumeRows 4312--> <!-- just calling --><!-- called consumeRows 6412--> <!-- generating not($fields[$checked+1]) and calling last --><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Weight Loss','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['weight_loss'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Weight Gain','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['weight_gain'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Fatigue','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['fatigue'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Sleep Problems','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['sleep_problems'], ''); ?></td><!-- called consumeRows 8412--> <!-- Exiting not($fields) and generating 4 empty fields --><td class='emptycell' colspan='1'></td></tr>
</table></div>
</td></tr> <!-- end section general -->
<tr><td class='sectionlabel'><input type='checkbox' id='form_cb_m_2' value='1' data-section="eyes" checked="checked" />Eyes</td></tr><tr><td><div id="eyes" class='section'><table>
<!-- called consumeRows 0112--> <!-- just calling --><!-- called consumeRows 2212--> <!-- just calling --><!-- called consumeRows 4312--> <!-- just calling --><!-- called consumeRows 6412--> <!-- just calling --><!-- called consumeRows 8512--> <!-- generating not($fields[$checked+1]) and calling last --><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Change in Vision','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['vision_changes'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Blurry Vision','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['blurry_vision'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Wear Glasses','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['wear_glasses'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Floaters','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['floaters'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Glaucoma','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['glaucoma'], ''); ?></td><!-- called consumeRows 10512--> <!-- Exiting not($fields) and generating 2 empty fields --><td class='emptycell' colspan='1'></td></tr>
</table></div>
</td></tr> <!-- end section eyes -->
<tr><td class='sectionlabel'><input type='checkbox' id='form_cb_m_3' value='1' data-section="ears" checked="checked" />Ears</td></tr><tr><td><div id="ears" class='section'><table>
<!-- called consumeRows 0112--> <!-- just calling --><!-- called consumeRows 2212--> <!-- just calling --><!-- called consumeRows 4312--> <!-- just calling --><!-- called consumeRows 6412--> <!-- just calling --><!-- called consumeRows 8512--> <!-- just calling --><!-- called consumeRows 10612--> <!--  generating 12 cells and calling --><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Hearing Loss','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['hearing_loss'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Ringing','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['ringing'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Roaring','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['roaring'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Dizziness','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['dizziness'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Vertigo','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['vertigo'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Ear Pain','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['ear_pain'], ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<!-- called consumeRows 0112--> <!-- just calling --><!-- called consumeRows 2212--> <!-- just calling --><!-- called consumeRows 4312--> <!-- generating not($fields[$checked+1]) and calling last --><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Ear Drainage','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['ear_drainage'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Ear Surgery','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['ear_surgery'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Ear Infections','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['ear_infections'], ''); ?></td><!-- called consumeRows 6312--> <!-- Exiting not($fields) and generating 6 empty fields --><td class='emptycell' colspan='1'></td></tr>
</table></div>
</td></tr> <!-- end section ears -->
<tr><td class='sectionlabel'><input type='checkbox' id='form_cb_m_4' value='1' data-section="nose" checked="checked" />Nose</td></tr><tr><td><div id="nose" class='section'><table>
<!-- called consumeRows 0112--> <!-- just calling --><!-- called consumeRows 2212--> <!-- just calling --><!-- called consumeRows 4312--> <!-- just calling --><!-- called consumeRows 6412--> <!-- just calling --><!-- called consumeRows 8512--> <!-- just calling --><!-- called consumeRows 10612--> <!--  generating 12 cells and calling --><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Allergies','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['allergies'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Congestion','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['congestion'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Stuffiness','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['stuffiness'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Pain','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['sinus_pain'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Pressure','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['sinus_pressure'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Sinus Surgery','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['sinus_surgery'], ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<!-- called consumeRows 0112--> <!-- generating not($fields[$checked+1]) and calling last --><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Blocked Breathing','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['blocked_breathing'], ''); ?></td><!-- called consumeRows 2112--> <!-- Exiting not($fields) and generating 10 empty fields --><td class='emptycell' colspan='1'></td></tr>
</table></div>
</td></tr> <!-- end section nose -->
<tr><td class='sectionlabel'><input type='checkbox' id='form_cb_m_5' value='1' data-section="throat" checked="checked" />Throat</td></tr><tr><td><div id="throat" class='section'><table>
<!-- called consumeRows 0112--> <!-- just calling --><!-- called consumeRows 2212--> <!-- just calling --><!-- called consumeRows 4312--> <!-- just calling --><!-- called consumeRows 6412--> <!-- just calling --><!-- called consumeRows 8512--> <!-- just calling --><!-- called consumeRows 10612--> <!-- generating not($fields[$checked+1]) and calling last --><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Hoarseness','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['hoarseness'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Dryness','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['dryness'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Voice Fatigue','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['voice_fatigue'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Frequent Throat Clearing','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['frequent_throat_clearing'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Increased Phlegm','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['increased_phlegm'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Post Nasal Drip','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['post_nasal_drip'], ''); ?></td><!-- called consumeRows 12612--> <!-- Exiting not($fields) and generating 0 empty fields --></tr>
</table></div>
</td></tr> <!-- end section throat -->
<tr><td class='sectionlabel'><input type='checkbox' id='form_cb_m_6' value='1' data-section="face" checked="checked" />Face</td></tr><tr><td><div id="face" class='section'><table>
<!-- called consumeRows 0112--> <!-- just calling --><!-- called consumeRows 2212--> <!-- just calling --><!-- called consumeRows 4312--> <!-- just calling --><!-- called consumeRows 6412--> <!-- just calling --><!-- called consumeRows 8512--> <!-- generating not($fields[$checked+1]) and calling last --><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Pain','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['face_pain'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Numbness','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['face_numbness'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Twitching','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['twitching'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Weakness','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['face_weakness'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Lopsided','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['lopsided'], ''); ?></td><!-- called consumeRows 10512--> <!-- Exiting not($fields) and generating 2 empty fields --><td class='emptycell' colspan='1'></td></tr>
</table></div>
</td></tr> <!-- end section face -->
<tr><td class='sectionlabel'><input type='checkbox' id='form_cb_m_7' value='1' data-section="neck" checked="checked" />Neck</td></tr><tr><td><div id="neck" class='section'><table>
<!-- called consumeRows 0112--> <!-- just calling --><!-- called consumeRows 2212--> <!-- just calling --><!-- called consumeRows 4312--> <!-- just calling --><!-- called consumeRows 6412--> <!-- just calling --><!-- called consumeRows 8512--> <!-- just calling --><!-- called consumeRows 10612--> <!--  generating 12 cells and calling --><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Pain','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['neck_pain'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Mass','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mass'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Lump','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['lump'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Goiter','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['goiter'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Spine Surgery','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['spine_surgery'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Decreased Mobility','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['decreased_mobility'], ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<!-- called consumeRows 0112--> <!-- generating not($fields[$checked+1]) and calling last --><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Noisy Breathing','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['noisy_breathing'], ''); ?></td><!-- called consumeRows 2112--> <!-- Exiting not($fields) and generating 10 empty fields --><td class='emptycell' colspan='1'></td></tr>
</table></div>
</td></tr> <!-- end section neck -->
<tr><td class='sectionlabel'><input type='checkbox' id='form_cb_m_8' value='1' data-section="neuro" checked="checked" />Neuro</td></tr><tr><td><div id="neuro" class='section'><table>
<!-- called consumeRows 0112--> <!-- just calling --><!-- called consumeRows 2212--> <!-- just calling --><!-- called consumeRows 4312--> <!-- just calling --><!-- called consumeRows 6412--> <!-- generating not($fields[$checked+1]) and calling last --><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Headache','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['headache'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Numbness','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['numbness'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Weakness','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['weakness'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Walking Problems','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['walking_problems'], ''); ?></td><!-- called consumeRows 8412--> <!-- Exiting not($fields) and generating 4 empty fields --><td class='emptycell' colspan='1'></td></tr>
</table></div>
</td></tr> <!-- end section neuro -->
<tr><td class='sectionlabel'><input type='checkbox' id='form_cb_m_9' value='1' data-section="heart" checked="checked" />Heart</td></tr><tr><td><div id="heart" class='section'><table>
<!-- called consumeRows 0112--> <!-- just calling --><!-- called consumeRows 2212--> <!-- just calling --><!-- called consumeRows 4312--> <!-- just calling --><!-- called consumeRows 6412--> <!-- generating not($fields[$checked+1]) and calling last --><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Chest Pain','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['chest_pain'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Heart Attack','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['heart_attack'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Heart Failure','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['heart_failure'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Abnormal Rhythm','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['abnormal_rhythm'], ''); ?></td><!-- called consumeRows 8412--> <!-- Exiting not($fields) and generating 4 empty fields --><td class='emptycell' colspan='1'></td></tr>
</table></div>
</td></tr> <!-- end section heart -->
<tr><td class='sectionlabel'><input type='checkbox' id='form_cb_m_10' value='1' data-section="lungs" checked="checked" />Lungs</td></tr><tr><td><div id="lungs" class='section'><table>
<!-- called consumeRows 0112--> <!-- just calling --><!-- called consumeRows 2212--> <!-- just calling --><!-- called consumeRows 4312--> <!-- just calling --><!-- called consumeRows 6412--> <!-- just calling --><!-- called consumeRows 8512--> <!-- generating not($fields[$checked+1]) and calling last --><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Breathing Changes','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['breathing_changes'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Asthma','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['asthma'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('COPD','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['copd'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Smoking','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['smoking'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Cough','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['cough'], ''); ?></td><!-- called consumeRows 10512--> <!-- Exiting not($fields) and generating 2 empty fields --><td class='emptycell' colspan='1'></td></tr>
</table></div>
</td></tr> <!-- end section lungs -->
<tr><td class='sectionlabel'><input type='checkbox' id='form_cb_m_11' value='1' data-section="gi" checked="checked" />Gastrointestinal</td></tr><tr><td><div id="gi" class='section'><table>
<!-- called consumeRows 0112--> <!-- just calling --><!-- called consumeRows 2212--> <!-- just calling --><!-- called consumeRows 4312--> <!-- just calling --><!-- called consumeRows 6412--> <!-- just calling --><!-- called consumeRows 8512--> <!-- just calling --><!-- called consumeRows 10612--> <!--  generating 12 cells and calling --><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Stomach Pain','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['stomach_pain'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Diarrhea','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['diarrhea'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Constipation','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['constipation'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Nausea','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['nausea'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Vomiting','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['vomiting'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Cramping','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['cramping'], ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<!-- called consumeRows 0112--> <!-- generating not($fields[$checked+1]) and calling last --><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Appetite Changes','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['appetite_changes'], ''); ?></td><!-- called consumeRows 2112--> <!-- Exiting not($fields) and generating 10 empty fields --><td class='emptycell' colspan='1'></td></tr>
</table></div>
</td></tr> <!-- end section gi -->
<tr><td class='sectionlabel'><input type='checkbox' id='form_cb_m_12' value='1' data-section="immune_system" checked="checked" />Immune System</td></tr><tr><td><div id="immune_system" class='section'><table>
<!-- called consumeRows 0112--> <!-- just calling --><!-- called consumeRows 2212--> <!-- just calling --><!-- called consumeRows 4312--> <!-- just calling --><!-- called consumeRows 6412--> <!-- just calling --><!-- called consumeRows 8512--> <!-- just calling --><!-- called consumeRows 10612--> <!--  generating 12 cells and calling --><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Abnormal Lymph Nodes','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['abnormal_lymph_nodes'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Rheumatoid Arthritis','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['rheumatoid_arthritis'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Lupus','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['lupus'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Sjogren\'s','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['sjogrens'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Wegener\'s','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['wegeners'], ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Psoriasis','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['psoriasis'], ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<!-- called consumeRows 0112--> <!-- generating not($fields[$checked+1]) and calling last --><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Osteoarthritis','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['osteoarthritis'], ''); ?></td><!-- called consumeRows 2112--> <!-- Exiting not($fields) and generating 10 empty fields --><td class='emptycell' colspan='1'></td></tr>
</table></div>
</td></tr> <!-- end section immune_system -->
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

