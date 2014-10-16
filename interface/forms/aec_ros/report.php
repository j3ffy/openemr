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
function aec_ros_report( $pid, $encounter, $cols, $id) {
    $count = 0;
/** CHANGE THIS - name of the database table associated with this form **/
$table_name = 'form_aec_ros';


/* an array of all of the fields' names and their types. */
$field_names = array('weight_loss' => 'radio','weight_gain' => 'radio','fatigue' => 'radio','sleep_problems' => 'radio','vision_changes' => 'radio','blurry_vision' => 'radio','wear_glasses' => 'radio','floaters' => 'radio','glaucoma' => 'radio','hearing_loss' => 'radio','ringing' => 'radio','roaring' => 'radio','dizziness' => 'radio','vertigo' => 'radio','ear_pain' => 'radio','ear_drainage' => 'radio','ear_surgery' => 'radio','ear_infections' => 'radio','allergies' => 'radio','congestion' => 'radio','stuffiness' => 'radio','sinus_pain' => 'radio','sinus_pressure' => 'radio','sinus_surgery' => 'radio','blocked_breathing' => 'radio','hoarseness' => 'radio','dryness' => 'radio','voice_fatigue' => 'radio','frequent_throat_clearing' => 'radio','increased_phlegm' => 'radio','post_nasal_drip' => 'radio','face_pain' => 'radio','face_numbness' => 'radio','twitching' => 'radio','face_weakness' => 'radio','lopsided' => 'radio','neck_pain' => 'radio','mass' => 'radio','lump' => 'radio','goiter' => 'radio','spine_surgery' => 'radio','decreased_mobility' => 'radio','noisy_breathing' => 'radio','headache' => 'radio','numbness' => 'radio','weakness' => 'radio','walking_problems' => 'radio','chest_pain' => 'radio','heart_attack' => 'radio','heart_failure' => 'radio','abnormal_rhythm' => 'radio','breathing_changes' => 'radio','asthma' => 'radio','copd' => 'radio','smoking' => 'radio','cough' => 'radio','stomach_pain' => 'radio','diarrhea' => 'radio','constipation' => 'radio','nausea' => 'radio','vomiting' => 'radio','cramping' => 'radio','appetite_changes' => 'radio','abnormal_lymph_nodes' => 'radio','rheumatoid_arthritis' => 'radio','lupus' => 'radio','sjogrens' => 'radio','wegeners' => 'radio','psoriasis' => 'radio','osteoarthritis' => 'radio');/* in order to use the layout engine's draw functions, we need a fake table of layout data. */

/* an array of the lists the fields may draw on. */
    $data = formFetch($table_name, $id);
    if ($data) {

        echo '<table><tr>';

        foreach($data as $key => $value) {

            if ($key == 'id' || $key == 'pid' || $key == 'user' ||
                $key == 'groupname' || $key == 'authorized' ||
                $key == 'activity' || $key == 'date' || 
                $value == '' || $value == '0000-00-00 00:00:00' ||
                $value == "N/A")
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

