<?php
    class RosterPlayer {		
        public $FranchiseId = "";
        public $PlayerId = "";
        public $Status = "";
        
        public function IsValid() {
            if((int)$this->FranchiseId > 0 && (int)$this->PlayerId > 0) {
                return true;
            }
            return false;
        }
    }






