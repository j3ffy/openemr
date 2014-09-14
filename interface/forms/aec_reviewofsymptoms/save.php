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

/* an array of all of the fields' names and their types. */
$field_names = array('weight_loss' => 'checkbox','weight_gain' => 'checkbox','fatigue' => 'checkbox','sleep_problems' => 'checkbox','vision_changes' => 'checkbox','blurry_vision' => 'checkbox','wear_glasses' => 'checkbox','floaters' => 'checkbox','glaucoma' => 'checkbox','hearing_loss' => 'checkbox','ringing' => 'checkbox','roaring' => 'checkbox','dizziness' => 'checkbox','vertigo' => 'checkbox','ear_pain' => 'checkbox','ear_drainage' => 'checkbox','ear_surgery' => 'checkbox','ear_infections' => 'checkbox','allergies' => 'checkbox','congestion' => 'checkbox','stuffiness' => 'checkbox','sinus_pain' => 'checkbox','sinus_pressure' => 'checkbox','sinus_surgery' => 'checkbox','blocked_breathing' => 'checkbox','hoarseness' => 'checkbox','dryness' => 'checkbox','voice_fatigue' => 'checkbox','frequent_throat_clearing' => 'checkbox','increased_phlegm' => 'checkbox','post_nasal_drip' => 'checkbox','face_pain' => 'checkbox','face_numbness' => 'checkbox','twitching' => 'checkbox','face_weakness' => 'checkbox','lopsided' => 'checkbox','neck_pain' => 'checkbox','mass' => 'checkbox','lump' => 'checkbox','goiter' => 'checkbox','spine_surgery' => 'checkbox','decreased_mobility' => 'checkbox','noisy_breathing' => 'checkbox','headache' => 'checkbox','numbness' => 'checkbox','weakness' => 'checkbox','walking_problems' => 'checkbox','chest_pain' => 'checkbox','heart_attack' => 'checkbox','heart_failure' => 'checkbox','abnormal_rhythm' => 'checkbox','breathing_changes' => 'checkbox','asthma' => 'checkbox','copd' => 'checkbox','smoking' => 'checkbox','cough' => 'checkbox','stomach_pain' => 'checkbox','diarrhea' => 'checkbox','constipation' => 'checkbox','nausea' => 'checkbox','vomiting' => 'checkbox','cramping' => 'checkbox','appetite_changes' => 'checkbox','abnormal_lymph_nodes' => 'checkbox','rheumatoid_arthritis' => 'checkbox','lupus' => 'checkbox','sjogrens' => 'checkbox','wegeners' => 'checkbox','psoriasis' => 'checkbox','osteoarthritis' => 'checkbox');

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

