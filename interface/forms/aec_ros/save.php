<?php
/* this page is intended to be the 'action=' target of a form object.
 * it is called to save the contents of the form into the database
 */

/* for $GLOBALS[], ?? */
require_once('../../globals.php');
/* for acl_check(), ?? */
require_once($GLOBALS['srcdir'].'/api.inc');
/* for ??? */
require_once($GLOBALS['srcdir'].'/forms.inc');
/* for formDataCore() */
require_once($GLOBALS['srcdir'].'/formdata.inc.php');

/** CHANGE THIS - name of the database table associated with this form **/
$table_name = 'form_aec_ros';

/** CHANGE THIS name to the name of your form. **/
$form_name = 'Ashford Review of Symptoms';

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

/* an array of all of the fields' names and their types. */
$field_names = array('weight_loss' => 'radio','weight_gain' => 'radio','fatigue' => 'radio','sleep_problems' => 'radio','vision_changes' => 'radio','blurry_vision' => 'radio','wear_glasses' => 'radio','floaters' => 'radio','glaucoma' => 'radio','hearing_loss' => 'radio','ringing' => 'radio','roaring' => 'radio','dizziness' => 'radio','vertigo' => 'radio','ear_pain' => 'radio','ear_drainage' => 'radio','ear_surgery' => 'radio','ear_infections' => 'radio','allergies' => 'radio','congestion' => 'radio','stuffiness' => 'radio','sinus_pain' => 'radio','sinus_pressure' => 'radio','sinus_surgery' => 'radio','blocked_breathing' => 'radio','hoarseness' => 'radio','dryness' => 'radio','voice_fatigue' => 'radio','frequent_throat_clearing' => 'radio','increased_phlegm' => 'radio','post_nasal_drip' => 'radio','face_pain' => 'radio','face_numbness' => 'radio','twitching' => 'radio','face_weakness' => 'radio','lopsided' => 'radio','neck_pain' => 'radio','mass' => 'radio','lump' => 'radio','goiter' => 'radio','spine_surgery' => 'radio','decreased_mobility' => 'radio','noisy_breathing' => 'radio','headache' => 'radio','numbness' => 'radio','weakness' => 'radio','walking_problems' => 'radio','chest_pain' => 'radio','heart_attack' => 'radio','heart_failure' => 'radio','abnormal_rhythm' => 'radio','breathing_changes' => 'radio','asthma' => 'radio','copd' => 'radio','smoking' => 'radio','cough' => 'radio','stomach_pain' => 'radio','diarrhea' => 'radio','constipation' => 'radio','nausea' => 'radio','vomiting' => 'radio','cramping' => 'radio','appetite_changes' => 'radio','abnormal_lymph_nodes' => 'radio','rheumatoid_arthritis' => 'radio','lupus' => 'radio','sjogrens' => 'radio','wegeners' => 'radio','psoriasis' => 'radio','osteoarthritis' => 'radio');

/* get each field from $_POST[], storing them into $field_names associated with their names. */
foreach($field_names as $key=>$val)
{
    $field_names[$key]=$_POST[$key];
}

/* at this point, field_names[] contains an array of name->value pairs of the fields we expected from the form. */

/* escape form data for entry to the database. */
foreach ($field_names as $k => $var) {
  $field_names[$k] = formDataCore($var);
}

if ($encounter == '') $encounter = date('Ymd');

if ($_GET['mode'] == 'new') {
    /* NOTE - for customization you can replace $_POST with your own array
     * of key=>value pairs where 'key' is the table field name and
     * 'value' is whatever it should be set to
     * ex)   $newrecord['parent_sig'] = $_POST['sig'];
     *       $newid = formSubmit($table_name, $newrecord, $_GET['id'], $userauthorized);
     */

    /* make sure we're at the beginning of the array */
    reset($field_names);

    /* save the data into the form's encounter-based table */
    $newid = formSubmit($table_name, $field_names, $_GET['id'], $userauthorized);
    /* link this form into the encounter. */
    addForm($encounter, $form_name, $newid, $form_folder, $pid, $userauthorized);
}

elseif ($_GET['mode'] == 'update') {
    /* make sure we're at the beginning of the array */
    reset($field_names);

    /* update the data in the form's table */
    $success = formUpdate($table_name, $field_names, $_GET['id'], $userauthorized);
    /* sqlInsert('update '.$table_name." set pid = {".$_SESSION['pid']."},groupname='".$_SESSION['authProvider']."',user='".$_SESSION['authUser']."',authorized=$userauthorized,activity=1,date = NOW(), where id=$id"); */
}


$_SESSION['encounter'] = $encounter;

formHeader('Redirecting....');
/* defaults to the encounters page. */
formJump();

formFooter();
?>

