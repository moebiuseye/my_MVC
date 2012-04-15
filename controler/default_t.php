<?php

class default_t {
  public $args = Array();

  public function default_t () {
    array_push($this->args, "Hello");
    $args = $this->args;
    return $this->args;
  }

  /* WARNING :
   * Any private function cannot be called from
   * the method and/or the view
   * */
  private function view () {
    
  }
}
