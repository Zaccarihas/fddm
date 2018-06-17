<!DOCTYPE HTML>
<HTML><HEAD><TITLE>A General FDDM-list</TITLE>

<?php

/* INIT */
require_once '../templates/cls_fdbase_generalList.php';
$list = new generalList();

/* METADATA */
$list->setName("minlista");

/* APPERENCE */

?>

<link href="../stylesheets/fdbase_generalList.css" rel="stylesheet" type="text/css">

<?php

/* FUNCTION */
$list->setSelectmode("none");		// No option to select any listitem
$list->unsetErasable();				// No option to erase items
$list->unsetPositionMove();			// No option to move items in the same level of the list
$list->unsetLevelMove();			// No option to move items between levels in the list

/* STRUCTURE - Set the fields of the list */
// Each field is defined by a name that works as an index and the following attributes in order:
//  - Label, status, type, width, height, limits and target

$list->setFieldStructure([
		"name"	=>	["Namn","visible","text",32,1,null,null],
		"age"	=>	["Ålder","visible","text",8,1,null,null],
		"city"	=>	["Ort","visible","text",16,1,null,null]
]);

/* CONTENT */
$list->setContent([
	["Anders",47,"Domsjö",[
			["Sacharias",13,"Domsjö"],
			["Rebecca",10,"Domsjö"],
	]],
	["Annie",39,"Kornsjö",[
			["Filip",16,"Kornsjö"],
			["William",13,"Kornsjö"],
			["Julius",11,"Kornsjö"]
	]]		
]);

/* MANAGEMENT */
?>

</HEAD><BODY>

<?php 

/* PRESENTATION */
$list->displayCollection();

?>

</BODY></HTML>

