<?php
/*
 * Class : request
 *  Description: the core handler for classs. 
 *  takes 1 sting arguments. 
 *  Following this pattern : [!class:method/][item/[item/[etc../]]]
 *  
 *    METHOD LIST:
 *      reconstruct     :   If you need to perform a serie of classs,
 *                          don't create an array of objects. 
 *      perform_class  :   self-explanatory.
 *      
*/
class request {
  private $link       ;
  
  private $class  = "default_t";   // Nom de la class.                (String)
  private $method = "default_t";   // Sujet de la class.              (String)
  private $data   = Array(NULL);   // List des arguments de la méthode (Array)
  private $Object = NULL       ;

  
  function __construct ($link) {
  
  if ( strlen($link) == 0 ) {
    $link = "/!default/"; // RESETTING TO DEFAULT action
  }
  
  // BEGIN Pre-treatement. 
    $link = explode('/', $link);
    foreach($link as $key => $value) {
      if ( $value == "" ) {
        unset($link[$key]);
      }
    }
    $link = implode("/", array_values($link));
  // END

  // BEGIN GET $this->link
    $this->link = $link;
  // END 
    
  // BEGIN Setting $this->class && $this->method
      $list = explode('/', $this->link);
      if ( @$list[0][0] == '!' ){
        $actsub = explode(':', $list[0]);
        $this->class = str_replace("..", "", @$actsub[0]);
        $this->class = $this->class;
        $this->method = @$actsub[1];
        unset($list[0]);
      }
  // END

  // BEGIN Get Item list
    $list = array_values($list);
    foreach ( $list as $key => $value ){
      if ( @$value[0] == "!" ) {
        unset($list[$key]);
      }
    }
    $this->data = array_values($list);
  // END
  }

  function reconstruct ($link) {
    return __construct ($link);
  }
  
  function ignite () {
    if ( in_array($this->class, $GLOBALS['registered_classes']) ){
      if ( file_exists( "controler/{$this->class}.php" ) &&  file_exists( "view/{$this->class}.php" ) ){
        include_once("controler/{$this->class}.php");
      } else {
        die ("No sux file or directory. Yeah, that suchs.");
      }
      $this->Object = new $this->class();
      $this->Object->{$this->method}($this->data);
    } else {
      die ("No sux file or directory. Yeah, that suchs.");
    }
    

  }
}
