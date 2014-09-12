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
$field_names = array('weight_loss' => 'checkbox_list','weight_gain' => 'checkbox_list','fatigue' => 'checkbox_list','sleep_problems' => 'checkbox_list','vision_changes' => 'checkbox_list','blurry_vision' => 'checkbox_list','wear_glasses' => 'checkbox_list','floaters' => 'checkbox_list','glaucoma' => 'checkbox_list','hearing_loss' => 'checkbox_list','ringing' => 'checkbox_list','roaring' => 'checkbox_list','dizziness' => 'checkbox_list','vertigo' => 'checkbox_list','ear_pain' => 'checkbox_list','ear_drainage' => 'checkbox_list','ear_surgery' => 'checkbox_list','ear_infections' => 'checkbox_list','allergies' => 'checkbox_list','congestion' => 'checkbox_list','stuffiness' => 'checkbox_list','sinus_pain' => 'checkbox_list','sinus_pressure' => 'checkbox_list','sinus_surgery' => 'checkbox_list','blocked_breathing' => 'checkbox_list','hoarseness' => 'checkbox_list','dryness' => 'checkbox_list','voice_fatigue' => 'checkbox_list','frequent_throat_clearing' => 'checkbox_list','increased_phlegm' => 'checkbox_list','post_nasal_drip' => 'checkbox_list','face_pain' => 'checkbox_list','face_numbness' => 'checkbox_list','twitching' => 'checkbox_list','face_weakness' => 'checkbox_list','lopsided' => 'checkbox_list','neck_pain' => 'checkbox_list','mass' => 'checkbox_list','lump' => 'checkbox_list','goiter' => 'checkbox_list','spine_surgery' => 'checkbox_list','decreased_mobility' => 'checkbox_list','noisy_breathing' => 'checkbox_list','headache' => 'checkbox_list','numbness' => 'checkbox_list','weakness' => 'checkbox_list','walking_problems' => 'checkbox_list','chest_pain' => 'checkbox_list','heart_attack' => 'checkbox_list','heart_failure' => 'checkbox_list','abnormal_rhythm' => 'checkbox_list','breathing_changes' => 'checkbox_list','asthma' => 'checkbox_list','copd' => 'checkbox_list','smoking' => 'checkbox_list','cough' => 'checkbox_list','stomach_pain' => 'checkbox_list','diarrhea' => 'checkbox_list','constipation' => 'checkbox_list','nausea' => 'checkbox_list','vomiting' => 'checkbox_list','cramping' => 'checkbox_list','appetite_changes' => 'checkbox_list','abnormal_lymph_nodes' => 'checkbox_list','rheumatoid_arthritis' => 'checkbox_list','lupus' => 'checkbox_list','sjogrens' => 'checkbox_list','wegeners' => 'checkbox_list','psoriasis' => 'checkbox_list','osteoarthritis' => 'checkbox_list');
/* an array of the lists the fields may draw on. */
$lists = array('weight_loss' => 'NA_YES_NO', 'weight_gain' => 'NA_YES_NO', 'fatigue' => 'NA_YES_NO', 'sleep_problems' => 'NA_YES_NO', 'vision_changes' => 'NA_YES_NO', 'blurry_vision' => 'NA_YES_NO', 'wear_glasses' => 'NA_YES_NO', 'floaters' => 'NA_YES_NO', 'glaucoma' => 'NA_YES_NO', 'hearing_loss' => 'NA_YES_NO', 'ringing' => 'NA_YES_NO', 'roaring' => 'NA_YES_NO', 'dizziness' => 'NA_YES_NO', 'vertigo' => 'NA_YES_NO', 'ear_pain' => 'NA_YES_NO', 'ear_drainage' => 'NA_YES_NO', 'ear_surgery' => 'NA_YES_NO', 'ear_infections' => 'NA_YES_NO', 'allergies' => 'NA_YES_NO', 'congestion' => 'NA_YES_NO', 'stuffiness' => 'NA_YES_NO', 'sinus_pain' => 'NA_YES_NO', 'sinus_pressure' => 'NA_YES_NO', 'sinus_surgery' => 'NA_YES_NO', 'blocked_breathing' => 'NA_YES_NO', 'hoarseness' => 'NA_YES_NO', 'dryness' => 'NA_YES_NO', 'voice_fatigue' => 'NA_YES_NO', 'frequent_throat_clearing' => 'NA_YES_NO', 'increased_phlegm' => 'NA_YES_NO', 'post_nasal_drip' => 'NA_YES_NO', 'face_pain' => 'NA_YES_NO', 'face_numbness' => 'NA_YES_NO', 'twitching' => 'NA_YES_NO', 'face_weakness' => 'NA_YES_NO', 'lopsided' => 'NA_YES_NO', 'neck_pain' => 'NA_YES_NO', 'mass' => 'NA_YES_NO', 'lump' => 'NA_YES_NO', 'goiter' => 'NA_YES_NO', 'spine_surgery' => 'NA_YES_NO', 'decreased_mobility' => 'NA_YES_NO', 'noisy_breathing' => 'NA_YES_NO', 'headache' => 'NA_YES_NO', 'numbness' => 'NA_YES_NO', 'weakness' => 'NA_YES_NO', 'walking_problems' => 'NA_YES_NO', 'chest_pain' => 'NA_YES_NO', 'heart_attack' => 'NA_YES_NO', 'heart_failure' => 'NA_YES_NO', 'abnormal_rhythm' => 'NA_YES_NO', 'breathing_changes' => 'NA_YES_NO', 'asthma' => 'NA_YES_NO', 'copd' => 'NA_YES_NO', 'smoking' => 'NA_YES_NO', 'cough' => 'NA_YES_NO', 'stomach_pain' => 'NA_YES_NO', 'diarrhea' => 'NA_YES_NO', 'constipation' => 'NA_YES_NO', 'nausea' => 'NA_YES_NO', 'vomiting' => 'NA_YES_NO', 'cramping' => 'NA_YES_NO', 'appetite_changes' => 'NA_YES_NO', 'abnormal_lymph_nodes' => 'NA_YES_NO', 'rheumatoid_arthritis' => 'NA_YES_NO', 'lupus' => 'NA_YES_NO', 'sjogrens' => 'NA_YES_NO', 'wegeners' => 'NA_YES_NO', 'psoriasis' => 'NA_YES_NO', 'osteoarthritis' => 'NA_YES_NO');

