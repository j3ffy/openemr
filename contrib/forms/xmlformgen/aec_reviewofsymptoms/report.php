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
/* an array of the lists the fields may draw on. */
$lists = array();
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

            /* remove the time-of-day from the 'date' fields. */
            if ($field_names[$key] == 'date')
            if ($value != '') {
              $dateparts = split(' ', $value);
              $value = $dateparts[0];
            }

	    echo "<td><span class='bold'>";
            

            if ($key == 'weight_loss' ) 
            { 
                echo xl_layout_label('Weight Loss').":";
            }

            if ($key == 'weight_gain' ) 
            { 
                echo xl_layout_label('Weight Gain').":";
            }

            if ($key == 'fatigue' ) 
            { 
                echo xl_layout_label('Fatigue').":";
            }

            if ($key == 'sleep_problems' ) 
            { 
                echo xl_layout_label('Sleep Problems').":";
            }

            if ($key == 'vision_changes' ) 
            { 
                echo xl_layout_label('Change in Vision').":";
            }

            if ($key == 'blurry_vision' ) 
            { 
                echo xl_layout_label('Blurry Vision').":";
            }

            if ($key == 'wear_glasses' ) 
            { 
                echo xl_layout_label('Wear Glasses').":";
            }

            if ($key == 'floaters' ) 
            { 
                echo xl_layout_label('Floaters').":";
            }

            if ($key == 'glaucoma' ) 
            { 
                echo xl_layout_label('Glaucoma').":";
            }

            if ($key == 'hearing_loss' ) 
            { 
                echo xl_layout_label('Hearing Loss').":";
            }

            if ($key == 'ringing' ) 
            { 
                echo xl_layout_label('Ringing').":";
            }

            if ($key == 'roaring' ) 
            { 
                echo xl_layout_label('Roaring').":";
            }

            if ($key == 'dizziness' ) 
            { 
                echo xl_layout_label('Dizziness').":";
            }

            if ($key == 'vertigo' ) 
            { 
                echo xl_layout_label('Vertigo').":";
            }

            if ($key == 'ear_pain' ) 
            { 
                echo xl_layout_label('Ear Pain').":";
            }

            if ($key == 'ear_drainage' ) 
            { 
                echo xl_layout_label('Ear Drainage').":";
            }

            if ($key == 'ear_surgery' ) 
            { 
                echo xl_layout_label('Ear Surgery').":";
            }

            if ($key == 'ear_infections' ) 
            { 
                echo xl_layout_label('Ear Infections').":";
            }

            if ($key == 'allergies' ) 
            { 
                echo xl_layout_label('Allergies').":";
            }

            if ($key == 'congestion' ) 
            { 
                echo xl_layout_label('Congestion').":";
            }

            if ($key == 'stuffiness' ) 
            { 
                echo xl_layout_label('Stuffiness').":";
            }

            if ($key == 'sinus_pain' ) 
            { 
                echo xl_layout_label('Pain').":";
            }

            if ($key == 'sinus_pressure' ) 
            { 
                echo xl_layout_label('Pressure').":";
            }

            if ($key == 'sinus_surgery' ) 
            { 
                echo xl_layout_label('Sinus Surgery').":";
            }

            if ($key == 'blocked_breathing' ) 
            { 
                echo xl_layout_label('Blocked Breathing').":";
            }

            if ($key == 'hoarseness' ) 
            { 
                echo xl_layout_label('Hoarseness').":";
            }

            if ($key == 'dryness' ) 
            { 
                echo xl_layout_label('Dryness').":";
            }

            if ($key == 'voice_fatigue' ) 
            { 
                echo xl_layout_label('Voice Fatigue').":";
            }

            if ($key == 'frequent_throat_clearing' ) 
            { 
                echo xl_layout_label('Frequent Throat Clearing').":";
            }

            if ($key == 'increased_phlegm' ) 
            { 
                echo xl_layout_label('Increased Phlegm').":";
            }

            if ($key == 'post_nasal_drip' ) 
            { 
                echo xl_layout_label('Post Nasal Drip').":";
            }

            if ($key == 'face_pain' ) 
            { 
                echo xl_layout_label('Pain').":";
            }

            if ($key == 'face_numbness' ) 
            { 
                echo xl_layout_label('Numbness').":";
            }

            if ($key == 'twitching' ) 
            { 
                echo xl_layout_label('Twitching').":";
            }

            if ($key == 'face_weakness' ) 
            { 
                echo xl_layout_label('Weakness').":";
            }

            if ($key == 'lopsided' ) 
            { 
                echo xl_layout_label('Lopsided').":";
            }

            if ($key == 'neck_pain' ) 
            { 
                echo xl_layout_label('Pain').":";
            }

            if ($key == 'mass' ) 
            { 
                echo xl_layout_label('Mass').":";
            }

            if ($key == 'lump' ) 
            { 
                echo xl_layout_label('Lump').":";
            }

            if ($key == 'goiter' ) 
            { 
                echo xl_layout_label('Goiter').":";
            }

            if ($key == 'spine_surgery' ) 
            { 
                echo xl_layout_label('Spine Surgery').":";
            }

            if ($key == 'decreased_mobility' ) 
            { 
                echo xl_layout_label('Decreased Mobility').":";
            }

            if ($key == 'noisy_breathing' ) 
            { 
                echo xl_layout_label('Noisy Breathing').":";
            }

            if ($key == 'headache' ) 
            { 
                echo xl_layout_label('Headache').":";
            }

            if ($key == 'numbness' ) 
            { 
                echo xl_layout_label('Numbness').":";
            }

            if ($key == 'weakness' ) 
            { 
                echo xl_layout_label('Weakness').":";
            }

            if ($key == 'walking_problems' ) 
            { 
                echo xl_layout_label('Walking Problems').":";
            }

            if ($key == 'chest_pain' ) 
            { 
                echo xl_layout_label('Chest Pain').":";
            }

            if ($key == 'heart_attack' ) 
            { 
                echo xl_layout_label('Heart Attack').":";
            }

            if ($key == 'heart_failure' ) 
            { 
                echo xl_layout_label('Heart Failure').":";
            }

            if ($key == 'abnormal_rhythm' ) 
            { 
                echo xl_layout_label('Abnormal Rhythm').":";
            }

            if ($key == 'breathing_changes' ) 
            { 
                echo xl_layout_label('Breathing Changes').":";
            }

            if ($key == 'asthma' ) 
            { 
                echo xl_layout_label('Asthma').":";
            }

            if ($key == 'copd' ) 
            { 
                echo xl_layout_label('COPD').":";
            }

            if ($key == 'smoking' ) 
            { 
                echo xl_layout_label('Smoking').":";
            }

            if ($key == 'cough' ) 
            { 
                echo xl_layout_label('Cough').":";
            }

            if ($key == 'stomach_pain' ) 
            { 
                echo xl_layout_label('Stomach Pain').":";
            }

            if ($key == 'diarrhea' ) 
            { 
                echo xl_layout_label('Diarrhea').":";
            }

            if ($key == 'constipation' ) 
            { 
                echo xl_layout_label('Constipation').":";
            }

            if ($key == 'nausea' ) 
            { 
                echo xl_layout_label('Nausea').":";
            }

            if ($key == 'vomiting' ) 
            { 
                echo xl_layout_label('Vomiting').":";
            }

            if ($key == 'cramping' ) 
            { 
                echo xl_layout_label('Cramping').":";
            }

            if ($key == 'appetite_changes' ) 
            { 
                echo xl_layout_label('Appetite Changes').":";
            }

            if ($key == 'abnormal_lymph_nodes' ) 
            { 
                echo xl_layout_label('Abnormal Lymph Nodes').":";
            }

            if ($key == 'rheumatoid_arthritis' ) 
            { 
                echo xl_layout_label('Rheumatoid Arthritis').":";
            }

            if ($key == 'lupus' ) 
            { 
                echo xl_layout_label('Lupus').":";
            }

            if ($key == 'sjogrens' ) 
            { 
                echo xl_layout_label('Sjogren\'s').":";
            }

            if ($key == 'wegeners' ) 
            { 
                echo xl_layout_label('Wegener\'s').":";
            }

            if ($key == 'psoriasis' ) 
            { 
                echo xl_layout_label('Psoriasis').":";
            }

            if ($key == 'osteoarthritis' ) 
            { 
                echo xl_layout_label('Osteoarthritis').":";
            }

                echo '</span><span class=text>'.generate_display_field( $manual_layouts[$key], $value ).'</span></td>';

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

