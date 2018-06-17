<?php
/*
 Collection

Functions and parameters related to the display of a collection of information.

 */

abstract class fddm_collection {
	
	/* PARAM - name
	 ----------------------------------------------------------------------------------------------------
	
	 Purpose
	 Set an unique name for the collection. The name is used as reference to
	 prevent mixing blocks when multiple collection are displayed on the same page
	
	 Parameters		$name			-		Name of the collection
	
	 ----------------------------------------------------------------------------------------------------*/
	private $name;
	
	public function getName()        {
		return $this->name; }
		
	public function setName($name){
		$this->name = $name; }
	

	/* PARAM - content
	----------------------------------------------------------------------------------------------------
	
		 Purpose
		 Array containing each item in the list.
	
	----------------------------------------------------------------------------------------------------*/
	protected $content;
	
	protected function setCoreContent($coll=null) {
		if(isset($coll)){ $this->content = $coll; }
		$_SESSION['fd_list_'.$this->getname().'_content']= $this->content;
	}
				
	protected function getCoreContent(){
		if(!isset($this->content)){ $this->content = $_SESSION['fd_list_'.$this->getname().'_content']; }
		return $this->content;
	}
	
	public function getContentCount(){
		return count($this->content);
	}
	
	abstract public function setContent($coll=null);
	
	abstract public function getContent();
	
	
	/* PARAM - selectMode
	----------------------------------------------------------------------------------------------------
	
	 Purpose
	 Indicates in what way the items are selectable
	
	 Parameters
	 mode        The desired selection mode
	
	 Values
	 none        No item can be selected (default)
	 single	    A singel item can be selected
	 multiple    Several items can be selected
			  
	----------------------------------------------------------------------------------------------------*/
	private $selectMode;
	
	public function getSelectMode()        {
		return $this->selectMode;
	}
	
	public function setSelectMode($mode){
		$this->selectMode = $mode;
	}
	
	
	/* PARAM - positionMove
	----------------------------------------------------------------------------------------------------
	
	 Purpose
	 Indicates if the items could be moved within a level
	
	----------------------------------------------------------------------------------------------------*/
	private $positionMove = false;
	
	public function getPositionMove(){
		return $this->positionMove;
	}
	
	public function setPositionMove(){
		$this->positionMove = true;
	}
	
	public function unsetPositionMove()        {
		$this->positionMove = false;
	}
	
	
	/* PARAM - levelMove
	----------------------------------------------------------------------------------------------------
	
	 Purpose
	 Indicates if the items could be moved between levels
	
	----------------------------------------------------------------------------------------------------*/
	private $levelMove = false;
	
	public function getLevelMove(){
		return $this->levelMove;
	}
	
	public function setLevelMove(){
		$this->levelMove = true;
	}
	
	public function unsetLevelMove()        {
		$this->levelMove = false;
	}
	

	/* PARAM - erasable
	 ----------------------------------------------------------------------------------------------------
			
	Purpose
	
	 Indicates if the items in the list could be erased
	
	----------------------------------------------------------------------------------------------------*/
	private $erasable = false;
	
	public function getErasable(){
		return $this->erasable;
	}
	
	public function setErasable(){
		$this->erasable = true;
	}
	
	public function unsetErasable()        {
		$this->erasable = false;
	}
	
	
	/*  PARAM - target
	----------------------------------------------------------------------------------------------------
			  
	 Purpose
	 Assign URL's to pages that will handle the function calls from the structure.
	 (usually this will be the $_SERVER["PHP_SELF"] page).
			  
	 Parameters
	 $url    Page URL
	
	----------------------------------------------------------------------------------------------------*/
	private $target;
	
	public function getTarget() {
		return $this->target; }
		
	public function setTarget($url) {
		$this->target = $url; }
	
	/*  itemView
	====================================================================================================
		
	Purpose
	A Collection can show one or many types of items and each item has its own itemView object
	stored in the itemView-attribute of the collection
		
	====================================================================================================
	*/
	private $itemView;
		
	public function getItemView($itmType) {
		if (array_key_exists($itmType, $this->itemView)){ return $this->itemView[$itmType]; }
		else return FALSE;
	}
	
	public function setItemView($itmType,$view) { 
		$this->itemView[$itemType] = $view; }
	
	
	/*	manage
	====================================================================================================
	
	 Purpose
	 Handles all structure related calls from collection presentation
	
	====================================================================================================
	*/
	public function manage(){
	
	   $action = null;
	
	   if (isset($_GET["com"])){
	
			switch ($_GET["com"]){
	
		    	case "fwd":
		    		$this->move($_GET["pos"],$_GET["pos"]-1);
		    		break;
		    	
		    	case "back":
		    		$this->move($_GET["pos"],$_GET["pos"]+1);
		    		break;
		    	
		    	case "rem":
		    		$this->del($_GET["pos"],$this->content);
		    		break;
		    			 
		    }
	
			// Update the SESSION-variable with the edited list
			$this->setcontent();
	
		 }
		 return $action;
		    	
	} // manage
	
