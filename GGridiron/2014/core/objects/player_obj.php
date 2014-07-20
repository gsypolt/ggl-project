<?php
    class Player {		
        public $Id = "";
        public $FirstName = "";
        public $LastName = "";
		
        public $NFLTeam = "";
        public $Position = "";
        public $JerseyNumber = "";

        public $BirthDayTimeStamp = "";
		
        public $Height = "";
        public $Weight = "";		

        public $College = "";
        public $DraftTeam = "";
        public $DraftYear = "";
        public $DraftRound = "";
        public $DraftPick = "";

        public $FleaFlickerId = "";
        public $FanballId = "";
        public $CbsId = "";
        public $KfflId = "";
        public $SportsTickerId = "";
        public $RotoworldId = "";
        public $EspnId = "";
        public $StatsId = "";
        public $TwitterUserName = "";
        
        public function IsValid() {
            if((int)$this->Id > 0) {
                return true;
            }
            return false;
        }
    }






