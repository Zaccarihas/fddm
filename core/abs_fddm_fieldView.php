<?php
/*
 *    FieldView - Class
 *
 *    Purpose
 *    
 *    The FieldView class definies attributes necessary for the presentation of
 *    a field such as label, status and type (type of input or fieldcontrol).
 *    
 *    A FieldView object is initiated for each field in an item in the itemView
 *    class. The fieldViews within the ItemView can be called with a field value
 *    as parameter to display that field through the display function defined
 *    in the template.
 *
 *    Public Parameters
 *    
 *    All parameters are private but can be read or set by using the corresponding
 *    get- and set- functions (e.g. getStatus() and setStatus())
 *
 *    Public Functions
 *
 *    __construct
 *    Creates a new fieldView-object. Called by assigning a variable to new fieldView()
 *
 */

abstract class fieldView {

	// Attributes
	
	/*--------------------------------------------------------------------------------
	 * name (attribute)
	 *
	 * The name of the field
	 * (used in stylesheets to bind styling templates to a fieldView
	 *
	 ---------------------------------------------------------------------------------*/
	private $name;
	public function getName()           { return $this->name; }
	public function setName($name)      { $this->name = $name;}

	 	
	/*--------------------------------------------------------------------------------
	 * status (attribute)
	 *
	 * The current status of the field
	 * (hidden, visible, optional or mandatory with visible as the default choice) .
	 *
	 ---------------------------------------------------------------------------------*/
	private $status;
	public function getStatus()             { return $this->status; }
	public function setStatus($stat)        { $this->status = $stat; }
	
		
	/*--------------------------------------------------------------------------------
	 * label (attribute)
	 *
	 * The label of the field
	 *
	 ---------------------------------------------------------------------------------*/
	private $label;
	public function getLabel()          { return $this->label; }
	public function setLabel($label)    { $this->label = $label;}
	
	
	/*--------------------------------------------------------------------------------
	 * type (attribute)
	 *
	 * The type of the field can be the datatype or the type of input used to edit 
	 * the field depending on the implementation in the template.
	 *
	 ---------------------------------------------------------------------------------*/
	private $type;
	public function getType()         { return $this->type; }
	public function setType($type)    { $this->type = $type;}
		
	/*--------------------------------------------------------------------------------
	 * height (attribute)
	 *
	 * The height of the field. For text fields this represents the number of
	 * rows of text while for pictures it could be the number of pixels.
	 *
	 *..------------------------------------------------------------------------------*/
	private $height;
	public function getHeight()         { return $this->height; }
	public function setHeight($height)  { $this->height = $height;}
	
	/*--------------------------------------------------------------------------------
	 * width (attribute)
	 *
	 * The width of the field. For text fields this represents the number of
	 * characters while for pictures it could be the number of pixels.
	 *
	 *..------------------------------------------------------------------------------*/
	private $width;
	public function getWidth()        { return $this->width; }
	public function setWidth($width)  { $this->width = $width;}
		
	/*--------------------------------------------------------------------------------
	 * target (attribute)
	 *
	 * A page or file related to the content of the fieldView. Can be used in links
	 *
	 ---------------------------------------------------------------------------------*/
	private $target;
	public function getTarget()          { return $this->target; }
	public function setTarget($url)      { $this->target = $url;}
		
	/*--------------------------------------------------------------------------------
	 *  limit (attribute)
	 *
	 *  Controls the value of the field. For a selection field this parameter contains
	 *  the available options.
	 *
	 *  The limit-attribute is an array were the name of the limit is the key related
	 *  to a value such as: max => 234, min => 100 option => "saab", option => "volvo"
	 *
	 *..------------------------------------------------------------------------------*/
	private $limit;
	public function getLimit($lim){
		return $this->limit[$lim]; }
	public function setLimit($lim, $value){
		$this->limit[$lim] = $value;}
		
	// Functions
	
	/*--------------------------------------------------------------------------------
	 * __construct (function)    Constructs a new fieldView
	 * -------------------------------------------------------------------------------*/
	public function __construct($name,$label,$status = "visible",$type="input",$height=NULL,$width=NULL,$limit = NULL,$target=NULL){
	
	    if($name == null){ exit("fddm_ERROR in cls_fddm_fieldView/construct: A fieldname must be provided"); }
	    $this->name = $name;
	
	    // If no label is provided the label will be set to be the fieldname
	    $this->label = $label;
	    if($label==null){ $this->label = $name; }
	
	    $this->status = $status;
	    $this->type = $type;
    	$this->width = $width;
	    $this->height = $height;
	    $this->target = $target;
	    $this->limit = $limit;
	
	} // __construct
	
	/*--------------------------------------------------------------------------------
	 * display (abstract function)
	 * 
	 * Requires the deriving class to implement a display-function
	 * 
	 * -------------------------------------------------------------------------------*/	
	abstract function display($value);
	
}
?>