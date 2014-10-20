<?php
/*
 * The page shown when the user requests to print this form. This page automatically prints itsself, and closes its parent browser window.
 */

/* for $GLOBALS[], ?? */
require_once('../../globals.php');
/* for acl_check(), ?? */
require_once($GLOBALS['srcdir'].'/api.inc');
/* for generate_form_field, ?? */
require_once($GLOBALS['srcdir'].'/options.inc.php');
/* Variables/settings common to all views included here*/
require_once("aec_ros_options.inc.php");

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
$obj = formFetch($table_name, $_GET['id']);

/* in order to use the layout engine's draw functions, we need a fake table of layout data. */


$returnurl = $GLOBALS['concurrent_layout'] ? 'encounter_top.php' : 'patient_encounter.php';


/* define check field functions. used for translating from fields to html viewable strings */

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>

<!-- declare this document as being encoded in UTF-8 -->
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" ></meta>

<!-- supporting javascript code -->
<!-- for dialog -->
<script type="text/javascript" src="<?php echo $GLOBALS['webroot']; ?>/library/dialog.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['webroot']; ?>/library/textformat.js"></script>

<!-- Global Stylesheet -->
<link rel="stylesheet" href="<?php echo $css_header; ?>" type="text/css"/>
<!-- Form Specific Stylesheet. -->
<link rel="stylesheet" href="../../forms/<?php echo $form_folder; ?>/style.css" type="text/css"/>
<title><?php echo htmlspecialchars('Print '.$form_name); ?></title>

</head>
<body class="body_top">

<div class="print_date"><?php xl('Printed on ','e'); echo date('F d, Y', time()); ?></div>

<form method="post" id="<?php echo $form_folder; ?>" action="">
<div class="title"><?php xl($form_name,'e'); ?></div>

<!-- container for the main body of the form -->
<div id="print_form_container">
<fieldset>

<!-- display the form's manual based fields -->
<?php
foreach($sections as $section):
	$fieldCount = count($section['fields']);
	$sectionRows = ceil($fieldCount/$sectionCols);
?>
<table class="section">
	<tr>
		<td><span class="sectionlabel"><?php echo $section['name'];?></span></td>
	</tr>
	<?php
	$i = 0;
	for($r = 0; $r < $sectionRows; $r++):
	?>
	<tr>
		<?php
		for($c = 0; $c < $sectionCols; $c++):
		?>
		<?php
		if($i < $fieldCount):
		?>
			<td class="response_prompt"><?php echo $section['fields'][$i]['label'];?>:</td>
			<td class="response">
			<?php
			if($section['fields'][$i]['type'] == 'radio'):
				foreach($radioOptions as $optVal => $optLabel):
			?>
				<label><input type="radio" name="<?php echo $section['fields'][$i]['name'];?>" value="<?php echo $optVal;?>" <?php echo ($optVal == $obj{$section['fields'][$i]['name']})?(' checked="checked"'):('');?>/><?php echo $optLabel;?></label>
			<?php
				endforeach;
			else:
			?>	
			<?php
			endif;
			?>
			</td>
			<?php
			$i++;
			?>
		<?php
		else:
		?>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		<?php
		endif;
		?>
		<?php
		endfor;
		?>
	</tr>
	<?php
	endfor;
	?>
</table>
<?php
endforeach;
?>

</fieldset>
</div><!-- end print_form_container -->

</form>
<script type="text/javascript">
window.print();
window.close();
</script>
</body>
</html>

