<?php
    class DraftResult {		
        public $FranchiseId = "";
        public $Round = "";
        public $Pick = "";
        public $PlayerId = "";
        public $Timestamp = "";
        public $Comments = "";
        
        public function IsValid() {
            if((int)$this->FranchiseId > 0) {
                return true;
            }
            return false;
        }
    }






