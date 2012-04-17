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
  private $method = "default_m";   // Sujet de la class.              (String)
  private $data   = Array(NULL);   // List des arguments de la méthode (Array)
  private $Object = NULL       ;

  
  function __construct () {
  $args = func_get_args();
  $link = @$args[0]."";
  if ( strlen($link) == 0 ) {
    $link = "/!default_t:default_m/0/"; // RESETTING TO DEFAULT action
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
        $this->class = substr(str_replace("..", "", @$actsub[0]), 1);
        $this->class = $this->class;
        $this->method = @$actsub[1];
        unset($list[0]);
      }
  // END

  // BEGIN Get Item list
    $this->data = array_values($list);
  // END
  }

  function reconstruct ($link) {
    return __construct ($link);
  }
  
  function ignite () {
    if ( $GLOBALS['registered_classes'] === FALSE || in_array($this->class, $GLOBALS['registered_classes']) ){
      if ( file_exists( "controler/{$this->class}.php" ) &&  file_exists( "view/{$this->class}/{$this->method}.php" ) ){
        include_once("controler/{$this->class}.php");
        Try {
          $this->Object = new $this->class();
          @$this->Object->{$this->method}($this->data);
          $view = $this->Object;
          include_once("view/{$this->class}/{$this->method}.php");
        }
        Catch ( Exception $e ) {
          $_404 = TRUE;
        }
      } else {
        $_404 = TRUE;
      }
    } else {
      $_404 = TRUE;
    }
    
    if ( @$_404 === TRUE ){
      header("HTTP/1.0 404 Not Found");
      echo "<html><body><h1 style='text-align: center;'>404 not found.</h1><p style='text-align: center;' >Your request cannot be met... </p></body></html>";
      /*
       * You can do better than that... 
      */
    }
  }
}
