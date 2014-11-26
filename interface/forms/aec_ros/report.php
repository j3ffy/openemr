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
		foreach($sections as $section) {
			$count = 0;
			echo '<span class="title">'.$section['name'].'</span>' . PHP_EOL;
			echo '<table><tr>';
			foreach($section['fields'] as $field) {
				if(array_key_exists($field['name'], $data)) {
					echo "<td><span class='bold'>". xl($field['drlabel']) . ": </span><span class=text>" . xl($data[$field['name']]) . "</span></td>";
					$count++;
					if ($count == $cols) {
						$count = 0;
						echo '</tr><tr>' . PHP_EOL;
					}
				}
			}
			echo '</tr></table><hr>';
		}
	}
}
?>

