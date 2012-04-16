<?php

class default_t {
  public $args = Array();
  
  function default_t () {
    
  }
  
  public function default_m () {
    array_push($this->args, "Hello");
  }

  /* WARNING :
   * Any private function cannot be called from
   * the method and/or the view
   * */
  private function view () {
    
  }
}
