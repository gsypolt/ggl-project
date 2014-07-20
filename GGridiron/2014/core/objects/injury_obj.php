<?php
    class Injury {		
        public $PlayerId = "";
        public $Status = "";
        public $Details = "";
        
        public function IsValid() {
            if((int)$this->PlayerId > 0) {
                return true;
            }
            return false;
        }
    }






