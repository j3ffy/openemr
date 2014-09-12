<?php
/*
 * The page shown when the user requests to see this form in a "report view". does not allow editing contents, or saving. has 'print' and 'delete' buttons.
 */

/* for $GLOBALS[], ?? */
require_once('../../globals.php');
/* for acl_check(), ?? */
require_once($GLOBALS['srcdir'].'/api.inc');
/* for display_layout_rows(), ?? */
require_once($GLOBALS['srcdir'].'/options.inc.php');

/** CHANGE THIS - name of the database table associated with this form **/
$table_name = 'form_aec_reviewofsymptoms';

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
/* Use the formFetch function from api.inc to load the saved record */
$xyzzy = formFetch($table_name, $_GET['id']);

/* in order to use the layout engine's draw functions, we need a fake table of layout data. */
$manual_layouts = array( 
 'weight_loss' => 
   array( 'field_id' => 'weight_loss',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'weight_gain' => 
   array( 'field_id' => 'weight_gain',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'fatigue' => 
   array( 'field_id' => 'fatigue',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'sleep_problems' => 
   array( 'field_id' => 'sleep_problems',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'vision_changes' => 
   array( 'field_id' => 'vision_changes',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'blurry_vision' => 
   array( 'field_id' => 'blurry_vision',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'wear_glasses' => 
   array( 'field_id' => 'wear_glasses',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'floaters' => 
   array( 'field_id' => 'floaters',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'glaucoma' => 
   array( 'field_id' => 'glaucoma',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'hearing_loss' => 
   array( 'field_id' => 'hearing_loss',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'ringing' => 
   array( 'field_id' => 'ringing',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'roaring' => 
   array( 'field_id' => 'roaring',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'dizziness' => 
   array( 'field_id' => 'dizziness',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'vertigo' => 
   array( 'field_id' => 'vertigo',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'ear_pain' => 
   array( 'field_id' => 'ear_pain',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'ear_drainage' => 
   array( 'field_id' => 'ear_drainage',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'ear_surgery' => 
   array( 'field_id' => 'ear_surgery',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'ear_infections' => 
   array( 'field_id' => 'ear_infections',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'allergies' => 
   array( 'field_id' => 'allergies',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'congestion' => 
   array( 'field_id' => 'congestion',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'stuffiness' => 
   array( 'field_id' => 'stuffiness',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'sinus_pain' => 
   array( 'field_id' => 'sinus_pain',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'sinus_pressure' => 
   array( 'field_id' => 'sinus_pressure',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'sinus_surgery' => 
   array( 'field_id' => 'sinus_surgery',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'blocked_breathing' => 
   array( 'field_id' => 'blocked_breathing',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'hoarseness' => 
   array( 'field_id' => 'hoarseness',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'dryness' => 
   array( 'field_id' => 'dryness',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'voice_fatigue' => 
   array( 'field_id' => 'voice_fatigue',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'frequent_throat_clearing' => 
   array( 'field_id' => 'frequent_throat_clearing',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'increased_phlegm' => 
   array( 'field_id' => 'increased_phlegm',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'post_nasal_drip' => 
   array( 'field_id' => 'post_nasal_drip',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'face_pain' => 
   array( 'field_id' => 'face_pain',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'face_numbness' => 
   array( 'field_id' => 'face_numbness',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'twitching' => 
   array( 'field_id' => 'twitching',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'face_weakness' => 
   array( 'field_id' => 'face_weakness',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'lopsided' => 
   array( 'field_id' => 'lopsided',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'neck_pain' => 
   array( 'field_id' => 'neck_pain',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'mass' => 
   array( 'field_id' => 'mass',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'lump' => 
   array( 'field_id' => 'lump',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'goiter' => 
   array( 'field_id' => 'goiter',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'spine_surgery' => 
   array( 'field_id' => 'spine_surgery',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'decreased_mobility' => 
   array( 'field_id' => 'decreased_mobility',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'noisy_breathing' => 
   array( 'field_id' => 'noisy_breathing',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'headache' => 
   array( 'field_id' => 'headache',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'numbness' => 
   array( 'field_id' => 'numbness',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'weakness' => 
   array( 'field_id' => 'weakness',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'walking_problems' => 
   array( 'field_id' => 'walking_problems',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'chest_pain' => 
   array( 'field_id' => 'chest_pain',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'heart_attack' => 
   array( 'field_id' => 'heart_attack',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'heart_failure' => 
   array( 'field_id' => 'heart_failure',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'abnormal_rhythm' => 
   array( 'field_id' => 'abnormal_rhythm',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'breathing_changes' => 
   array( 'field_id' => 'breathing_changes',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'asthma' => 
   array( 'field_id' => 'asthma',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'copd' => 
   array( 'field_id' => 'copd',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'smoking' => 
   array( 'field_id' => 'smoking',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'cough' => 
   array( 'field_id' => 'cough',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'stomach_pain' => 
   array( 'field_id' => 'stomach_pain',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'diarrhea' => 
   array( 'field_id' => 'diarrhea',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'constipation' => 
   array( 'field_id' => 'constipation',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'nausea' => 
   array( 'field_id' => 'nausea',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'vomiting' => 
   array( 'field_id' => 'vomiting',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'cramping' => 
   array( 'field_id' => 'cramping',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'appetite_changes' => 
   array( 'field_id' => 'appetite_changes',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'abnormal_lymph_nodes' => 
   array( 'field_id' => 'abnormal_lymph_nodes',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'rheumatoid_arthritis' => 
   array( 'field_id' => 'rheumatoid_arthritis',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'lupus' => 
   array( 'field_id' => 'lupus',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'sjogrens' => 
   array( 'field_id' => 'sjogrens',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'wegeners' => 
   array( 'field_id' => 'wegeners',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'psoriasis' => 
   array( 'field_id' => 'psoriasis',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' ),
 'osteoarthritis' => 
   array( 'field_id' => 'osteoarthritis',
          'data_type' => '21',
          'fld_length' => '0',
          'description' => '',
          'list_id' => 'NA_YES_NO' )
 );

/* since we have no-where to return, abuse returnurl to link to the 'edit' page */
/* FIXME: pass the ID, create blank rows if necissary. */
$returnurl = "../../forms/$form_folder/view.php?mode=noencounter";


/* define check field functions. used for translating from fields to html viewable strings */

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>

<!-- declare this document as being encoded in UTF-8 -->
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" ></meta>

<!-- supporting javascript code -->
<!-- for dialog -->
<script type="text/javascript" src="<?php echo $GLOBALS['webroot']; ?>/library/dialog.js"></script>
<!-- For jquery, required by edit, print, and delete buttons. -->
<script type="text/javascript" src="<?php echo $GLOBALS['webroot']; ?>/library/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['webroot']; ?>/library/textformat.js"></script>

<!-- Global Stylesheet -->
<link rel="stylesheet" href="<?php echo $css_header; ?>" type="text/css"/>
<!-- Form Specific Stylesheet. -->
<link rel="stylesheet" href="../../forms/<?php echo $form_folder; ?>/style.css" type="text/css"/>

<script type="text/javascript">

<!-- FIXME: this needs to detect access method, and construct a URL appropriately! -->
function PrintForm() {
    newwin = window.open("<?php echo $rootdir.'/forms/'.$form_folder.'/print.php?id='.$_GET['id']; ?>","print_<?php echo $form_name; ?>");
}

</script>
<title><?php echo htmlspecialchars('Show '.$form_name); ?></title>

</head>
<body class="body_top">

<div id="title">
<span class="title"><?php xl($form_name,'e'); ?></span>
<?php
 if ($thisauth_write_addonly)
  { ?>
<a href="<?php echo $returnurl; ?>" onclick="top.restoreSession()">
<span class="back"><?php xl($tmore,'e'); ?></span>
</a>
<?php }; ?>
</div>

<form method="post" id="<?php echo $form_folder; ?>" action="">

<!-- container for the main body of the form -->
<div id="form_container">

<div id="show">

<!-- display the form's manual based fields -->
<table border='0' cellpadding='0' width='100%'>
<tr><td class='sectionlabel'>General</td><!-- called consumeRows 0112--> <!-- called consumeRows 2212--> <!-- called consumeRows 4312--> <!-- called consumeRows 6412--> <td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Weight Loss','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['weight_loss'], $xyzzy['weight_loss']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Weight Gain','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['weight_gain'], $xyzzy['weight_gain']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Fatigue','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['fatigue'], $xyzzy['fatigue']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Sleep Problems','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['sleep_problems'], $xyzzy['sleep_problems']); ?></td><!-- called consumeRows 8412--> <!-- Exiting not($fields)4--><td class='emptycell' colspan='1'></td></tr>
<tr><td class='sectionlabel'>Eyes</td><!-- called consumeRows 0112--> <!-- called consumeRows 2212--> <!-- called consumeRows 4312--> <!-- called consumeRows 6412--> <!-- called consumeRows 8512--> <td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Change in Vision','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['vision_changes'], $xyzzy['vision_changes']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Blurry Vision','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['blurry_vision'], $xyzzy['blurry_vision']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Wear Glasses','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['wear_glasses'], $xyzzy['wear_glasses']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Floaters','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['floaters'], $xyzzy['floaters']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Glaucoma','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['glaucoma'], $xyzzy['glaucoma']); ?></td><!-- called consumeRows 10512--> <!-- Exiting not($fields)2--><td class='emptycell' colspan='1'></td></tr>
<tr><td class='sectionlabel'>Ears</td><!-- called consumeRows 0112--> <!-- called consumeRows 2212--> <!-- called consumeRows 4312--> <!-- called consumeRows 6412--> <!-- called consumeRows 8512--> <!-- called consumeRows 10612--> <td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Hearing Loss','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['hearing_loss'], $xyzzy['hearing_loss']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Ringing','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['ringing'], $xyzzy['ringing']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Roaring','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['roaring'], $xyzzy['roaring']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Dizziness','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['dizziness'], $xyzzy['dizziness']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Vertigo','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['vertigo'], $xyzzy['vertigo']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Ear Pain','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['ear_pain'], $xyzzy['ear_pain']); ?></td></tr>
<tr><td valign='top'>&nbsp;</td><!-- called consumeRows 0112--> <!-- called consumeRows 2212--> <!-- called consumeRows 4312--> <td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Ear Drainage','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['ear_drainage'], $xyzzy['ear_drainage']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Ear Surgery','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['ear_surgery'], $xyzzy['ear_surgery']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Ear Infections','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['ear_infections'], $xyzzy['ear_infections']); ?></td><!-- called consumeRows 6312--> <!-- Exiting not($fields)6--><td class='emptycell' colspan='1'></td></tr>
<tr><td class='sectionlabel'>Nose</td><!-- called consumeRows 0112--> <!-- called consumeRows 2212--> <!-- called consumeRows 4312--> <!-- called consumeRows 6412--> <!-- called consumeRows 8512--> <!-- called consumeRows 10612--> <td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Allergies','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['allergies'], $xyzzy['allergies']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Congestion','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['congestion'], $xyzzy['congestion']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Stuffiness','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['stuffiness'], $xyzzy['stuffiness']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Pain','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['sinus_pain'], $xyzzy['sinus_pain']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Pressure','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['sinus_pressure'], $xyzzy['sinus_pressure']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Sinus Surgery','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['sinus_surgery'], $xyzzy['sinus_surgery']); ?></td></tr>
<tr><td valign='top'>&nbsp;</td><!-- called consumeRows 0112--> <td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Blocked Breathing','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['blocked_breathing'], $xyzzy['blocked_breathing']); ?></td><!-- called consumeRows 2112--> <!-- Exiting not($fields)10--><td class='emptycell' colspan='1'></td></tr>
<tr><td class='sectionlabel'>Throat</td><!-- called consumeRows 0112--> <!-- called consumeRows 2212--> <!-- called consumeRows 4312--> <!-- called consumeRows 6412--> <!-- called consumeRows 8512--> <!-- called consumeRows 10612--> <td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Hoarseness','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['hoarseness'], $xyzzy['hoarseness']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Dryness','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['dryness'], $xyzzy['dryness']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Voice Fatigue','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['voice_fatigue'], $xyzzy['voice_fatigue']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Frequent Throat Clearing','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['frequent_throat_clearing'], $xyzzy['frequent_throat_clearing']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Increased Phlegm','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['increased_phlegm'], $xyzzy['increased_phlegm']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Post Nasal Drip','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['post_nasal_drip'], $xyzzy['post_nasal_drip']); ?></td><!-- called consumeRows 12612--> <!-- Exiting not($fields)0--></tr>
<tr><td class='sectionlabel'>Face</td><!-- called consumeRows 0112--> <!-- called consumeRows 2212--> <!-- called consumeRows 4312--> <!-- called consumeRows 6412--> <!-- called consumeRows 8512--> <td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Pain','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['face_pain'], $xyzzy['face_pain']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Numbness','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['face_numbness'], $xyzzy['face_numbness']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Twitching','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['twitching'], $xyzzy['twitching']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Weakness','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['face_weakness'], $xyzzy['face_weakness']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Lopsided','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['lopsided'], $xyzzy['lopsided']); ?></td><!-- called consumeRows 10512--> <!-- Exiting not($fields)2--><td class='emptycell' colspan='1'></td></tr>
<tr><td class='sectionlabel'>Neck</td><!-- called consumeRows 0112--> <!-- called consumeRows 2212--> <!-- called consumeRows 4312--> <!-- called consumeRows 6412--> <!-- called consumeRows 8512--> <!-- called consumeRows 10612--> <td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Pain','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['neck_pain'], $xyzzy['neck_pain']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Mass','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['mass'], $xyzzy['mass']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Lump','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['lump'], $xyzzy['lump']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Goiter','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['goiter'], $xyzzy['goiter']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Spine Surgery','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['spine_surgery'], $xyzzy['spine_surgery']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Decreased Mobility','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['decreased_mobility'], $xyzzy['decreased_mobility']); ?></td></tr>
<tr><td valign='top'>&nbsp;</td><!-- called consumeRows 0112--> <td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Noisy Breathing','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['noisy_breathing'], $xyzzy['noisy_breathing']); ?></td><!-- called consumeRows 2112--> <!-- Exiting not($fields)10--><td class='emptycell' colspan='1'></td></tr>
<tr><td class='sectionlabel'>Neuro</td><!-- called consumeRows 0112--> <!-- called consumeRows 2212--> <!-- called consumeRows 4312--> <!-- called consumeRows 6412--> <td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Headache','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['headache'], $xyzzy['headache']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Numbness','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['numbness'], $xyzzy['numbness']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Weakness','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['weakness'], $xyzzy['weakness']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Walking Problems','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['walking_problems'], $xyzzy['walking_problems']); ?></td><!-- called consumeRows 8412--> <!-- Exiting not($fields)4--><td class='emptycell' colspan='1'></td></tr>
<tr><td class='sectionlabel'>Heart</td><!-- called consumeRows 0112--> <!-- called consumeRows 2212--> <!-- called consumeRows 4312--> <!-- called consumeRows 6412--> <td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Chest Pain','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['chest_pain'], $xyzzy['chest_pain']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Heart Attack','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['heart_attack'], $xyzzy['heart_attack']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Heart Failure','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['heart_failure'], $xyzzy['heart_failure']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Abnormal Rhythm','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['abnormal_rhythm'], $xyzzy['abnormal_rhythm']); ?></td><!-- called consumeRows 8412--> <!-- Exiting not($fields)4--><td class='emptycell' colspan='1'></td></tr>
<tr><td class='sectionlabel'>Lungs</td><!-- called consumeRows 0112--> <!-- called consumeRows 2212--> <!-- called consumeRows 4312--> <!-- called consumeRows 6412--> <!-- called consumeRows 8512--> <td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Breathing Changes','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['breathing_changes'], $xyzzy['breathing_changes']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Asthma','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['asthma'], $xyzzy['asthma']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('COPD','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['copd'], $xyzzy['copd']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Smoking','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['smoking'], $xyzzy['smoking']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Cough','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['cough'], $xyzzy['cough']); ?></td><!-- called consumeRows 10512--> <!-- Exiting not($fields)2--><td class='emptycell' colspan='1'></td></tr>
<tr><td class='sectionlabel'>Gastrointestinal</td><!-- called consumeRows 0112--> <!-- called consumeRows 2212--> <!-- called consumeRows 4312--> <!-- called consumeRows 6412--> <!-- called consumeRows 8512--> <!-- called consumeRows 10612--> <td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Stomach Pain','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['stomach_pain'], $xyzzy['stomach_pain']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Diarrhea','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['diarrhea'], $xyzzy['diarrhea']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Constipation','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['constipation'], $xyzzy['constipation']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Nausea','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['nausea'], $xyzzy['nausea']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Vomiting','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['vomiting'], $xyzzy['vomiting']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Cramping','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['cramping'], $xyzzy['cramping']); ?></td></tr>
<tr><td valign='top'>&nbsp;</td><!-- called consumeRows 0112--> <td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Appetite Changes','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['appetite_changes'], $xyzzy['appetite_changes']); ?></td><!-- called consumeRows 2112--> <!-- Exiting not($fields)10--><td class='emptycell' colspan='1'></td></tr>
<tr><td class='sectionlabel'>Immune System</td><!-- called consumeRows 0112--> <!-- called consumeRows 2212--> <!-- called consumeRows 4312--> <!-- called consumeRows 6412--> <!-- called consumeRows 8512--> <!-- called consumeRows 10612--> <td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Abnormal Lymph Nodes','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['abnormal_lymph_nodes'], $xyzzy['abnormal_lymph_nodes']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Rheumatoid Arthritis','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['rheumatoid_arthritis'], $xyzzy['rheumatoid_arthritis']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Lupus','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['lupus'], $xyzzy['lupus']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Sjogren\'s','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['sjogrens'], $xyzzy['sjogrens']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Wegener\'s','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['wegeners'], $xyzzy['wegeners']); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Psoriasis','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['psoriasis'], $xyzzy['psoriasis']); ?></td></tr>
<tr><td valign='top'>&nbsp;</td><!-- called consumeRows 0112--> <td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Osteoarthritis','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_display_field($manual_layouts['osteoarthritis'], $xyzzy['osteoarthritis']); ?></td><!-- called consumeRows 2112--> <!-- Exiting not($fields)10--><td class='emptycell' colspan='1'></td></tr>
</table>


</div><!-- end show -->

</div><!-- end form_container -->

<!-- Print button -->
<div id="button_bar" class="button_bar">
<fieldset class="button_bar">
<input type="button" class="print" value="<?php xl('Print','e'); ?>" />
</fieldset>
</div><!-- end button_bar -->

</form>
<script type="text/javascript">
// jQuery stuff to make the page a little easier to use

$(document).ready(function(){
    $(".print").click(function() { PrintForm(); });
});
</script>
</body>
</html>

