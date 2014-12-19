<?php
/**
 * fax_autocomplete.php -- searches addressbook for fax numbers by name and returns results via ajax in JSON format.
 */
//SANITIZE ALL ESCAPES
$sanitize_all_escapes=true;
//

//STOP FAKE REGISTER GLOBALS
$fake_register_globals=false;
//

require_once("../globals.php");
require_once("$srcdir/acl.inc");
require_once("$srcdir/formdata.inc.php");
require_once("$srcdir/options.inc.php");
require_once("$srcdir/htmlspecialchars.inc.php");

if ($_GET['term']) {
	$searchTerm = trim($_GET['term']);
	$sqlBindArray = array();
	$query = "SELECT u.*, lo.option_id AS ab_name, lo.option_value as ab_option FROM users AS u " .
	  "LEFT JOIN list_options AS lo ON " .
	  "list_id = 'abook_type' AND option_id = u.abook_type " .
	  "WHERE u.active = 1 AND ( u.authorized = 1 OR u.username = '' ) ";
	if ($searchTerm) {
		$query .= "AND (u.lname LIKE ? OR u.fname LIKE ? OR u.organization LIKE ? ) ";
		array_push($sqlBindArray,$searchTerm."%");
		array_push($sqlBindArray,$searchTerm."%");
		array_push($sqlBindArray,$searchTerm."%");
	}
	$query .= "ORDER BY u.organization, u.lname, u.fname";
	$res = sqlStatement($query,$sqlBindArray);
	$searchResults = array();
	if(!empty($res)) {
		while ($row = sqlFetchArray($res)) {
			$id = $row['fax'];
			$displayName = $row['fname'] . ' ';
			if(strlen($row['mname'])) {
				$displayName .= $row['mname'] . ' ';
			}
			$displayName .= $row['lname'];
			$displayName = trim($displayName);
			$value = $label = $displayName;
			if(strlen($row['organization'])) {
				$label .= ' - '.$row['organization'];
			}
			array_push($searchResults, array('id' => $id, 'label' => $label, 'value' => $value));
		}
	}
	$return = json_encode($searchResults);
	header('Content-type: application/javascript');
	echo $return;
}
?>