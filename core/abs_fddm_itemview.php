<?php
/*
 Itemview

Functions and parameters related to the display of an item in a collection.

 */

abstract class itemView {
	
	/*--------------------------------------------------------------------------------
	 * name (attribute)
	 *
	 * The name of the itemview
	 * (used in stylesheets to bind styling templates to a itemview
	 *
	 ---------------------------------------------------------------------------------*/
	private $name;
	public function getName()           { return $this->name; }
	public function setName($name)      { $this->name = $name;}
	
	/*--------------------------------------------------------------------------------
	 * fields (attribute)
	 *
	 * An array of fields within the itemview
	 *
	 ---------------------------------------------------------------------------------*/
	private $fields;
	public function getFields()           { return $this->fields; }
	public function setFields($flds)      { $this->fields = $flds;}
	public function setField($idx,$fld)   { $this->fields[$idx] = $fld; }
	public function getField($idx)		  { return $this->fields[$idx]; }
	
    /*--------------------------------------------------------------------------------
     * display
     *
     * The itemView interface requires each implementing class to implement a
     * display function to display an item.
     *
     *---------------------------------------------------------------------------------*/
	abstract function display($itm);
	
}
?>