<?php
    class Division {		
        public $Id = "";
        public $Name = "";
        
        public function IsValid() {
            if($this->Name != '') {
                return true;
            }
            return false;
        }
    }






