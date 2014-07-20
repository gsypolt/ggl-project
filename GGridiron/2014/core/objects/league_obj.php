<?php
    class League {		
        public $Id = "";
        public $Name = "";
        public $RosterSize = "";
        public $InjuredReserve = "";
        public $TaxiSquad = "";
        public $RostersPerPlayer = "";
        public $PlayerLimitUnit = "";
        public $StartWeek = "";
        public $EndWeek = "";
        public $LastRegularSeasonWeek = "";
        public $BaseURL = "";
        public $MaxKeepers = "";        
        public $Precision = "";
        public $H2H = "";
        public $CurrentWaiverType = "";
        public $Lockout = "";
        public $Tiebreaker = "";
        public $TiebreakerCount = "";
        public $TieBreakerPosition = "";        
        public $StandingsSort = "";
        public $SurviverPool = "";
        public $SurvivorPoolStartWeek = "";
        public $SurvivorPoolEndWeek = ""; 
        public $NflPoolType = "";
        public $NflPoolStartWeek = "";
        public $NflPoolEndWeek = "";        
        public $FantasyPoolType = "";
        public $FantasyPoolStartWeek = "";   
        public $FantasyPoolEndWeek = "";              
        public $DraftLimitHours = ""; 
        public $LoadRosters = "";
        public $Franchises = array();
        public $Divisions = array();
        
        public function IsValid() {
            if($this->Name != "") {
                return true;
            }
            return false;
        }
    }






