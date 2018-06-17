<?php
/*
 *    Item - Class
 *
 *    Purpose
 *    
 *    This class contains attributes and functions related to an item which is an
 *    object combining a number of related fields of data such as a name-field and 
 *    a phonenumber-field for an phoneindexlist.
 *
 *    Public Parameters
 *    All parameters are private but can be read or set by using the corresponding
 *    get- and set- functions (e.g. getID() and setID())
 *
 *    Public Functions
 *
 *    __construct
 *    Creates a new item-object. Called by assigning a variable to new item()
 *
 */

class item {
	
	// Attributes
	
	/*--------------------------------------------------------------------------------
	 * id (attribute)
	 * 
	 * A unique id for the item (can be a related id of a database post).
	 * 
	 ---------------------------------------------------------------------------------*/
	private $id;
	public function getID()           { return $this->id; }
	public function setID($id)        { $this->id = $id; }
	
	/*--------------------------------------------------------------------------------
	 * reference (attribute)
	 * 
	 * The reference to a position in the collection can follow any naming or 
	 * breakdown structure (e.g 1.2.3, 1.2.4, 1.31 or a, b, c). 
	 * 
	 ---------------------------------------------------------------------------------*/
	private $reference;
	public function getReference()           { return $this->reference; }
	public function setReference($ref)       { $this->reference = $ref; }
	
	/*--------------------------------------------------------------------------------
	 * active (attribute)
	 *
	 * The actove attribute of the item position determines if the position is the active
	 * position in the content of the collection.
	 *
	 ---------------------------------------------------------------------------------*/
	private $active;
	public function getActive()       { return $this->active; }
	public function activate()        { $this->active = TRUE; }
	public function deactivate()        { $this->active = FALSE; }
		
	/*--------------------------------------------------------------------------------
	 * expanded (attribute)
	 *
	 * The expanded attribute of the position determines if the subpositions of
	 * the position should be presented or hidden.
	 *
	 ---------------------------------------------------------------------------------*/
	private $expanded;
	public function getExpanded()     { return $this->expanded; }
	public function expand()          { $this->expanded = TRUE; }
	public function compress()        { $this->expanded = FALSE; }
	
	/*--------------------------------------------------------------------------------
	 * selected (attribute)
	 *
	 * The selected attribute of the position determines if the position is selected 
	 * in the content of the collection.
	 * 
	 ---------------------------------------------------------------------------------*/
	private $selected;
	public function getSelected()     { return $this->selected; }
	public function select()          { $this->selected = TRUE; }
	public function unselect()        { $this->selected = FALSE; }
	
	/*--------------------------------------------------------------------------------
	 * visible (attribute)
	 *
	 * The visible attribute of the item position determines if the item is visible
	 * or filtred out.
	 *
	 ---------------------------------------------------------------------------------*/
	private $visible;
	public function getVisible()     { return $this->visible; }
	public function reveal()         { $this->visible = TRUE; }
	public function hide()        	 { $this->visible = FALSE; }

	
	/*--------------------------------------------------------------------------------
	 * content (attribute)
	 *
	 * The array of fields that build up the item
	 *
	 ---------------------------------------------------------------------------------*/
	private $content;
	public function getContent()        { return $this->content; }
	public function setContent($fields) { $this->content = $fields; }
	public function getField($idx)      { 
		if(array_key_exists($idx, $this->content)){
			return $this->content[$idx]; }
		else return FALSE;
	}
	public function setField($idx,$val) { $this->content[$idx] = $val; }
	
	
	/*--------------------------------------------------------------------------------
	 * subs (attribute)
	 *
	 * The array of subitems for the item
	 *
	 ---------------------------------------------------------------------------------*/
	private $subItems;
	public function getSubItems()        { return $this->subItems; }
	public function setSubItems($subs)   { $this->subItems = $subs; }
	
	/*--------------------------------------------------------------------------------
	 * _construct (function)
	 *
	 * Creats a new item-object
	 *
	 ---------------------------------------------------------------------------------*/
	public function __construct($id, $ref=NULL, $act=FALSE, $exp = FALSE, $sel=FALSE, $vis = TRUE, $cont = NULL, $subs = NULL){
		
		$this->id = $id;
		$this->reference = $ref;
		$this->active = $act;
		$this->expanded = $exp;
		$this->selected = $sel;
		$this->visible = $vis;

		$this->content = $cont;
		$this->subItems = $subs;
		
	}
	
}