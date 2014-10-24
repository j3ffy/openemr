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
function aec_physical_exam_report( $pid, $encounter, $cols, $id) {
    $count = 0;
/** CHANGE THIS - name of the database table associated with this form **/
$table_name = 'form_aec_physical_exam';


/* an array of all of the fields' names and their types. */
$field_names = array('general' => 'textarea','neck' => 'textarea','face_scalp' => 'textarea','cranial_nerves' => 'textarea','ears' => 'textarea','tuning_fork' => 'textarea','eyes' => 'textarea','nose' => 'textarea','oral_cavity' => 'textarea','oropharynx' => 'textarea','nasopharynx' => 'textarea','larynx_hypopharynx' => 'textarea');/* in order to use the layout engine's draw functions, we need a fake table of layout data. */
$manual_layouts = array( 
 'general' => 
   array( 'field_id' => 'general',
          'data_type' => '3',
          'fld_length' => '100',
          'max_length' => '4',
          'description' => '',
          'list_id' => '' ),
 'neck' => 
   array( 'field_id' => 'neck',
          'data_type' => '3',
          'fld_length' => '100',
          'max_length' => '4',
          'description' => '',
          'list_id' => '' ),
 'face_scalp' => 
   array( 'field_id' => 'face_scalp',
          'data_type' => '3',
          'fld_length' => '100',
          'max_length' => '4',
          'description' => '',
          'list_id' => '' ),
 'cranial_nerves' => 
   array( 'field_id' => 'cranial_nerves',
          'data_type' => '3',
          'fld_length' => '100',
          'max_length' => '4',
          'description' => '',
          'list_id' => '' ),
 'ears' => 
   array( 'field_id' => 'ears',
          'data_type' => '3',
          'fld_length' => '100',
          'max_length' => '4',
          'description' => '',
          'list_id' => '' ),
 'tuning_fork' => 
   array( 'field_id' => 'tuning_fork',
          'data_type' => '3',
          'fld_length' => '100',
          'max_length' => '4',
          'description' => '',
          'list_id' => '' ),
 'eyes' => 
   array( 'field_id' => 'eyes',
          'data_type' => '3',
          'fld_length' => '100',
          'max_length' => '4',
          'description' => '',
          'list_id' => '' ),
 'nose' => 
   array( 'field_id' => 'nose',
          'data_type' => '3',
          'fld_length' => '100',
          'max_length' => '4',
          'description' => '',
          'list_id' => '' ),
 'oral_cavity' => 
   array( 'field_id' => 'oral_cavity',
          'data_type' => '3',
          'fld_length' => '100',
          'max_length' => '4',
          'description' => '',
          'list_id' => '' ),
 'oropharynx' => 
   array( 'field_id' => 'oropharynx',
          'data_type' => '3',
          'fld_length' => '100',
          'max_length' => '4',
          'description' => '',
          'list_id' => '' ),
 'nasopharynx' => 
   array( 'field_id' => 'nasopharynx',
          'data_type' => '3',
          'fld_length' => '100',
          'max_length' => '4',
          'description' => '',
          'list_id' => '' ),
 'larynx_hypopharynx' => 
   array( 'field_id' => 'larynx_hypopharynx',
          'data_type' => '3',
          'fld_length' => '100',
          'max_length' => '4',
          'description' => '',
          'list_id' => '' )
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
            

            if ($key == 'general' ) 
            { 
                echo xl_layout_label('General').":";
            }

            if ($key == 'neck' ) 
            { 
                echo xl_layout_label('Neck').":";
            }

            if ($key == 'face_scalp' ) 
            { 
                echo xl_layout_label('Face/Scalp').":";
            }

            if ($key == 'cranial_nerves' ) 
            { 
                echo xl_layout_label('Cranial Nerves').":";
            }

            if ($key == 'ears' ) 
            { 
                echo xl_layout_label('Ears').":";
            }

            if ($key == 'tuning_fork' ) 
            { 
                echo xl_layout_label('Tuning Fork').":";
            }

            if ($key == 'eyes' ) 
            { 
                echo xl_layout_label('Eyes').":";
            }

            if ($key == 'nose' ) 
            { 
                echo xl_layout_label('Nose').":";
            }

            if ($key == 'oral_cavity' ) 
            { 
                echo xl_layout_label('Oral Cavity').":";
            }

            if ($key == 'oropharynx' ) 
            { 
                echo xl_layout_label('Oropharynx').":";
            }

            if ($key == 'nasopharynx' ) 
            { 
                echo xl_layout_label('Nasopharynx').":";
            }

            if ($key == 'larynx_hypopharynx' ) 
            { 
                echo xl_layout_label('Larynx / Hypopharynx').":";
            }

                echo '</span> <span class=text>'.generate_display_field( $manual_layouts[$key], $value ).'</span></td>';

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

