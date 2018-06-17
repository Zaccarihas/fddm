<?php

    
    //require_once '../templates/cls_fdbase_generalList.php';
    //require_once '../core/cls_fddm_field.php';
    //require_once '../core/cls_fddm_item.php';
    
	//require_once '../templates/cls_fdbase_listItem.php';
	require_once '../templates/cls_fdbase_listItem.php';
	//require_once '../templates/cls_fdbase_listfield.php';
	
	// Vilka fält ska ingå i mitt item
	$itemflds = [['fname','Förnamn','visible','input',1,48,null,null],
			 ['ename','Efternamn','visible','input',1,48,null,null],
			 ['phnumber','Telefon','visible','input',1,48,null,null],
			 ['city','Stad','visible','input',1,48,null,null]
	];
    
	// Skapa ett item
	$itempres = new listItem($itemflds);
	
	// Skriv ut item
	$itempres->display(['Anders','Löfqvist','070-5446782','Örnsköldsvik']);
	
    // Create the collection that will hold the data for the list and the display
    // functionality of the list
    //$list = new generalList();
    
    // Create some items with some fields item
    //$list->addItem('Anders Löfqvist','Örnsköldsvik','070-5446782');
    //$list->addItem('Sacharias Löfqvist','Örnsköldsvik');
    
    
    /*$person[0] = new item(1,'1');
    $person[0]->setField('name','Anders Löfqvist');
    $person[0]->setField('city','Örnsköldsvik');
    $person[0]->setField('phone','070-5446782');
    $person[0]->setField('age', 47); // will not be presented since it is not defined in the listitem view.
    
    $person[1] = new item(2,'2');
    $person[1]->setField('name','Sacharias Löfqvist');
    $person[1]->setField('city','Örnsköldsvik');
    $person[1]->setField('age',12);
    
    $person[2] = new item(3,'3');
    $person[2]->setField('name','Åke Löfqvist');
    $person[2]->setField('city','Vilhelmina');
    $person[2]->setField('phone','070-6879353');
    $person[2]->setField('age',81);
    
    $person[3] = new item(4,'4');
    $person[3]->setField('name','Rebecca Löfqvist');
    $person[3]->setField('city','Örnsköldsvik');
    $person[3]->setField('age',10);
    
 ?>
 
 <HTML><HEAD><style>.listfield { display: inline-block; }</style></HEAD><body><?php
 
 // Present each item
 foreach($person as $pers){
 	$persView->display($pers);
 }
 
 
 ?></body></HTML>*/
	
	
?>


    