/* get each field from $_POST[], storing them into $field_names associated with their names. */
foreach($field_names as $key=>$val)
{
    $pos = '';
    $neg = '';
    if ($val == 'textbox' || $val == 'textarea' || $val == 'provider' || $val == 'textfield')
    {
            $field_names[$key]=$_POST['form_'.$key];
    }
    if ($val == 'date')
    {
        $field_names[$key]=$_POST[$key];
    }
    if (($val == 'checkbox_list' ))
    {
        $field_names[$key]='';
        if (isset($_POST['form_'.$key]) && $_POST['form_'.$key] != 'none' ) /* if the form submitted some entries selected in that field */
        {
            $lres=sqlStatement("select * from list_options where list_id = '".$lists[$key]."' ORDER BY seq, title");
            while ($lrow = sqlFetchArray($lres))
            {
                if (is_array($_POST['form_'.$key]))
                    {
                        if ($_POST['form_'.$key][$lrow[option_id]])
                        {
                            if ($field_names[$key] != '')
                              $field_names[$key]=$field_names[$key].'|';
	                    $field_names[$key] = $field_names[$key].$lrow[option_id];
                        }
                    }
            }
        }
    }
    if (($val == 'checkbox_combo_list'))
    {
        $field_names[$key]='';
        if (isset($_POST['check_'.$key]) && $_POST['check_'.$key] != 'none' ) /* if the form submitted some entries selected in that field */
        {
            $lres=sqlStatement("select * from list_options where list_id = '".$lists[$key]."' ORDER BY seq, title");
            while ($lrow = sqlFetchArray($lres))
            {
                if (is_array($_POST['check_'.$key]))
                {
                    if ($_POST['check_'.$key][$lrow[option_id]])
                    {
                        if ($field_names[$key] != '')
                          $field_names[$key]=$field_names[$key].'|';
                        $field_names[$key] = $field_names[$key].$lrow[option_id].":xx".$_POST['form_'.$key][$lrow[option_id]];
                    }
                }
            }
        }
    }
    if (($val == 'dropdown_list'))
    {
        $field_names[$key]='';
        if (isset($_POST['form_'.$key]) && $_POST['form_'.$key] != 'none' ) /* if the form submitted some entries selected in that field */
        {
            $lres=sqlStatement("select * from list_options where list_id = '".$lists[$key]."' ORDER BY seq, title");
            while ($lrow = sqlFetchArray($lres))
            {
                if ($_POST['form_'.$key] == $lrow[option_id])
                {
                    $field_names[$key]=$lrow[option_id];
                    break;
                }
            }
        }
    }
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

