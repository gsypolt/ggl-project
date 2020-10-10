<?php
    class PlayerScore {	
        public $PlayerId = "";
        public $LeagueId = "";
        public $Year = "";
        public $Week = "";
        public $Score = "";
        
        public function IsValid() {
            if((int)$this->PlayerId > 0) {
                return true;
            }
            return false;
        }
    }






