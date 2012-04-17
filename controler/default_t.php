<?php

class default_t {
  public $title = "It Works!";
  public $msg = Array();
  
  function default_t () {
    $this->msg = Array( "'"=>"<Hi.>");
  }
  
  public function default_m () {
    array_push($this->msg, "Hello");
  }

  /* WARNING :
   * Any private function cannot be called from
   * the model and/or the view
   * */
  private function view () {
    
  }
}