	/*	get
	 ====================================================================================================
	
	 Purpose
	 Return the array located at a given position in the collection
	
	 Parametrar
	 $pos    - The wanted position
	
	 ====================================================================================================
	*/
	private function get($pos,&$node){
						 
		// Check so there is a list to return something from and that the wanted position is within the list
		if(($node === null)||($pos>count($node))||($pos < 1)){ return false; }
		else return $node[$pos-1]; // Adjust the index to match the array where the itemcount starts with 0 instead of 1.
							
	} // get
		
	/*	add
	====================================================================================================
	
		 Purpose			Add a new position in the structure
					  
		 Attributes		
		 $item		-   Reference to the Item
		 $node		-	The node of the structure
		 $pos		-	The position were the new position should be inserted
				  
		 Used By	new			- 	Initiating the function
					copy
					move
					  
		Result			A new position added to the structure
	
	 ====================================================================================================
					 */
	private function add($item,$pos=null,&$node){
	
		// If there is no content in the list the list will contain the provided item.
		if ($node === null){ $node = $item; }
	
		// Insert the ItemID into the structure after adjusting the position to match the index
		// of the array which starts with 0
		else { array_splice($node,$pos-1,0,array($item)); }
							
	} // add
	
	/*	del
	====================================================================================================
	
	Purpose			Initiate the del_core function that will delete a position and its
					 sub-positions from the structure
					  
	Attributes		$pos		-   position to be deleted
					  
	Uses			del_core		-	Recursively
	
	Result			an updated object structure
	
	====================================================================================================
					 */
	private function del($pos,&$node){
							
		// If the list is empty or requested positions is outside the list bounderies, return false
		if (($node === null) || ($pos > count($node)) || ($pos < 1)) { return false; }
	
		// Delete the requested position from the list after adjusting to the index of the array which
		// starts numbering item with 0 instead of 1.
		array_splice($node,$pos-1,1);
	
	} // del
	
	/*	copy
	====================================================================================================
	
	 Purpose			Copy a listitem from an existing position to another position
					  
	 Attributes		$from		-   the position of the item being copied
					$to			-	the position where the copy of the item should be placed
					  
	 Uses			get			To get a copy of the selected listitem
			        add			To place the copy of the listitem into the list.
	
	 Result			an updated object structure
	
	====================================================================================================
					 */
	private function copy($from,$to){
							
		// Copy the listitem at the given from-position
		$itm = $this->get($from,$this->getcontent());
	
		// Add the listitem copied to the new position
		$this->add($itm,$to,$this->content);
	
	} // copy
	
	/*	move
	====================================================================================================
	
		 Purpose			Move an existing listitem from one position to another
					  
		 Attributes		$from		-   current position of the listitem being moved
						$to			-	new position where the selected listitem will be placed
					  
		 Uses			copy		To make a copy of the selected listitem and place the copy into the list
						del			To remove the old listitem from its original position
	
		Result			an updated object structure
	
	====================================================================================================
	*/
	private function move($from,$to){
							
		$itm = $this->get($from,$this->content);
	
		// Delete the item from the original position
		$this->del($from,$this->content);
	
		// Add the item to the new position
		$this->add($itm,$to,$this->content);
	
	} // move
	
	
	/*  LEVELSEPARATOR
	 ====================================================================================================
	
	 Purpose
	 Every template must implement a LEVELSEPARATOR constant to hold the character
	 used to seperate each level of a position.
	
	 ====================================================================================================
	 */
	abstract public static function getLEVELSEPARATOR();
	
    
    /*  GENERAL_IMAGE
    ====================================================================================================
	
    Purpose
    Every template must implement a GENERAL_IMAGE constant to hold the url's to 
    images used by the collectionview
	
	====================================================================================================
	*/
	abstract public static function getGENERAL_IMAGE($name, $state = "default");
	
	
	/*  GENERAL_STYLE
	====================================================================================================
	
	Purpose
	Every template must implement a GENERAL_STYLE constant to hold the url to 
	an external css-file with general style templates.
	
	====================================================================================================
	*/
	abstract public static function getGENERAL_STYLE();
	
	
	/*  GENERAL_FUNCTIONS
	 ====================================================================================================
	
	 Purpose
	 Every template must implement a GENERAL_FUNCTIONS constant to hold the url to
	 an external javascript-file with general scripts for manipulating and presentation
	 of the collection.
	
	 ====================================================================================================
	 */
	abstract public static function getGENERAL_FUNCTIONS();
	
	
	/*  displayCollection
	 ====================================================================================================
	
	 Purpose    Presents the complete collection of items and data
	
	 ====================================================================================================
	 */
	abstract public function displayCollection($source = null,$node = 0);
	
	public function __construct(){
	
	}
}
?>