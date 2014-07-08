<?php
    class FreeAgent {	
        public $Id = "";
        
        public function IsValid() {
            if((int)$this->Id > 0) {
                return true;
            }
            return false;
        }
    }






