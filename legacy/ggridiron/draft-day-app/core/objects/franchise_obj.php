<?php
    class Franchise {		
        public $Id = "";
        public $Abbreviation = "";
        public $DivisionId = "";
        public $Name = "";
        public $IconUrl = "";
        public $LogoUrl = "";
        public $IsCommish = "";
        public $WaiverSortOrder = "";	
        
        public function IsValid() {
            if((int)$this->Id > 0) {
                return true;
            }
            return false;
        }
    }






