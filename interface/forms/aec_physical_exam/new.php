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
$form_name = 'AEC Physical Exam';

/** CHANGE THIS to match the folder you created for this form. **/
$form_folder = 'aec_physical_exam';

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
 'general' => 
   array( 'field_id' => 'general',
          'data_type' => '3',
          'fld_length' => '100',
          'max_length' => '4',
		  'default' => 'Alert and fully oriented in no apparent distress. Voice is strong and clear. Breathing quiet and non-labored on room air. Mesomorphic body habitus.',
          'description' => '',
          'list_id' => '' ),
 'neck' => 
   array( 'field_id' => 'neck',
          'data_type' => '3',
          'fld_length' => '100',
          'max_length' => '4',
		  'default' => 'Supple without adenopathy or masses. Trachea is midline without stridor. Thyroid is not enlarged or nodular to palpation.',
          'description' => '',
          'list_id' => '' ),
 'face_scalp' => 
   array( 'field_id' => 'face_scalp',
          'data_type' => '3',
          'fld_length' => '100',
          'max_length' => '4',
		  'default' => 'No edema or erythema. No cutaneous lesions. Facial movement full and symmetric. ',
          'description' => '',
          'list_id' => '' ),
 'cranial_nerves' => 
   array( 'field_id' => 'cranial_nerves',
          'data_type' => '3',
          'fld_length' => '100',
          'max_length' => '4',
		  'default' => 'Ofaction not tested. Visual acutity grossly intact, PERRL, EOMI, full and symmetric facial movement, palate elevation symmetric, gag reflex intact, tongue mobile and protrusion midline.',
          'description' => '',
          'list_id' => '' ),
 'ears' => 
   array( 'field_id' => 'ears',
          'data_type' => '3',
          'fld_length' => '100',
          'max_length' => '4',
		  'default' => 'Auricles are normally formed without lesions. Ear canals are clear bilaterally. Tympanic membranes are intact and translucent without effusion. Ossicular structures grossly intact.',
          'description' => '',
          'list_id' => '' ),
 'tuning_fork' => 
   array( 'field_id' => 'tuning_fork',
          'data_type' => '3',
          'fld_length' => '100',
          'max_length' => '4',
		  'default' => '512 and 1024 Hz tuning fork shows symmetric hearing, weber is midline, air conduction is louder than bone conduction bilaterally.',
          'description' => '',
          'list_id' => '' ),
 'eyes' => 
   array( 'field_id' => 'eyes',
          'data_type' => '3',
          'fld_length' => '100',
          'max_length' => '4',
		  'default' => 'Pupils equal, round, and reactive to light and accommodation. Extra-ocular movements are intact. Sclera white, conjunctiva pink without icterus or injection.',
          'description' => '',
          'list_id' => '' ),
 'nose' => 
   array( 'field_id' => 'nose',
          'data_type' => '3',
          'fld_length' => '100',
          'max_length' => '4',
		  'default' => 'Anterior rhinoscopy shows septum to be intact and midline.  No masses, polyps, or pus.  Mucosa is moist and without edema.',
          'description' => '',
          'list_id' => '' ),
 'oral_cavity' => 
   array( 'field_id' => 'oral_cavity',
          'data_type' => '3',
          'fld_length' => '100',
          'max_length' => '4',
		  'default' => 'Mucosa is moist without lesion. Tongue is soft and freely mobile. Dentition is in good repair.  There is no trismus.',
          'description' => '',
          'list_id' => '' ),
 'oropharynx' => 
   array( 'field_id' => 'oropharynx',
          'data_type' => '3',
          'fld_length' => '100',
          'max_length' => '4',
		  'default' => 'Tonsils are unremarkable.  Pharyngeal walls without mucosal lesion or cobblestoning.  Soft palate is intact and elevates symmetrically.  Strong intact gag reflex.',
          'description' => '',
          'list_id' => '' ),
 'nasopharynx' => 
   array( 'field_id' => 'nasopharynx',
          'data_type' => '3',
          'fld_length' => '100',
          'max_length' => '4',
		  'default' => 'Indirect mirror exam shows the choanae to be patent. Eustachain orifices are no obstructed.  No masses or lesions noted.',
          'description' => '',
          'list_id' => '' ),
 'larynx_hypopharynx' => 
   array( 'field_id' => 'larynx_hypopharynx',
          'data_type' => '3',
          'fld_length' => '100',
          'max_length' => '4',
		  'default' => 'Indirect mirror exam shows no supraglottic masses. True vocal folds are fully mobile and without obvious lesion. No pooling of secretions.',
          'description' => '',
          'list_id' => '' )
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
	<tr>
		<td class='sectionlabel'><input type='checkbox' id='form_cb_m_1' value='1' data-section="physical_exam" checked="checked" />Physical Exam</td>
	</tr>
	<tr>
		<td>
			<div id="physical_exam" class='section'>
				<table>
					<tr>
						<td class='fieldlabel' colspan='1'><?php echo xl_layout_label('General','e').':'; ?></td>
						<td class='text data' colspan='9'><?php echo generate_form_field($manual_layouts['general'], $manual_layouts['general']['default']); ?></td>
						<td class='emptycell' colspan='1'></td>
					</tr>
					<tr>
						<td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Neck','e').':'; ?></td>
						<td class='text data' colspan='9'><?php echo generate_form_field($manual_layouts['neck'], $manual_layouts['neck']['default']); ?></td>
						<td class='emptycell' colspan='1'></td>
					</tr>
					<tr>
						<td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Face/Scalp','e').':'; ?></td>
						<td class='text data' colspan='9'><?php echo generate_form_field($manual_layouts['face_scalp'], $manual_layouts['face_scalp']['default']); ?></td>
						<td class='emptycell' colspan='1'></td>
					</tr>
					<tr>
						<td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Cranial Nerves','e').':'; ?></td>
						<td class='text data' colspan='9'><?php echo generate_form_field($manual_layouts['cranial_nerves'], $manual_layouts['cranial_nerves']['default']); ?></td>
						<td class='emptycell' colspan='1'></td>
					</tr>
					<tr>
						<td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Ears','e').':'; ?></td>
						<td class='text data' colspan='9'><?php echo generate_form_field($manual_layouts['ears'], $manual_layouts['ears']['default']); ?></td>
						<td class='emptycell' colspan='1'></td>
					</tr>
					<tr>
						<td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Tuning Fork','e').':'; ?></td>
						<td class='text data' colspan='9'><?php echo generate_form_field($manual_layouts['tuning_fork'], $manual_layouts['tuning_fork']['default']); ?></td>
						<td class='emptycell' colspan='1'></td>
					</tr>
					<tr>
						<td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Eyes','e').':'; ?></td>
						<td class='text data' colspan='9'><?php echo generate_form_field($manual_layouts['eyes'], $manual_layouts['eyes']['default']); ?></td>
						<td class='emptycell' colspan='1'></td>
					</tr>
					<tr>
						<td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Nose','e').':'; ?></td>
						<td class='text data' colspan='9'><?php echo generate_form_field($manual_layouts['nose'], $manual_layouts['nose']['default']); ?></td>
						<td class='emptycell' colspan='1'></td>
					</tr>
					<tr>
						<td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Oral Cavity','e').':'; ?></td>
						<td class='text data' colspan='9'><?php echo generate_form_field($manual_layouts['oral_cavity'], $manual_layouts['oral_cavity']['default']); ?></td>
						<td class='emptycell' colspan='1'></td>
					</tr>
					<tr>
						<td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Oropharynx','e').':'; ?></td>
						<td class='text data' colspan='9'><?php echo generate_form_field($manual_layouts['oropharynx'], $manual_layouts['oropharynx']['default']); ?></td>
						<td class='emptycell' colspan='1'></td>
					</tr>
					<tr>
						<td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Nasopharynx','e').':'; ?></td>
						<td class='text data' colspan='9'><?php echo generate_form_field($manual_layouts['nasopharynx'], $manual_layouts['nasopharynx']['default']); ?></td>
						<td class='emptycell' colspan='1'></td>
					</tr>
					<tr>
						<td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Larynx / Hypopharynx','e').':'; ?></td>
						<td class='text data' colspan='9'><?php echo generate_form_field($manual_layouts['larynx_hypopharynx'], $manual_layouts['larynx_hypopharynx']['default']); ?></td>
					</tr>
				</table>
			</div>
		</td>
	</tr> <!-- end section physical_exam -->
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

