<?php
/*
 * this file's contents are included in both the encounter page as a 'quick summary' of a form, and in the medical records' reports page.
 */

/* for $GLOBALS[], ?? */
require_once('../../globals.php');
/* for acl_check(), ?? */
require_once($GLOBALS['srcdir'].'/api.inc');
/* for generate_display_field() */
require_once($GLOBALS['srcdir'].'/options.inc.php');
/* The name of the function is significant and must match the folder name */
function aec_reviewofsymptoms_report( $pid, $encounter, $cols, $id) {
    $count = 0;
/** CHANGE THIS - name of the database table associated with this form **/
$table_name = 'form_aec_reviewofsymptoms';


/* an array of all of the fields' names and their types. */
$field_names = array('weight_loss' => 'checkbox_list','weight_gain' => 'checkbox_list','fatigue' => 'checkbox_list','sleep_problems' => 'checkbox_list','vision_changes' => 'checkbox_list','blurry_vision' => 'checkbox_list','wear_glasses' => 'checkbox_list','floaters' => 'checkbox_list','glaucoma' => 'checkbox_list','hearing_loss' => 'checkbox_list','ringing' => 'checkbox_list','roaring' => 'checkbox_list','dizziness' => 'checkbox_list','vertigo' => 'checkbox_list','ear_pain' => 'checkbox_list','ear_drainage' => 'checkbox_list','ear_surgery' => 'checkbox_list','ear_infections' => 'checkbox_list','allergies' => 'checkbox_list','congestion' => 'checkbox_list','stuffiness' => 'checkbox_list','sinus_pain' => 'checkbox_list','sinus_pressure' => 'checkbox_list','sinus_surgery' => 'checkbox_list','blocked_breathing' => 'checkbox_list','hoarseness' => 'checkbox_list','dryness' => 'checkbox_list','voice_fatigue' => 'checkbox_list','frequent_throat_clearing' => 'checkbox_list','increased_phlegm' => 'checkbox_list','post_nasal_drip' => 'checkbox_list','face_pain' => 'checkbox_list','face_numbness' => 'checkbox_list','twitching' => 'checkbox_list','face_weakness' => 'checkbox_list','lopsided' => 'checkbox_list','neck_pain' => 'checkbox_list','mass' => 'checkbox_list','lump' => 'checkbox_list','goiter' => 'checkbox_list','spine_surgery' => 'checkbox_list','decreased_mobility' => 'checkbox_list','noisy_breathing' => 'checkbox_list','headache' => 'checkbox_list','numbness' => 'checkbox_list','weakness' => 'checkbox_list','walking_problems' => 'checkbox_list','chest_pain' => 'checkbox_list','heart_attack' => 'checkbox_list','heart_failure' => 'checkbox_list','abnormal_rhythm' => 'checkbox_list','breathing_changes' => 'checkbox_list','asthma' => 'checkbox_list','copd' => 'checkbox_list','smoking' => 'checkbox_list','cough' => 'checkbox_list','stomach_pain' => 'checkbox_list','diarrhea' => 'checkbox_list','constipation' => 'checkbox_list','nausea' => 'checkbox_list','vomiting' => 'checkbox_list','cramping' => 'checkbox_list','appetite_changes' => 'checkbox_list','abnormal_lymph_nodes' => 'checkbox_list','rheumatoid_arthritis' => 'checkbox_list','lupus' => 'checkbox_list','sjogrens' => 'checkbox_list','wegeners' => 'checkbox_list','psoriasis' => 'checkbox_list','osteoarthritis' => 'checkbox_list');/* in order to use the layout engine's draw functions, we need a fake table of layout data. */

/* an array of the lists the fields may draw on. */
    $data = formFetch($table_name, $id);
    if ($data) {

        echo '<table><tr>';

        foreach($data as $key => $value) {

            if ($key == 'id' || $key == 'pid' || $key == 'user' ||
                $key == 'groupname' || $key == 'authorized' ||
                $key == 'activity' || $key == 'date' || 
                $value == '' || $value == '0000-00-00 00:00:00' ||
                $value == 'n')
            {
                /* skip built-in fields and "blank data". */
	        continue;
            }

            /* display 'yes' instead of 'on'. */
            if ($value == 'on') {
                $value = 'yes';
            }
			
			$key=ucwords(str_replace("_"," ",$key));

            /* remove the time-of-day from the 'date' fields. */
            if ($field_names[$key] == 'date')
            if ($value != '') {
              $dateparts = split(' ', $value);
              $value = $dateparts[0];
            }

	    echo "<td><span class='bold'>". xl($key) . ": </span><span class=text>" . xl($value) . "</span></td>";;
            

            

            $count++;
            if ($count == $cols) {
                $count = 0;
                echo '</tr><tr>' . PHP_EOL;
            }
        }
    }
    echo '</tr></table><hr>';
}
?>

