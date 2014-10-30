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
	// $table_name = 'form_aec_ros';
	/* Variables/settings common to all views included here*/
	require_once("aec_ros_options.inc.php");

	/* create mapping from field name to the Dr.'s prefered label */
	$drLabelMap = array();
	$field_names = array();
	foreach($sections as $section) {
		foreach($section['fields'] as $field) {
			$drLabelMap[$field['name']] = $field['drlabel'];
			$field_names[$field['name']] = $field['type'];
		}
	}
    
	$count = 0;

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
			
			/* remove the time-of-day from the 'date' fields. */
			if ($field_names[$key] == 'date') {
				if ($value != '') {
					$dateparts = split(' ', $value);
					$value = $dateparts[0];
				}
			}
			
			if(array_key_exists($key, $drLabelMap)) {
				$key = $drLabelMap[$key];
			} else {
				$key = ucwords(str_replace("_"," ",$key));
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

