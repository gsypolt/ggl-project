<?php       
    ########################
    #  EXTERNAL FUNCTIONS  #
    ########################
    
    # Update Functions
    function update_league_db() {
        log_info("update_league_db() function called");

        # Get league data
        $league = get_mfl_league();       
        
        # Submit league to the database
        clear_league_table();
        submit_league_to_db($league);
        submit_update_to_db(LEAGUE_DATA_SET);

        # Submit divisions to the database
        # Check if league data is valid
        clear_divisions_table();
        submit_divisions_to_db($league->Divisions);
        submit_update_to_db(DIVISIONS_DATA_SET);

        # Submit franchises to the database
        clear_franchises_table();
        submit_franchises_to_db($league->Franchises);
        submit_update_to_db(FRANCHISES_DATA_SET);
        
        log_info("update_league_db() function complete");
        return true;
    }
    function update_players_db() {
        log_info("update_players_db() function called");

        # Get players data
        $players =  get_mfl_players();   
        
        # Submit players to the database
        clear_players_table();
        submit_players_to_db($players);
        submit_update_to_db(PLAYERS_DATA_SET);
        
        log_info("update_players_db() function complete");
        
        return true; 
    }
    function update_injuries_db() {
        log_info("update_injuries_db() function called");
        
        clear_injuries_table();

        # Get injury data
        $injuries =  get_mfl_injuries();    
        
        # Submit injuries to the database
        submit_injuries_to_db($injuries);
        submit_update_to_db(INJURIES_DATA_SET);
        
        log_info("update_injuries_db() function complete");
        
        return true;
    }
    function update_roster_players_db() {
        log_info("update_roster_players_db() function called");

        # Get rosters data
        $roster_players =  get_mfl_roster_players();    

        # Submit injuries to the database 
        clear_roster_players_table();
        submit_roster_players_to_db($roster_players);
        submit_update_to_db(ROSTER_PLAYERS_DATA_SET);
        
        log_info("update_roster_players_db() function complete");
        
        return true;
    }
    function update_player_scores_db($league_id = null, $year = null, $week = null, $clear = false) {
        log_info("update_player_scores() function called");
        
        if($league_id == null) {
            $league_id = MFL_LEAGUE_ID;
        }
        if($year == null) {
            $year = MFL_YEAR;
        }
        
        # Create blank arrays
        $weeks = array();        
        
        # Check if week was given
        if($week == null) {
            # Get league data
            $league = get_league();
            
            $start_week = (int)$league['start_week'];
            $end_week = (int)$league['end_week'];
            
            for($i = $start_week; $i <= $end_week; $i++) {
                $weeks[] = $i;
            }
        } else {
            $weeks[] = $week;
        }
        
        log_info("A total of ".sizeof($weeks)." (".$start_week." to ".$end_week.") weeks have been requested for league_id:$league_id, year:$year");
        
        $player_scores = array();
        
        foreach($weeks as $week):
            # Get player score data
            $player_scores_array = get_mfl_player_scores($league_id,$year,$week);
            if(sizeof($player_scores_array) > 0) {
                $player_scores = array_merge($player_scores,$player_scores_array);
            }
        endforeach;

        # Submit player scores to the database
        if($clear) {
            clear_player_scores_table();
        }
        submit_player_scores_to_db($player_scores);
        submit_update_to_db(PLAYER_SCORES_DATA_SET);
            
        log_info("update_player_scores() function complete");
        return true;        
    }
    function update_free_agents_db() {
        log_info("update_free_agents_db() function called");
        
        clear_free_agents_table();

        # Get free agent data
        $free_agents =  get_mfl_free_agents();    
        
        # Submit injuries to the database
        submit_free_agents_to_db($free_agents);
        submit_update_to_db(FREE_AGENTS_DATA_SET);
        
        log_info("update_free_agents_db() function complete");
        
        return true;
    }
    function update_draft_results_db($league_id = null, $year = null) {
        log_info("update_draft_results_db() function called");
        
        if($league_id == null) {
            $league_id = MFL_LEAGUE_ID;
        }
        if($year == null) {
            $year = MFL_YEAR;
        }
        
        clear_draft_results_table();
        
        # Get free agent data
        $draft_results =  get_mfl_draft_results($league_id,$year); 
        
        # Submit injuries to the database
        submit_draft_results_to_db($draft_results);
        submit_update_to_db(DRAFT_RESULTS_DATA_SET);
        
        log_info("update_draft_results_db() function complete");
        
        return true;
    }
    
    # Get Functions
    function get_league() {
        log_info("get_league() function called");
        
        # Set Table Name
        $table_name = LEAGUE_TABLE;

        # Build Query
        $query = "SELECT * FROM $table_name";
        
        # Do Query
        db_query($query);

        # Check for db error
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }    
        
        log_info("get_league() function complete");
        
        return db_get_single_result();
    }
    function get_divisions() {
        log_info("get_divisions() function called");
        
        # Set Table Name
        $table_name = DIVISIONS_TABLE;

        # Build Query
        $query = "SELECT * FROM $table_name";
        
        # Do Query
        db_query($query);

        # Check for db error
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }    
        
        log_info("get_divisions() function complete");
        
        return db_get_result_array();
    }
    function get_franchises() {
        log_info("get_franchises() function called");
        
        # Set Table Name
        $table_name = FRANCHISES_TABLE;

        # Build Query
        $query = "SELECT * FROM $table_name";
        
        # Do Query
        db_query($query);

        # Check for db error
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }    
        
        log_info("get_franchises() function complete");
        
        return db_get_result_array();
    }
    function get_injuries() {
        log_info("get_injuries() function called");
        
        # Set Table Name
        $table_name = INJURIES_TABLE;

        # Build Query
        $query = "SELECT * FROM $table_name";
        
        # Do Query
        db_query($query);

        # Check for db error
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }    
        
        log_info("get_injuries() function complete");
        
        return db_get_result_array();
    }
    function get_roster_players($franchise_id = null) {
        log_info("get_roster_players() function called");
        
        # Set Table Name
        $table_name = ROSTER_PLAYERS_TABLE;

        # Build Query
        if($franchise_id == null) {
            $query = "SELECT * FROM $table_name";            
        } else {
            $franchise_id = db_escape_string(trim($franchise_id));
            $query = "SELECT * FROM $table_name WHERE franchise_id='$franchise_id'";
        }
        
        # Do Query
        db_query($query);

        # Check for db error
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }    
        
        log_info("get_roster_players() function complete");
        
        return db_get_result_array();
    }  
    function get_player_scores($player_ids = null) {
        log_info("get_player_scores() function called");
        
        # Set Table Name
        $table_name = PLAYER_SCORES_TABLE;

        # Build Query
        if($player_ids == null) {
            $query = "SELECT * FROM $table_name";            
        } else {
            if(!is_array($player_ids)) {
                log_error("The input variable must be an array");
                return array();
            }
            
            $query = "SELECT * FROM $table_name WHERE ";

            foreach($player_ids as $key => $player_id):
                $player_id = db_escape_string(trim($player_id));

                $query .= "id='$player_id'";

                # Add OR if not last entry
                if($key != sizeof($player_ids)-1) {
                    $query .= " OR ";
                }
            endforeach;
        }
        
        # Do Query
        db_query($query);

        # Check for db error
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }    
        
        log_info("get_player_scores() function complete");
        
        return db_get_result_array();
    }
    function get_players($player_ids = null) {
        log_info("get_players() function called");
        
        # Set Table Name
        $table_name = PLAYERS_TABLE;

        # Build Query
        if($player_ids == null) {
            $query = "SELECT * FROM $table_name";            
        } else {
            if(!is_array($player_ids)) {
                log_error("The input variable must be an array");
                return array();
            }
            log_info("Size = ".sizeof($player_ids));
            $query = "SELECT * FROM $table_name WHERE ";

            foreach($player_ids as $key => $player_id):
                $player_id = db_escape_string(trim($player_id));

                $query .= "id='$player_id'";

                # Add OR if not last entry
                if($key != sizeof($player_ids)-1) {
                    $query .= " OR ";
                }
            endforeach;
        }
        
        # Do Query
        db_query($query);

        # Check for db error
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }    
        
        log_info("get_players() function complete");
        
        return db_get_result_array();
    }
    function get_free_agents() {
        log_info("get_free_agents() function called");
        
        # Set Table Name
        $table_name = FREE_AGENTS_TABLE;

        # Build Query
        $query = "SELECT * FROM $table_name";
        
        # Do Query
        db_query($query);

        # Check for db error
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }    
        
        log_info("get_free_agents() function complete");
        
        return db_get_result_array();
    }
    function get_draft_results() {
        log_info("get_draft_results() function called");
        
        # Set Table Name
        $table_name = DRAFT_RESULTS_TABLE;

        # Build Query
        $query = "SELECT * FROM $table_name";
        
        # Do Query
        db_query($query);

        # Check for db error
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }    
        
        log_info("get_draft_results() function complete");
        
        return db_get_result_array();
    }
    
    function get_draft_settings() {
        log_info("get_draft_settings() function called");
        
        # Set Table Name
        $table_name = DRAFT_SETTINGS_TABLE;

        # Build Query
        $query = "SELECT * FROM $table_name";
        
        # Do Query
        db_query($query);

        # Check for db error
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }    
        
        log_info("get_draft_settings() function complete");
        
        return db_get_single_result();
    }
    
    # Heartbeats
    function update_franchise_heartbeat($franchise_id) {
        log_info("update_franchise_heartbeat() function called");
        
        # Clean inputs
        $franchise_id = db_escape_string(trim($franchise_id));  
        
        #Set Table Name
        $table_name = FRANCHISE_HEARTBEAT_TABLE;
        
        $timestamp = time();
        $ip_address = $_SERVER['REMOTE_ADDR'];
        
        # Build query based on whether to create of update player entry    
        if(!does_franchise_heartbeat_exist($franchise_id)) {            
            $query = "INSERT INTO $table_name (heartbeat,franchise_id,ip_address) VALUES ('$timestamp','$franchise_id','$ip_address')";
        } else {    
            $query = "UPDATE $table_name SET heartbeat='$timestamp',ip_address='$ip_address' WHERE franchise_id='$franchise_id'";
        }

        # Perform Query
        db_query($query);  

        # Check for db error
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }    
        log_info("update_franchise_heartbeat() function complete");
        return true;
    }
    function update_admin_heartbeat() {
        log_info("update_admin_heartbeat() function called");
        
        #Set Table Name
        $table_name = ADMIN_HEARTBEAT_TABLE;
        
        $timestamp = time();
        $ip_address = $_SERVER['REMOTE_ADDR'];
        
        # Build query based on whether to create of update player entry    
        if(!does_admin_heartbeat_exist()) {            
            $query = "INSERT INTO $table_name (heartbeat,ip_address) VALUES ('$timestamp','$ip_address')";
        } else {    
            $query = "UPDATE $table_name SET heartbeat='$timestamp',ip_address='$ip_address' WHERE id='1'";
        }

        # Perform Query
        db_query($query);  

        # Check for db error
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }    
        log_info("update_admin_heartbeat() function complete");
        return true;
    }   
    function get_franchise_connections() {
        log_info("get_franchise_connections() function called");
        
        # Set Table Name
        $table_name = FRANCHISE_HEARTBEAT_TABLE;

        # Perform Query
        $query = "SELECT * FROM $table_name";
        db_query($query);

        # Check for db error
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }    

        $db_array = db_get_result_array();
        
        $return_array = array();
        foreach($db_array as $value):
            $franchise_array = array();
            $franchise_array['franchise_id'] = $value['franchise_id'];            
            if((time() - (int)$value['heartbeat']) < HEARTBEAT_TIMEOUT) {
                $franchise_array['connected'] = true;
            } else {
                $franchise_array['connected'] = false;
            }
            $return_array[] = $franchise_array;
        endforeach;
        
        log_info("get_franchise_connections() function complete");
        return $return_array;
    }
    function is_admin_connected() {
        log_info("is_admin_connected() function called");
        
        # Set Table Name
        $table_name = ADMIN_HEARTBEAT_TABLE;

        # Perform Query
        $query = "SELECT * FROM $table_name WHERE id='1'";
        db_query($query);

        # Check for db error
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }    
        # Return Array
        $db_value = db_get_single_result();

        if((time() - (int)$db_value['heartbeat']) < HEARTBEAT_TIMEOUT) {
            log_info("is_admin_connected() function complete");
            return true;
        }
        log_info("is_admin_connected() function complete");
        return false;
    }
    
    # Draft Settings.
    function does_draft_settings_exist() {
        log_info("does_draft_settings_exist() function called");
         
        $franchise_id = db_escape_string(trim($franchise_id));
        
        $table_name = DRAFT_SETTINGS_TABLE;
        $query = "SELECT * FROM $table_name WHERE id='0'";
        $result = db_query($query);
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }
        if(sizeof($result) < 1) {
            log_info("does_draft_settings_exist() function complete");
            return false;
        }
        log_info("does_draft_settings_exist() function complete");
        return true;
    }
    function start_live_draft() {
        log_info("start_live_draft() function called");
        
        #Set Table Name
        $table_name = DRAFT_SETTINGS_TABLE;
        
        if(!does_draft_settings_exist()) {            
            $query = "INSERT INTO $table_name (live_draft_enabled,offline_draft_enabled) VALUES ('1','0')";
        } else {    
            $query = "UPDATE $table_name SET live_draft_enabled='1',offline_draft_enabled='0' WHERE id='0'";
        }
        
        db_query($query);  

        # Check for db error
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }    
        log_info("start_live_draft() function complete");
        return true;        
    }
    function stop_live_draft() {
        log_info("stop_live_draft() function called");
        
        #Set Table Name
        $table_name = DRAFT_SETTINGS_TABLE;
        
        if(!does_draft_settings_exist()) {            
            $query = "INSERT INTO $table_name (live_draft_enabled) VALUES ('0')";
        } else {    
            $query = "UPDATE $table_name SET live_draft_enabled='0' WHERE id='0'";
        }
        
        db_query($query);  

        # Check for db error
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }    
        log_info("stop_live_draft() function complete");
        return true;
    }
    function start_offline_draft() {
        log_info("start_offline_draft() function called");
        
        #Set Table Name
        $table_name = DRAFT_SETTINGS_TABLE;
        
        if(!does_draft_settings_exist()) {            
            $query = "INSERT INTO $table_name (live_draft_enabled,offline_draft_enabled) VALUES ('0','1')";
        } else {    
            $query = "UPDATE $table_name SET live_draft_enabled='0',offline_draft_enabled='1' WHERE id='0'";
        }
        
        db_query($query);  

        # Check for db error
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }    
        log_info("start_offline_draft() function complete");
        return true;
    }
    function stop_offline_draft() {
        log_info("stop_offline_draft() function called");
        
        #Set Table Name
        $table_name = DRAFT_SETTINGS_TABLE;
        
        if(!does_draft_settings_exist()) {            
            $query = "INSERT INTO $table_name (offline_draft_enabled) VALUES ('0')";
        } else {    
            $query = "UPDATE $table_name SET offline_draft_enabled='0' WHERE id='0'";
        }
        
        db_query($query);  

        # Check for db error
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }    
        log_info("stop_offline_draft() function complete");
        return true;
    }
    function is_draft_active() {
        log_info("is_draft_enabled() function called");
        
        # Clean inputs
        $franchise_id = db_escape_string(trim($franchise_id));  
    
        # Run Query
        $table_name = DRAFT_SETTINGS_TABLE;
        $query = "SELECT id FROM $table_name WHERE live_draft_enabled='1' OR offline_draft_enabled='1'";
        $result = db_query($query);

        # Check for db error
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }

        # Check
        if(sizeof($result) < 1) {
            log_info("is_draft_enabled() function complete");
            return false;
        }
        log_info("is_draft_enabled() function complete");
        return true;
    }
    function get_offline_draft_start_timestamp() {
        log_info("get_league() function called");
        
        # Set Table Name
        $table_name = DRAFT_SETTINGS_TABLE;

        # Build Query
        $query = "SELECT offline_draft_start_timestamp FROM $table_name";
        
        # Do Query
        db_query($query);

        # Check for db error
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }    
        
        $data = db_get_single_result();
        
        log_info("get_league() function complete");
        
        return $data['offline_draft_start_timestamp'];
    }
    function is_franchise_commish($franchise_id) {
        if(!REQUIRE_COMMISH_PRIV) {
            return true;
        }
        log_info("is_franchise_commish() function called");
        
        $franchise_id = db_escape_string(trim($franchise_id));
        
        # Set Table Name
        $table_name = FRANCHISES_TABLE;

        # Perform Query
        $query = "SELECT * FROM $table_name WHERE id='$franchise_id' AND is_commish='1'";
        db_query($query);

        # Check for db error
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }    
        # Return Array
        $result = db_query($query);
        
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }
        
        if(sizeof($result) < 1) {
            log_info("is_franchise_commish() function complete");
            return false;
        }
        
        log_info("is_franchise_commish() function complete");
        return true;
    }
        
    ########################
    #  INTERNAL FUNCTIONS  #
    ########################
    
    # MFL functions 
    function get_mfl_league() {
        log_info("get_mfl_league() function called");
        
        # Definitions
        $year = MFL_YEAR;
        $league_id = MFL_LEAGUE_ID;

        $url = "http://football.myfantasyleague.com/$year/export?TYPE=league&L=$league_id&JSON=1&DETAILS=1";

        # Grab League details from MFL
        $json = file_get_contents($url);
        $json_data = json_decode($json, true);

        # ----------------
        # ---- LEAGUE ----
        # ----------------
        
        # Create new league object
        $league = new League();
        
        # Check if data is valid
        if(!array_key_exists('league',$json_data)) {
            log_error("League not found in JSON data");
            return $league;
        }
        
        # Get League Details
        $league_data = $json_data['league'];

        # Build league object with data
        
        $league->Id  = (int)$league_data['id'];
        $league->Name  = $league_data['name'];
        $league->RosterSize  = (int)$league_data['rosterSize'];
        $league->InjuredReserve  = (int)$league_data['injuredReserve'];
        $league->TaxiSquad  = (int)$league_data['taxiSquad'];
        $league->RostersPerPlayer  = (int)$league_data['rostersPerPlayer'];
        $league->PlayerLimitUnit  = $league_data['playerLimitUnit'];
        $league->StartWeek  = (int)$league_data['startWeek'];
        $league->EndWeek  = (int)$league_data['endWeek'];
        $league->LastRegularSeasonWeek  = (int)$league_data['lastRegularSeasonWeek'];
        $league->BaseURL  = $league_data['baseURL'];
        $league->MaxKeepers  = (int)$league_data['maxKeepers'];
        $league->Precision  = (int)$league_data['precision'];
        $league->H2H  = $league_data['h2h'];
        $league->CurrentWaiverType  = $league_data['currentWaiverType'];
        $league->Lockout  = $league_data['lockout'];
        $league->Tiebreaker  = $league_data['tiebreaker'];
        $league->TiebreakerCount  = (int)$league_data['tiebreakerCount'];
        $league->TieBreakerPosition  = $league_data['tiebreakerPosition'];
        $league->StandingsSort  = $league_data['standingsSort'];
        $league->SurviverPool  = $league_data['survivorPool'];
        $league->SurvivorPoolStartWeek  = (int)$league_data['survivorPoolStartWeek'];
        $league->SurvivorPoolEndWeek  = (int)$league_data['survivorPoolEndWeek'];
        $league->NflPoolType  = $league_data['nflPoolType'];
        $league->NflPoolStartWeek  = (int)$league_data['nflPoolStartWeek'];
        $league->NflPoolEndWeek  = (int)$league_data['nflPoolEndWeek'];
        $league->FantasyPoolType  = $league_data['fantasyPoolType'];
        $league->FantasyPoolStartWeek  = (int)$league_data['fantasyPoolStartWeek'];
        $league->FantasyPoolEndWeek  = (int)$league_data['fantasyPoolEndWeek'];
        $league->LoadRosters  = $league_data['loadRosters'];
        $league->DraftLimitHours  = $league_data['draftLimitHours'];
        
        # -------------------
        # ---- DIVISIONS ----
        # -------------------
        
        # Create division object array
        $divisions = array();
        
        # Check if data is valid
        if(!array_key_exists('divisions',$league_data)) {
            log_error("Divisions not found in JSON data");
        }else if(!array_key_exists('division',$league_data['divisions'])) {
            log_error("Divisions->division not found in JSON data");
        } else {        
            # Get division data from league data
            $divisions_data  = $league_data['divisions']['division'];

            foreach($divisions_data as $division_data):
                # Create new division object
                $division = new Division();

                #Build division object
                $division->Id = $division_data['id'];
                $division->Name = $division_data['name'];          

                # Add division to array
                $divisions[] = $division;
            endforeach;     

            $league->Divisions = $divisions;    
        }
        
        # ---------------------------
        # ---- FRANCHISES UPDATE ----
        # ---------------------------

        # Create franchise object array
        $franchises = array();
        
        # Check if data is valid
        if(!array_key_exists('franchises',$league_data)) {
            log_error("Franchises not found in JSON data");
        }else if(!array_key_exists('franchise',$league_data['franchises'])) {
            log_error("Franchises->franchise not found in JSON data");
        } else {
            # Get franchise data from league data
            $franchises_data  = $league_data['franchises']['franchise'];
            foreach($franchises_data as $franchise_data):
                    
                
                # Make a new franchise object
                $franchise = new Franchise();

                # Place franchise data into franchise array
                $franchise->Id = $franchise_data['id'];
                $franchise->Name = $franchise_data['name'];
                $franchise->Abbreviation = $franchise_data['abbrev'];
                $franchise->DivisionId = $franchise_data['division'];
                $franchise->IconrUrl = $franchise_data['icon'];
                $franchise->LogoUrl= $franchise_data['logo'];
                $franchise->WaiverSortOrder = $franchise_data['waiverSortOrder'];
                $franchise->IsCommish = $franchise_data['iscommish'];

                # Add franchise object to array
                $franchises[] = $franchise;
            endforeach;

            $league->Franchises = $franchises;
        }
        
        log_info("get_mfl_league() function complete");
        
        return $league;
    } 
    function get_mfl_players() {
        log_info("get_mfl_players() function called");
        
        # Definitions
        $year = MFL_YEAR;     

        # Grab Player details from MFL
        $url = "http://football.myfantasyleague.com/$year/export?TYPE=players&L=&W=&JSON=1&DETAILS=1";
        $json = file_get_contents($url);

        # Pack JSON data
        $json_data = json_decode($json, true);

        $players = array();
                
        if(!array_key_exists('players',$json_data)) {
            log_error("Players not found in JSON data");
            return $players;
        }
        
        if(!array_key_exists('player',$json_data['players'])) {
            log_error("Players->player not found in JSON data");
            return $players;
        }
        
        # Set players_data
        $players_data = $json_data['players']['player'];
        
        foreach ($players_data as $player_data):
            # Create a new Player object
            $player = new Player();

            # Build player object
            $player->Id = (int)$player_data['id'];
            $full_name = $player_data['name'];
            $name_array = explode(",", $full_name);
            $player->LastName = trim($name_array[0]);
            $player->FirstName = trim($name_array[1]);
            $player->NFLTeam  = $player_data['team'];
            $player->Position  = $player_data['position'];
            $player->JerseyNumber  = (int)$player_data['jersey'];
            $player->BirthDayTimeStamp  = (int)$player_data['birthdate'];
            $player->Height  = (int)$player_data['height'];
            $player->Weight  = (int)$player_data['weight'];
            $player->College  = $player_data['college'];
            $player->DraftTeam  = $player_data['draft_team'];
            $player->DraftYear  = (int)$player_data['draft_year'];
            $player->DraftRound  = (int)$player_data['draft_round'];
            $player->DraftPick  = (int)$player_data['draft_pick'];
            $player->FleaFlickerId  = $player_data['fleaflicker_id'];
            $player->FanballId  = $player_data['fanball_id'];
            $player->CbsId  = $player_data['cbs_id'];
            $player->KfflId  = $player_data['kffl_id'];
            $player->SportsTickerId  = $player_data['sportsticker_id'];
            $player->RotoworldId  = $player_data['rotoworld_id'];
            $player->EspnId  = $player_data['espn_id'];
            $player->StatsId  = $player_data['stats_id'];
            $player->TwitterUserName  = $player_data['twitter_username'];
            # Add player object to array
            $players[] = $player;
        endforeach;

        log_info("get_mfl_players() function complete");
        
        return $players;
    }
    function get_mfl_injuries() {
        log_info("get_mfl_injuries() function called");
        
        # Definitions
        $year = MFL_YEAR;

        $url = "http://football.myfantasyleague.com/$year/export?TYPE=injuries&L=&W=&JSON=1&DETAILS=1";

        # Grab Laegue details from MFL
        $json = file_get_contents($url);
        $json_data = json_decode($json, true);
        
        # Create injury object array
        $injuries = array();
        
        
        if(!array_key_exists('injuries',$json_data)) {
            log_error("Injuries not found in JSON data");
            return $injuries;
        }
        
        if(!array_key_exists('injury',$json_data['injuries'])) {
            log_error("Injuries->injury not found in JSON data");
            return $injuries;
        }
        
        $injuries_data = $json_data['injuries']['injury'];

        foreach ($injuries_data as $injury_data):
            # Create a new Injury object
            $injury = new Injury(); 

            # Build injury object
            $injury->PlayerId = $injury_data['id'];
            $injury->Status = $injury_data['status'];
            $injury->Details = $injury_data['details'];

            # Add injury object to array
            $injuries[] = $injury;          
        endforeach;
        
        log_info("get_mfl_injuries() function complete");
        return $injuries;
    }
    function get_mfl_roster_players() {
        log_info("get_mfl_rosters() function called");
        
        # Definitions
        $year = MFL_YEAR;
        $league_id = MFL_LEAGUE_ID;

        $url = "http://football3.myfantasyleague.com/$year/export?TYPE=rosters&L=$league_id&W=&JSON=1";

        # Grab Laegue details from MFL
        $json = file_get_contents($url);
        $json_data = json_decode($json, true);
        
        # Create rosters object array
        $roster_players = array();
        
        if(!array_key_exists('rosters',$json_data)) {
            log_error("Rosters not found in JSON data");
            return $roster_players;
        }
        
        if(!array_key_exists('franchise',$json_data['rosters'])) {
            log_error("Rosters->franchise not found in JSON data");
            return $roster_players;
        }
        
        $rosters = $json_data['rosters']['franchise'];

        foreach ($rosters as $roster_data):
            # Create a new roster object
            $roster_player = new RosterPlayer(); 

            # Get Franchise id
            $current_franchise_id = $roster_data['id'];

            # Get players on franchise roster
            $players_on_team = $roster_data['player'];

            foreach($players_on_team as $player_on_team):
                # Create new roster player object
                $roster_player = new RosterPlayer();

                # Build injury object
                $roster_player->FranchiseId = $current_franchise_id;
                $roster_player->PlayerId = $player_on_team['id'];
                $roster_player->Status = $player_on_team['status'];

                # Add injury object to array
                $roster_players[] = $roster_player;     
            endforeach;
        endforeach;

        log_info("get_mfl_rosters() function complete");
        return $roster_players;
    }
    function get_mfl_player_scores($league_id, $year, $week) {
        log_info("get_mfl_player_scores() function called");
        
        $player_scores = array();

        $url = "http://football20.myfantasyleague.com/$year/export?TYPE=playerScores&L=$league_id&W=$week&JSON=1";        
        $json = file_get_contents($url);
        $json_data = json_decode($json, true);

        if(!array_key_exists('playerScores',$json_data)) {
            log_error("playerScores not found in JSON data");
            return $player_scores;
        }

        if(!array_key_exists('playerScore',$json_data['playerScores'])) {
            log_error("playerScores->playerScore not found in JSON data");
            return $player_scores;
        }

        $player_scores_data = $json_data['playerScores']['playerScore'];

        if(is_multi_array($player_scores_data)) { 
            foreach($player_scores_data as $player_score_data): 
                if((int)$player_score_data['id'] != null && (int)$player_score_data['id'] != 0) {
                    $player_score = new PlayerScore();

                    $player_score->LeagueId = $league_id;
                    $player_score->Year = $year;
                    $player_score->Week = $week;         
                    $player_score->PlayerId = (int)$player_score_data['id'];
                    $player_score->Score = $player_score_data['score'];

                    $player_scores[] = $player_score;
                }
            endforeach;
        } else {
            if((int)$player_scores_data['id'] != null && (int)$player_scores_data['id'] != 0) {
                $player_score = new PlayerScore();

                $player_score->LeagueId = $league_id;
                $player_score->Year = $year;
                $player_score->Week = $week;         
                $player_score->PlayerId = (int)$player_score_data['id'];
                $player_score->Score = $player_score_data['score'];

                $player_scores[] = $player_score;
            }
        }
        
        log_info("get_mfl_player_scores() function complete");
        
        return $player_scores;
    }
    function get_mfl_free_agents() {
        log_info("get_mfl_free_agents() function called");
        
        # Definitions
        $year = MFL_YEAR;  
        $league_id = MFL_LEAGUE_ID;

        # Grab Free agent details from MFL
        $url = "http://football.myfantasyleague.com/$year/export?TYPE=freeAgents&L=$league_id&W=&JSON=1";
        $json = file_get_contents($url);

        # Pack JSON data
        $json_data = json_decode($json, true);

        $free_agents = array();
                
        if(!array_key_exists('freeAgents',$json_data)) {
            log_error("freeAgents not found in JSON data");
            return $free_agents;
        }
        
        if(!array_key_exists('leagueUnit',$json_data['freeAgents'])) {
            log_error("freeAgents->leagueUnit not found in JSON data");
            return $free_agents;
        }
        
        if(!array_key_exists('player',$json_data['freeAgents']['leagueUnit'])) {
            log_error("freeAgents->leagueUnit->player not found in JSON data");
            return $free_agents;
        }
        
        # Set free agent
        $free_agents_data = $json_data['freeAgents']['leagueUnit']['player'];
        
        foreach ($free_agents_data as $free_agent_data):
            # Create a new FreeAgent object
            $free_agent = new FreeAgent();

            # Build free agent object
            $free_agent->Id = (int)$free_agent_data['id'];
            
            # Add free agent object to array
            $free_agents[] = $free_agent;
        endforeach;

        log_info("get_mfl_free_agents() function complete");
        
        return $free_agents;
    }
    function get_mfl_draft_results($league_id, $year) {
        log_info("get_mfl_draft_results() function called");
        
        $draft_results = array();

        $url = "http://football20.myfantasyleague.com/$year/export?TYPE=draftResults&L=$league_id&JSON=1";        
        $json = file_get_contents($url);
        $json_data = json_decode($json, true);

        if(!array_key_exists('draftResults',$json_data)) {
            log_error("draftResults not found in JSON data");
            return $draft_results;
        }

        if(!array_key_exists('draftUnit',$json_data['draftResults'])) {
            log_error("draftResults->draftUnit not found in JSON data");
            return $draft_results;
        }
        
        if(!array_key_exists('draftPick',$json_data['draftResults']['draftUnit'])) {
            log_error("draftResults->draftUnit->draftPick not found in JSON data");
            return $draft_results;
        }

        $draft_results_data = $json_data['draftResults']['draftUnit']['draftPick'];
        if(is_multi_array($draft_results_data)) { 
            foreach($draft_results_data as $draft_result_data): 
                if((int)$draft_result_data['franchise'] != 0) {
                    $draft_result = new DraftResult();

                    $draft_result->FranchiseId = $draft_result_data['franchise'];
                    $draft_result->Round = (int)$draft_result_data['round'];
                    $draft_result->Pick = (int)$draft_result_data['pick'];         
                    $draft_result->PlayerId = (int)$draft_result_data['player'];
                    $draft_result->Comments = $draft_result_data['comments'];
                    $draft_result->Timestamp = $draft_result_data['timestamp'];
                    log_info("stamp=".$draft_result_data['timestamp']);
                    $draft_results[] = $draft_result;
                }
            endforeach;
        } else {
            if((int)$draft_results_data['franchise'] != 0) {
                $draft_result = new DraftResult();

                $draft_result->FranchiseId = $draft_results_data['franchise'];
                $draft_result->Round = (int)$draft_results_data['round'];
                $draft_result->Pick = (int)$draft_results_data['pick'];         
                $draft_result->PlayerId = (int)$draft_results_data['player'];
                $draft_result->Comments = $draft_results_data['comments'];
                $draft_result->TimeStamp = $draft_results_data['timestamp'];
                $draft_results[] = $draft_result;
            }
        }
        
        log_info("get_mfl_draft_results() function complete");
        
        return $draft_results;
    }
    function draft_player_using_mfl($player_id) {
        log_info("mfl_draft_player() function called");

        $league_id = MFL_LEAGUE_ID;
        $year = MFL_YEAR;
        
        $url = "http://football.myfantasyleague.com/$year/live_chat?L=$league_id&PLAYER_PICK=$player_id&XML=1"; 
        log_info($url);
        $context  = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
        $xml = file_get_contents($url, false, $context);
        $xml = simplexml_load_string($xml);
        $json_data = xml_to_array($xml);
        
        log_info("mfl_draft_player() function complete");
        echo json_encode($json_data);
        die();
        
    }
    
    # Database submission functions (ALL USE OBJECTS FOR VARIABLES)
    function submit_league_to_db($league) {
        log_info("submit_league_to_db() function called");
        
        # Check league data for validation
        if(!$league->IsValid()) {
            log_error("Invlaid league data detected!");
            return false;
        }
        
        #Set Table Name
        $table_name = LEAGUE_TABLE;
        
        # Clean inputs      
        $id = db_escape_string(trim($league->Id));
        $name = db_escape_string(trim($league->Name));
        $roster_size = db_escape_string(trim($league->RosterSize));
        $injured_reserve = db_escape_string(trim($league->InjuredReserve));
        $taxi_squad = db_escape_string(trim($league->TaxiSquad));
        $rosters_per_player = db_escape_string(trim($league->RostersPerPlayer));
        $player_limit_units = db_escape_string(trim($league->PlayerLimitUnit));
        $start_week = db_escape_string(trim($league->StartWeek));
        $end_week = db_escape_string(trim($league->EndWeek));
        $last_regular_season_week = db_escape_string(trim($league->LastRegularSeasonWeek));
        $base_url = db_escape_string(trim($league->BaseURL));
        $max_keepers = db_escape_string(trim($league->MaxKeepers));
        $precision = db_escape_string(trim($league->Precision));
        $h2h = db_escape_string(trim($league->H2H));
        $current_waiver_type = db_escape_string(trim($league->CurrentWaiverType));
        $lockout = db_escape_string(trim($league->Lockout));
        $tie_breaker = db_escape_string(trim($league->Tiebreaker));
        $tie_breaker_count = db_escape_string(trim($league->TiebreakerCount));
        $tie_breaker_position = db_escape_string(trim($league->TieBreakerPosition));
        $standings_sort = db_escape_string(trim($league->StandingsSort));
        $surviver_pool = db_escape_string(trim($league->SurviverPool));
        $survivor_pool_start_week = db_escape_string(trim($league->SurvivorPoolStartWeek));
        $survivor_pool_end_week = db_escape_string(trim($league->SurvivorPoolEndWeek));
        $nfl_pool_type = db_escape_string(trim($league->NflPoolType));    
        $nfl_pool_start_week = db_escape_string(trim($league->NflPoolStartWeek));
        $nfl_pool_end_week = db_escape_string(trim($league->NflPoolEndWeek));
        $fantasy_pool_type = db_escape_string(trim($league->FantasyPoolType));
        $fantasy_pool_start_week = db_escape_string(trim($league->FantasyPoolStartWeek));
        $fantasy_pool_end_week = db_escape_string(trim($league->FantasyPoolEndWeek)); 
        $draft_limit_hours = db_escape_string(trim($league->DraftLimitHours));
        $load_rosters = db_escape_string(trim($league->LoadRosters));

        # Build query based on whether to create of update player entry    
        $query = "REPLACE INTO $table_name ("
                . "id,name,roster_size,injured_reserve,taxi_squad,rosters_per_player,"
                . "player_limit_units,start_week,end_week,last_regular_season_week,base_url,"
                . "max_keepers,precision_value,h2h,current_waiver_type,lockout,tie_breaker,tie_breaker_count,"
                . "tie_breaker_position,standings_sort,surviver_pool,survivor_pool_start_week,survivor_pool_end_week,"
                . "nfl_pool_type,nfl_pool_start_week,nfl_pool_end_week,fantasy_pool_type,"
                . "fantasy_pool_start_week,fantasy_pool_end_week,draft_limit_hours,load_rosters"
                . ") VALUES ("
                . "'$id','$name','$roster_size','$injured_reserve','$taxi_squad','$rosters_per_player',"
                . "'$player_limit_units','$start_week','$end_week','$last_regular_season_week','$base_url',"
                . "'$max_keepers','$precision','$h2h','$current_waiver_type','$lockout','$tie_breaker','$tie_breaker_count',"
                . "'$tie_breaker_position','$standings_sort','$surviver_pool','$survivor_pool_start_week','$survivor_pool_end_week',"
                . "'$nfl_pool_type','$nfl_pool_start_week','$nfl_pool_end_week','$fantasy_pool_type',"
                . "'$fantasy_pool_start_week','$fantasy_pool_end_week','$draft_limit_hours','$load_rosters'"
                . ")";	
        
        # Do Query
        db_query($query);  

        # Check for db error
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }    
        log_info("submit_league_to_db() function complete");
        return true;
    }
    function submit_franchises_to_db($franchises) {
        log_info("submit_franchises_to_db() function called");     
                
        # Set Table Name
        $table_name = FRANCHISES_TABLE; 
        
        $process_query = false;
            
        # Start building query string
         $query = "REPLACE INTO $table_name ("
                    . "id,name,abbreviation,division,icon_url,logo_url,"
                    . "waiver_sort_order,is_commish"
                    . ") VALUES ";

        # Check if input is an array
        if(!is_array($franchises)) {
            log_error("The input variable must be an array");
            return false;
        }
        if(sizeof($franchises) == 0) {
            log_error("No franchises to process");
            return false;
        }
        
        # Go through each franchise
        foreach($franchises as $key => $franchise):
            # Check if franchise is valid
            if($franchise->IsValid()) {
                # Clean Values
                $franchise->Id = db_escape_string(trim($franchise->Id));
                $franchise->Name = db_escape_string(trim($franchise->Name));
                $franchise->Abbreviation = db_escape_string(trim($franchise->Abbreviation));
                $franchise->DivisionId = db_escape_string(trim($franchise->DivisionId));
                $franchise->IconrUrl = db_escape_string(trim($franchise->IconrUrl));
                $franchise->LogoUrl= db_escape_string(trim($franchise->LogoUrl));
                $franchise->WaiverSortOrder = db_escape_string(trim($franchise->WaiverSortOrder));
                $franchise->IsCommish = db_escape_string(trim($franchise->IsCommish));

                # Add to query string
                $query .= "("
                    . "'$franchise->Id','$franchise->Name','$franchise->Abbreviation',"
                    . "'$franchise->DivisionId','$franchise->IconrUrl','$franchise->LogoUrl',"
                    . "'$franchise->WaiverSortOrder','$franchise->IsCommish'"
                    . ")";
                $process_query = true;
                # Add comma if not last entry
                if($key != sizeof($franchises)-1) {
                    $query .= ",";
                }
            } else {
                log_error("Invalid franchise detected");
            }
        endforeach;    

        if($process_query) {
            # Do Query
            db_query($query);  

            # Check for error
            if(db_error_message()) {
                $error_message = "Database error: ".db_error_message();
                log_error($error_message);
                die($error_message);
            }    
        }
        log_info("submit_franchises_to_db() function complete");
        return true;
    }    
    function submit_divisions_to_db($divisions) {
        log_info("submit_divisions_to_db() function called");
        
        # Set Table Name
        $table_name = DIVISIONS_TABLE; 
        
        $process_query = false;
            
        # Start building query string
         $query = "REPLACE INTO $table_name ("
                    . "id,name"
                    . ") VALUES ";
        
        # Check if input is an array
        if(!is_array($divisions)) {
            log_error("The input variable must be an array");
            return false;
        }        
        if(sizeof($divisions) == 0) {
            log_error("No divisions to process");
            return false;
        }
        
        foreach($divisions as $key => $division):
             # Check if franchise is valid
            if($division->IsValid()) {
                # Clean Values
                $division->Id = db_escape_string(trim($division->Id));
                $division->Name = db_escape_string(trim($division->Name));
                
                # Add to query string
                $query .= "("
                    . "'$division->Id','$division->Name'"
                    . ")";
                
                $process_query = true;
                
                # Add comma if not last entry
                if($key != sizeof($divisions)-1) {
                    $query .= ",";
                }
            } else {
                log_error("Invalid division detected");
            }
        endforeach;    

        if($process_query) {
            # Do Query
            db_query($query);  

            # Check for error
            if(db_error_message()) {
                $error_message = "Database error: ".db_error_message()."; query: $query";
                log_error($error_message);
                die($error_message);
            }    
        }
        log_info("submit_franchises_to_db() function complete");
        return true;
    }
    function submit_players_to_db($players) {
        log_info("submit_players_to_db() function called");
        
        $process_query = false;
        
        # Set Table Name
        $table_name = PLAYERS_TABLE; 
            
        # Start building query string
         $query = "REPLACE INTO $table_name ("
                    . "id,first_name,last_name,team,position,"
                    . "jersey,birthdate,height,weight,college,draft_team,draft_year,"
                    . "draft_round,draft_pick,fleaflicker_id,fanball_id,cbs_id,kffl_id,"
                    . "sportsticker_id,rotoworld_id,espn_id,stats_id,twitter_username"
                    . ") VALUES ";
         
        # Check if input is an array
        if(!is_array($players)) {
            log_error("The input variable must be an array");
            return false;
        }
        if(sizeof($players) == 0) {
            log_error("No players to process");
            return false;
        }

        foreach($players as $key => $player):
            if($player->IsValid()) {
                # Clean Values
                $player->Id = db_escape_string(trim($player->Id));
                $player->FirstName = db_escape_string(trim($player->FirstName));
                $player->LastName = db_escape_string(trim($player->LastName));
                $player->NFLTeam = db_escape_string(trim($player->NFLTeam));
                $player->Position = db_escape_string(trim($player->Position));
                $player->JerseyNumber = db_escape_string(trim($player->JerseyNumber));
                $player->BirthDayTimeStamp = db_escape_string(trim($player->BirthDayTimeStamp));
                $player->Height = db_escape_string(trim($player->Height));
                $player->Weight = db_escape_string(trim($player->Weight));
                $player->College = db_escape_string(trim($player->College));
                $player->DraftTeam = db_escape_string(trim($player->DraftTeam));
                $player->DraftYear = db_escape_string(trim($player->DraftYear));
                $player->DraftRound = db_escape_string(trim($player->DraftRound));
                $player->DraftPick = db_escape_string(trim($player->DraftPick));
                $player->FleaFlickerId = db_escape_string(trim($player->FleaFlickerId));
                $player->FanballId = db_escape_string(trim($player->FanballId));
                $player->CbsId = db_escape_string(trim($player->CbsId));
                $player->KfflId = db_escape_string(trim($player->KfflId));
                $player->SportsTickerId = db_escape_string(trim($player->SportsTickerId));
                $player->RotoworldIdRotoworldId = db_escape_string(trim($player->RotoworldId));
                $player->EspnId = db_escape_string(trim($player->EspnId));
                $player->StatsId = db_escape_string(trim($player->StatsId));
                $player->TwitterUserName = db_escape_string(trim($player->TwitterUserName));

                # Add to query string
                $query .= "("
                    . "'$player->Id','$player->FirstName','$player->LastName','$player->NFLTeam','$player->Position',"
                    . "'$player->JerseyNumber','$player->BirthDayTimeStamp','$player->Height','$player->Weight','$player->College','$player->DraftTeam',"
                    . "'$player->DraftYear','$player->DraftRound','$player->DraftPick','$player->FleaFlickerId',"
                    . "'$player->FanballId','$player->CbsId','$player->KfflId','$player->SportsTickerId','$player->RotoworldIdRotoworldId',"
                    . "'$player->EspnId','$player->StatsId','$player->TwitterUserName'"
                    . ")";
                
                $process_query = true;

                # Add comma if not last entry
                if($key != sizeof($players)-1) {
                    $query .= ",";
                }
            }
        endforeach;    
     

        if($process_query) {
            # Do Query
            db_query($query);  

            # Check for db error
            if(db_error_message()) {
                $error_message = "Database error: ".db_error_message();
                log_error($error_message);
                die($error_message);
            }    
        }
        
        log_info("submit_players_to_db() function complete");
        return true;
    }
    function submit_injuries_to_db($injuries) {
        log_info("submit_injuries_to_db() function called");
        
        $process_query = false;
        
        # Set Table Name
        $table_name = INJURIES_TABLE; 
            
        # Start building query string
         $query = "REPLACE INTO $table_name ("
                    . "player_id,status,details"
                    . ") VALUES ";
        
        # Check if input is an array
        if(!is_array($injuries)) {
            log_error("The input variable must be an array");
            return false;
        }
        if(sizeof($injuries) == 0) {
            log_error("No injuries to process");
            return false;
        }
        
        foreach($injuries as $key => $injury):
            if($injury->IsValid()) {
                # Clean Values
                $injury->PlayerId = db_escape_string(trim($injury->PlayerId));
                $injury->Status = db_escape_string(trim($injury->Status));
                $injury->Details = db_escape_string(trim($injury->Details));

                # Add to query string
                $query .= "("
                        . "'$injury->PlayerId','$injury->Status','$injury->Details'"
                        . ")";
                
                $process_query = true;

                # Add comma if not last entry
                if($key != sizeof($injuries)-1) {
                    $query .= ",";
                }                
            }
        endforeach;    

        if($process_query) {
            # Do Query
            db_query($query);  

            # Check for error
            if(db_error_message()) {
                $error_message = "Database error: ".db_error_message();
                log_error($error_message);
                die($error_message);
            }    
        }
        
        log_info("submit_injuries_to_db() function complete");
        return true;
    }
    function submit_roster_players_to_db($roster_players) {
        log_info("submit_roster_players_to_db() function called");
        
        $process_query = false;
        
        # Set Table Name
        $table_name = ROSTER_PLAYERS_TABLE; 
            
        # Start building query string
         $query = "REPLACE INTO $table_name ("
                    . "franchise_id,player_id,status"
                    . ") VALUES ";
         
        # Check if input is an array
        if(!is_array($roster_players)) {
            log_error("The input variable must be an array");
            return false;
        }
        if(sizeof($roster_players) == 0) {
            log_error("No roster players to process");
            return false;
        }
        
        # Clean inputs     
        foreach($roster_players as $key => $roster_player):
            if($roster_player->IsValid()) {
                # Clean Values
                $roster_player->FranchiseId = db_escape_string(trim($roster_player->FranchiseId));
                $roster_player->PlayerId = db_escape_string(trim($roster_player->PlayerId));
                $roster_player->Status = db_escape_string(trim($roster_player->Status));

                # Add to query string
                $query .= "("
                        . "'$roster_player->FranchiseId','$roster_player->PlayerId','$roster_player->Status'"
                        . ")";

                $process_query = true;

                # Add comma if not last entry
                if($key != sizeof($roster_players)-1) {
                    $query .= ",";
                }
            }
        endforeach;    

        if($process_query) {
            # Do Query
            db_query($query);  

            # Check for error
            if(db_error_message()) {
                $error_message = "Database error: ".db_error_message();
                log_error($error_message);
                die($error_message);
            }    
        }
        
        log_info("submit_roster_players_to_db() function complete");
        return true;
    }
    function submit_player_scores_to_db($player_scores) {
        log_info("submit_player_scores_to_db() function called");
        
        $process_query = false;
                
        # Set Table Name
        $table_name = PLAYER_SCORES_TABLE; 
            
        # Start building query string
        $query = "REPLACE INTO $table_name ("
                    . "unique_id,league_id,player_id,year,week,score"
                    . ") VALUES ";
        
        # Check if input is an array
        if(!is_array($player_scores)) {
            log_error("The input variable must be an array");
            return false;
        }
        if(sizeof($player_scores) == 0) {
            log_error("No player scores to process");
            return false;
        } 
         
        # Clean inputs      
        foreach($player_scores as $key => $player_score):
            # Clean Values
            $player_score->LeagueId = db_escape_string(trim($player_score->LeagueId));
            $player_score->PlayerId = db_escape_string(trim($player_score->PlayerId));
            $player_score->Year = db_escape_string(trim($player_score->Year));
            $player_score->Week = db_escape_string(trim($player_score->Week));
            $player_score->Score = db_escape_string(trim($player_score->Score));

            $unique_id = $player_score->LeagueId."-".$player_score->Year."-".$player_score->Week."-".$player_score->PlayerId;

            # Add to query string
            $query .= "("
                    . "'$unique_id','$player_score->LeagueId','$player_score->PlayerId','$player_score->Year','$player_score->Week','$player_score->Score'"
                    . ")";
            
            $process_query = true;
            
            # Add comma if not last entry
            if($key != sizeof($player_scores)-1) {
                $query .= ",";
            }
        endforeach;                
        
        if($process_query) {
            # Do Query
            db_query($query);  

            # Check for error
            if(db_error_message()) {
                $error_message = "Database error: ".db_error_message();
                log_error($error_message);
                die($error_message);
            }    
        }
        log_info("submit_player_scores_to_db() function complete");
        return true;
    }
    function submit_update_to_db($data_set) {
        
        log_info("submit_update_to_db() function called");
        
        # Clean input
        $data_set = db_escape_string(trim($data_set));
        
        # Set Table Name
        $table_name = DATA_UPDATES_TABLE; 
            
        # Start building query string
         $query = "REPLACE INTO $table_name ("
                    . "data_set,updated_datetime"
                    . ") VALUES ('$data_set',NOW())";
        
        # Do Query
        db_query($query);  

        # Check for error
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }    
        
        log_info("submit_update_to_db() function complete");
        return true;
    }
    function submit_free_agents_to_db($free_agents) {
        log_info("submit_free_agents_to_db() function called");
        
        $process_query = false;
        
        # Set Table Name
        $table_name = FREE_AGENTS_TABLE; 
            
        # Start building query string
         $query = "REPLACE INTO $table_name ("
                    . "id"
                    . ") VALUES ";
        
        # Check if input is an array
        if(!is_array($free_agents)) {
            log_error("The input variable must be an array");
            return false;
        }
        if(sizeof($free_agents) == 0) {
            log_error("No free agents to process");
            return false;
        }
        
        foreach($free_agents as $key => $free_agent):
            if($free_agent->IsValid()) {
                # Clean Values
                $free_agent->Id = db_escape_string(trim($free_agent->Id));

                # Add to query string
                $query .= "("
                        . "'$free_agent->Id'"
                        . ")";
                
                $process_query = true;

                # Add comma if not last entry
                if($key != sizeof($free_agents)-1) {
                    $query .= ",";
                }                
            }
        endforeach;    

        if($process_query) {
            # Do Query
            db_query($query);  

            # Check for error
            if(db_error_message()) {
                $error_message = "Database error: ".db_error_message();
                log_error($error_message);
                die($error_message);
            }    
        }
        
        log_info("submit_free_agents_to_db() function complete");
        return true;
    }
    function submit_draft_results_to_db($draft_results) {
        log_info("submit_draft_results_to_db() function called");
        
        $process_query = false;
        
        # Set Table Name
        $table_name = DRAFT_RESULTS_TABLE; 
            
        # Start building query string
         $query = "INSERT INTO $table_name ("
                    . "round,pick,franchise_id,player_id,comments,timestamp"
                    . ") VALUES ";
        
        # Check if input is an array
        if(!is_array($draft_results)) {
            log_error("The input variable must be an array");
            return false;
        }
        if(sizeof($draft_results) == 0) {
            log_error("No draft results to process");
            return false;
        }
        
        foreach($draft_results as $key => $draft_result):
            if($draft_result->IsValid()) {
                # Clean Values
                $draft_result->FranchiseId = db_escape_string(trim($draft_result->FranchiseId));
                $draft_result->Round = db_escape_string(trim($draft_result->Round));
                $draft_result->Pick = db_escape_string(trim($draft_result->Pick));
                $draft_result->PlayerId = db_escape_string(trim($draft_result->PlayerId));
                $draft_result->Comments = db_escape_string(trim($draft_result->Comments));
                $draft_result->Timestamp = db_escape_string(trim($draft_result->Timestamp));
                # Add to query string
                $draft_result->Timestamp = date('Y-m-d H:i:s',$draft_result->Timestamp);
                $query .= "("                        
                        . "'$draft_result->Round',"
                        . "'$draft_result->Pick',"
                        . "'$draft_result->FranchiseId',"
                        . "'$draft_result->PlayerId',"
                        . "'$draft_result->Comments',"
                        . "'$draft_result->Timestamp'"
                        . ")";
                
                $process_query = true;

                # Add comma if not last entry
                if($key != sizeof($draft_results)-1) {
                    $query .= ",";
                }                
            }
        endforeach;    

        if($process_query) {
            # Do Query
            db_query($query);  

            # Check for error
            if(db_error_message()) {
                $error_message = "Database error: ".db_error_message();
                log_error($error_message);
                die($error_message);
            }    
        }
        
        log_info("submit_draft_results_to_db() function complete");
        return true;
    }
    
    # Table clearing
    function clear_league_table() {
        log_info("clear_league_table() function called");
        clear_db_table(LEAGUE_TABLE);
        log_info("clear_league_table() function complete");
    }
    function clear_divisions_table() {
        log_info("clear_divisions_table() function called");
        clear_db_table(DIVISIONS_TABLE);
        log_info("clear_divisions_table() function complete");
    }
    function clear_franchises_table() {
        log_info("clear_franchises_table() function called");
        clear_db_table(FRANCHISES_TABLE);
        log_info("clear_franchises_table() function complete");
    }
    function clear_players_table() {
        log_info("clear_players_table() function called");
        clear_db_table(PLAYERS_TABLE);
        log_info("clear_players_table() function complete");
    }
    function clear_injuries_table() {
        log_info("clear_injuries_table() function called");
        clear_db_table(INJURIES_TABLE);
        log_info("clear_injuries_table() function complete");
    }
    function clear_roster_players_table() {
        log_info("clear_roster_players_table() function called");
        clear_db_table(ROSTER_PLAYERS_TABLE);
        log_info("clear_roster_players_table() function complete");
    }
    function clear_player_scores_table() {
        log_info("clear_player_scores_table() function called");
        clear_db_table(PLAYER_SCORES_TABLE);
        log_info("clear_player_scores_table() function complete");
    }
    function clear_free_agents_table() {
        log_info("clear_free_agents_tabl() function called");
        clear_db_table(FREE_AGENTS_TABLE);
        log_info("clear_free_agents_tabl() function complete");
    }
    function clear_draft_results_table() {
        log_info("clear_draft_results_table() function called");
        clear_db_table(DRAFT_RESULTS_TABLE);
        log_info("clear_draft_results_table() function complete");
    }
    
    # Heartbeats    
    function does_franchise_heartbeat_exist($franchise_id) {
        log_info("does_franchise_heartbeat_exist() function called");
        
        # Clean inputs
        $franchise_id = db_escape_string(trim($franchise_id));  
    
        # Run Query
        $table_name = FRANCHISE_HEARTBEAT_TABLE;
        $query = "SELECT id FROM $table_name WHERE franchise_id='$franchise_id'";
        $result = db_query($query);

        # Check for db error
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }

        # Check
        if(sizeof($result) < 1) {
            log_info("does_franchise_heartbeat_exist() function complete");
            return false;
        }
        log_info("does_franchise_heartbeat_exist() function complete");
        return true;
    }
    function does_admin_heartbeat_exist() {
        log_info("does_admin_heartbeat_exist() function called");
        
        # Run Query
        $table_name = ADMIN_HEARTBEAT_TABLE;
        $query = "SELECT id FROM $table_name WHERE id='1'";
        $result = db_query($query);

        # Check for db error
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }

        # Check
        if(sizeof($result) < 1) {
            log_info("does_admin_heartbeat_exist() function complete");
            return false;
        }
        log_info("does_admin_heartbeat_exist() function complete");
        return true;
    }
    
    # Watch List
    function get_current_sort_order_number($franchise_id,$player_id) {
        log_info("get_highest_sort_order_number() function called");
        $franchise_id = db_escape_string(trim($franchise_id));
        $player_id = db_escape_string(trim($player_id));
        
        $table_name = WATCHED_PLAYERS_TABLE;
        $query = "SELECT sort_order FROM $table_name WHERE franchise_id = '$franchise_id' AND player_id = '$player_id'"; 
        
        db_query($query);
        
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }
        $result = db_get_single_result();

        log_info("get_highest_sort_order_number() function complete");
        if(!$result['sort_order']) { 
            return 0;
        }
        return (int)$result['sort_order'];
    }
    function get_highest_sort_order_number($franchise_id) {
        log_info("get_highest_sort_order_number() function called");
        $franchise_id = db_escape_string(trim($franchise_id));
        
        $table_name = WATCHED_PLAYERS_TABLE;
        $query = "SELECT sort_order FROM $table_name WHERE franchise_id = '$franchise_id' ORDER BY sort_order DESC LIMIT 1"; 
        
        db_query($query);
        
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }
        $result = db_get_single_result();

        log_info("get_highest_sort_order_number() function complete");
        if(!$result['sort_order']) { 
            return 0;
        }
        return (int)$result['sort_order'];
    }
    function get_watched_player_ids($franchise_id) {
        log_info("get_watch_list_player_ids() function called");
        
        # Clean inputs
        $franchise_id = db_escape_string(trim($franchise_id));  
        
        # Set Table Name
        $table_name = WATCHED_PLAYERS_TABLE;

        $query = "SELECT player_id FROM $table_name WHERE franchise_id='$franchise_id'";

        db_query($query);
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }
        $results = db_get_result_array();

        $return_array = array();
        foreach($results as $result) {
           $return_array[] = $result['player_id'];      
        }
        log_info("get_watch_list_player_ids() function complete");
        return $return_array;
    }
    function get_watched_players($franchise_id) {
        log_info("get_watch_list_player_ids() function called");
        
        # Clean inputs
        $franchise_id = db_escape_string(trim($franchise_id));  
        
        # Set Table Name
        $table_name = WATCHED_PLAYERS_TABLE;

        $query = "SELECT * FROM $table_name WHERE franchise_id='$franchise_id'";

        db_query($query);
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }
        $results = db_get_result_array();

        log_info("get_watch_list_player_ids() function complete");
        return $results;
    }
    function does_watch_player_exist($franchise_id, $player_id) {
        log_info("does_watch_player_exist() function called");
         
        $franchise_id = db_escape_string(trim($franchise_id));
        $player_id = db_escape_string(trim($player_id));
        
        $table_name = WATCHED_PLAYERS_TABLE;
        $query = "SELECT * FROM $table_name WHERE franchise_id='$franchise_id' AND player_id='$player_id'";
        $result = db_query($query);
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }
        if(sizeof($result) < 1) {
            log_info("does_watch_player_exist() function complete");
            return false;
        }
        log_info("does_watch_player_exist() function complete");
        return true;
    }
    function add_player_id_to_watch_list($franchise_id, $player_id) {
        log_info("add_player_to_watch_list() function called");
        
        $franchise_id = db_escape_string(trim($franchise_id));
        $player_id = db_escape_string(trim($player_id));
        
        $next_sort_number = get_highest_sort_order_number($franchise_id) + 1;
        if(!does_watch_player_exist($franchise_id, $player_id)) {
            $table_name = WATCHED_PLAYERS_TABLE;
            $query = "INSERT INTO $table_name (franchise_id,player_id,sort_order) values ('$franchise_id','$player_id','$next_sort_number')";	

            db_query($query);    
            if(db_error_message()) {
                $error_message = "Database error: ".db_error_message();
                log_error($error_message);
                die($error_message);
            }
        }
        log_info("add_player_to_watch_list() function complete");
        return true;
    }
    function remove_player_id_from_watch_list($franchise_id, $player_id) {
        log_info("add_player_to_watch_list() function called");
        
        $franchise_id = db_escape_string(trim($franchise_id));
        $player_id = db_escape_string(trim($player_id));
        
        $current_sort_order = get_current_sort_order_number($franchise_id,$player_id);
        
        if(does_watch_player_exist($franchise_id, $player_id)) {
            $table_name = WATCHED_PLAYERS_TABLE;
            $first_query = "DELETE FROM $table_name WHERE franchise_id='$franchise_id' AND player_id='$player_id'";	

            db_query($first_query);    
            if(db_error_message()) {
                $error_message = "Database error: ".db_error_message();
                log_error($error_message);
                die($error_message);
            }
            
            $second_query = "UPDATE $table_name SET sort_order = sort_order - 1 WHERE franchise_id='$franchise_id' AND sort_order > '$current_sort_order'";	

            db_query($second_query);    
            if(db_error_message()) {
                $error_message = "Database error: ".db_error_message();
                log_error($error_message);
                die($error_message);
            }
        }
        log_info("add_player_to_watch_list() function complete");
        return true;
    }
    function set_watched_player_id_sort_order($franchise_id,$player_id,$sort_order) {
        log_info("set_watched_player_id_sort_order() function called");
        
        # Clean inputs
        $franchise_id = db_escape_string(trim($franchise_id));  
        $player_id = db_escape_string(trim($player_id));  
        $sort_order = db_escape_string(trim($sort_order));  
        
        #Set Table Name
        $table_name = WATCHED_PLAYERS_TABLE;
        
        $highest_sort_number = get_highest_sort_order_number($franchise_id);

        if($sort_order < 1) { 
            log_error("Invalid sort order of $sort_order.  Too Low");
            return false;
        }
        if($sort_order > $highest_sort_number) {
            log_error("Invalid sort order of $sort_order.  Higher than highest");
            return false;
        }
        
        $current_sort_order = get_current_sort_order_number($franchise_id,$player_id);
        if($sort_order == $current_sort_order) {
            log_info("Invalid sort order of $sort_order.  Same as current");
            return true;
        }
               
        if(does_watch_player_exist($franchise_id, $player_id)) {               
            $first_query = "UPDATE $table_name SET sort_order = '$sort_order' WHERE franchise_id='$franchise_id' AND player_id='$player_id'";
            if($sort_order > $current_sort_order) {            
                $second_query = "UPDATE $table_name SET sort_order = sort_order - 1 WHERE franchise_id='$franchise_id' AND player_id != '$player_id' AND sort_order > '$current_sort_order' AND sort_order <= '$sort_order'";
            } else {
                $second_query = "UPDATE $table_name SET sort_order = sort_order + 1 WHERE franchise_id='$franchise_id' AND player_id != '$player_id' AND sort_order < '$current_sort_order' AND sort_order >= '$sort_order'";
            }
            # Perform Query
            db_query($first_query);  

            # Check for db error
            if(db_error_message()) {
                $error_message = "Database error: ".db_error_message();
                log_error($error_message);
                die($error_message);
            }    
            
            # Perform Query
            db_query($second_query);  

            # Check for db error
            if(db_error_message()) {
                $error_message = "Database error: ".db_error_message();
                log_error($error_message);
                die($error_message);
            }             
        }

        # Perform Query
        db_query($query);  

        # Check for db error
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }    
        log_info("set_watched_player_id_sort_order() function complete");
        return true;
    }
    
    
    function move_watched_player_to_top($franchise_id,$player_id) {
        log_info("move_watched_player_to_first() function called");
        
        # Clean inputs
        $franchise_id = db_escape_string(trim($franchise_id));  
        $player_id = db_escape_string(trim($player_id));  
        set_watched_player_id_sort_order($franchise_id,$player_id,1);        
        
        log_info("move_watched_player_to_first() function complete");
        return true;
    }    
    function move_watched_player_to_bottom($franchise_id,$player_id) {
        log_info("move_watched_player_to_last() function called");
        
        # Clean inputs
        $franchise_id = db_escape_string(trim($franchise_id));  
        $player_id = db_escape_string(trim($player_id));  
        
        $highest_sort_number = get_highest_sort_order_number($franchise_id);
        set_watched_player_id_sort_order($franchise_id,$player_id,$highest_sort_number);        
        
        log_info("move_watched_player_to_last() function complete");
        return true;
    }
    function move_watched_player_down($franchise_id,$player_id) {
        log_info("move_watched_player_to_last() function called");
        
        # Clean inputs
        $franchise_id = db_escape_string(trim($franchise_id));  
        $player_id = db_escape_string(trim($player_id));  
        
        $current_sort_number = get_current_sort_order_number($franchise_id,$player_id);
        
        set_watched_player_id_sort_order($franchise_id,$player_id,$current_sort_number + 1);        
        
        log_info("move_watched_player_to_last() function complete");
        return true;
    }    
    function move_watched_player_up($franchise_id,$player_id) {
        log_info("move_watched_player_to_last() function called");
        
        # Clean inputs
        $franchise_id = db_escape_string(trim($franchise_id));  
        $player_id = db_escape_string(trim($player_id));  
        
        $current_sort_number = get_current_sort_order_number($franchise_id,$player_id);
        
        set_watched_player_id_sort_order($franchise_id,$player_id,$current_sort_number - 1);        
        
        log_info("move_watched_player_to_last() function complete");
        return true;
    }
    
    # Other Functions
    function does_player_id_exist($player_id) {
        log_info("does_player_id_exist() function called");
         
        $player_id = db_escape_string(trim($player_id));
        
        $table_name = PLAYERS_TABLE;
        $query = "SELECT * FROM $table_name WHERE id='$player_id'";
        $result = db_query($query);
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }
        if(sizeof($result) < 1) {
            log_info("does_player_id_exist() function complete");
            return false;
        }
        log_info("does_player_id_exist() function complete");
        return true;
    }
    function does_franchise_id_exist($franchise_id) {
        log_info("does_franchise_id_exist() function called");
         
        $franchise_id = db_escape_string(trim($franchise_id));
        
        $table_name = FRANCHISES_TABLE;
        $query = "SELECT * FROM $table_name WHERE id='$franchise_id'";
        $result = db_query($query);
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }
        if(sizeof($result) < 1) {
            log_info("does_franchise_id_exist() function complete");
            return false;
        }
        log_info("does_franchise_id_exist() function complete");
        return true;
    }
    
    # Helper Functions
    function get_age($birth){
        if($birth == 0) {
            return null;
        }
	$t = time();
	$age = ($birth < 0) ? ( $t + ($birth * -1) ) : $t - $birth;
	return floor($age/31536000);
    }
    
    
    function xml_to_array($xml, $options = array()) {
        $defaults = array(
            'namespaceSeparator' => ':',//you may want this to be something other than a colon
            'attributePrefix' => '@',   //to distinguish between attributes and nodes with the same name
            'alwaysArray' => array(),   //array of xml tag names which should always become arrays
            'autoArray' => true,        //only create arrays for tags which appear more than once
            'textContent' => '$',       //key used for the text content of elements
            'autoText' => true,         //skip textContent key if node has no attributes or child nodes
            'keySearch' => false,       //optional search and replace on tag and attribute names
            'keyReplace' => false       //replace values for above search values (as passed to str_replace())
        );
        $options = array_merge($defaults, $options);
        $namespaces = $xml->getDocNamespaces();
        $namespaces[''] = null; //add base (empty) namespace

        //get attributes from all namespaces
        $attributesArray = array();
        foreach ($namespaces as $prefix => $namespace) {
            foreach ($xml->attributes($namespace) as $attributeName => $attribute) {
                //replace characters in attribute name
                if ($options['keySearch']) $attributeName =
                        str_replace($options['keySearch'], $options['keyReplace'], $attributeName);
                $attributeKey = $options['attributePrefix']
                        . ($prefix ? $prefix . $options['namespaceSeparator'] : '')
                        . $attributeName;
                $attributesArray[$attributeKey] = (string)$attribute;
            }
        }

        //get child nodes from all namespaces
        $tagsArray = array();
        foreach ($namespaces as $prefix => $namespace) {
            foreach ($xml->children($namespace) as $childXml) {
                //recurse into child nodes
                $childArray = xmlToArray($childXml, $options);
                list($childTagName, $childProperties) = each($childArray);

                //replace characters in tag name
                if ($options['keySearch']) $childTagName =
                        str_replace($options['keySearch'], $options['keyReplace'], $childTagName);
                //add namespace prefix, if any
                if ($prefix) $childTagName = $prefix . $options['namespaceSeparator'] . $childTagName;

                if (!isset($tagsArray[$childTagName])) {
                    //only entry with this key
                    //test if tags of this type should always be arrays, no matter the element count
                    $tagsArray[$childTagName] =
                            in_array($childTagName, $options['alwaysArray']) || !$options['autoArray']
                            ? array($childProperties) : $childProperties;
                } elseif (
                    is_array($tagsArray[$childTagName]) && array_keys($tagsArray[$childTagName])
                    === range(0, count($tagsArray[$childTagName]) - 1)
                ) {
                    //key already exists and is integer indexed array
                    $tagsArray[$childTagName][] = $childProperties;
                } else {
                    //key exists so convert to integer indexed array with previous value in position 0
                    $tagsArray[$childTagName] = array($tagsArray[$childTagName], $childProperties);
                }
            }
        }

        //get text content of node
        $textContentArray = array();
        $plainText = trim((string)$xml);
        if ($plainText !== '') $textContentArray[$options['textContent']] = $plainText;

        //stick it all together
        $propertiesArray = !$options['autoText'] || $attributesArray || $tagsArray || ($plainText === '')
                ? array_merge($attributesArray, $tagsArray, $textContentArray) : $plainText;

        //return node as array
        return array(
            $xml->getName() => $propertiesArray
        );
    }
    
    ####################
    #  TEST FUNCTIONS  #
    ####################
    // Internal
    function remove_player_id_from_free_agents($player_id) {
        log_info("remove_player_id_from_free_agents() function called");
        
        $player_id = db_escape_string(trim($player_id));

        $table_name = WATCHED_PLAYERS_TABLE;
        $query = "DELETE FROM $table_name WHERE player_id='$player_id'";	

        db_query($query);    
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }
        
        log_info("remove_player_id_from_free_agents() function complete");
        return true;
    }
    
    function can_player_be_drafted($player_id) {
        log_info("is_player_id_a_free_agent() function called");
         
        $player_id = db_escape_string(trim($player_id));
        
        $table_name = FREE_AGENTS_TABLE;
        $query = "SELECT * FROM $table_name WHERE id='$player_id'";
        $result = db_query($query);
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }
        if(sizeof($result) < 1) {
            log_info("is_player_id_a_free_agent() function complete");
            return false;
        }
        log_info("is_player_id_a_free_agent() function complete");
        return true;
    }
    function can_franchise_draft($round, $pick, $franchise_id) {
        log_info("can_franchise_draft() function called");
        
        $round = db_escape_string(trim($round));
        $pick = db_escape_string(trim($pick));
        $franchise_id = db_escape_string(trim($franchise_id));
        
        $table_name = DRAFT_RESULTS_TABLE;
        $query = "SELECT * FROM $table_name WHERE round='$round' AND pick='$pick'";
        db_query($query);
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }
        $result = db_get_single_result();
        if(sizeof($result) < 1) {
            log_info("can_franchise_draft() function complete");
            return false;
        }
        if((int)$result['player_id'] != 0 || (int)$result['timestamp'] != 0) {
            log_error("draft pick has already been performed for round = $round / pick = $pick!");
            return false;
        }
        if((int)$result['franchise_id'] != (int)$franchise_id) {
            log_error("Franchise = $franchise_id can't draft at round = $round / pick = $pick!");
            return false;
        }
        log_info("can_franchise_draft() function complete");
        return true;
    }
    function get_last_pick_id() {
        log_info("get_last_pick_id() function called");
        
        $table_name = DRAFT_RESULTS_TABLE;
        $query = "SELECT * FROM $table_name WHERE timestamp IN (SELECT MAX(timestamp) FROM $table_name)"; 
        
        db_query($query);
        
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }
        $result = db_get_single_result();

        log_info("get_last_pick_id() function complete");
        
        if((int)$result['timestamp'] == 0) {
            return 0;
        }
        return (int)$result['id'];
    }
    function get_last_pick_timestamp() {
        log_info("get_last_pick_timestamp() function called");

        $table_name = DRAFT_RESULTS_TABLE;
        $query = "SELECT * FROM $table_name WHERE timestamp IN (SELECT MAX(timestamp) FROM $table_name)"; 
        
        db_query($query);
        
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }
        $result = db_get_single_result();
        $new_time = date( "Y-m-d H:i:s", strtotime($result['timestamp'])+ (DRAFT_TIMESTAMP_OFFSET*60*60) );
        //die("old = ".$result['timestamp']." / new = ".$new_time);
        log_info("get_last_pick_timestamp() function complete");
        return $new_time;
        //return $result['timestamp'];
    }
    function remove_free_agent($player_id) {
        log_info("remove_free_agent() function called");
        
        $player_id = db_escape_string(trim($player_id));

        $table_name = FREE_AGENTS_TABLE;
        $query = "DELETE FROM $table_name WHERE id='$player_id'";	

        db_query($query);    
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            return false;
        }
        
        log_info("remove_free_agent() function complete");
        return true;
    }
    function draft_player_using_db($round, $pick, $franchise_id, $player_id) {
        log_info("draft_player() function called");
        
        $round = db_escape_string(trim($round));
        $pick = db_escape_string(trim($pick));
        $franchise_id = db_escape_string(trim($franchise_id));
        $player_id = db_escape_string(trim($player_id));

        $pick_id = get_pick_id($round, $pick);
        
        $table_name = DRAFT_RESULTS_TABLE;
        //$query = "UPDATE $table_name SET player_id='$player_id',timestamp=ADDTIME( curtime(4) , '03:00:00' ),comments='TEST DRAFT!' WHERE id='$pick_id'";	
        $query = "UPDATE $table_name SET player_id='$player_id',timestamp=NOW(),comments='TEST DRAFT!' WHERE id='$pick_id'";
        db_query($query);    
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }
              
        log_info("draft_player() function complete");
        return true;        
    }
    function get_current_pick_details($offset = 0) {
        log_info("get_last_pick_id() function called");
        
        $current_pick_id = (int)get_last_pick_id() + 1 + (int)$offset;
        
        $table_name = DRAFT_RESULTS_TABLE;
        $query = "SELECT * FROM $table_name WHERE id='$current_pick_id'"; 
        
        db_query($query);
        
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }
        $result = db_get_single_result();

        log_info("get_last_pick_id() function complete");
        return $result;        
    }
    function is_pick_current($round, $pick) {
        log_info("is_pick_current() function called");
        
        $round = db_escape_string(trim($round));
        $pick = db_escape_string(trim($pick));
        
        $table_name = DRAFT_RESULTS_TABLE;
        $query = "SELECT * FROM $table_name WHERE round='$round' AND pick='$pick'";
        $result = db_query($query);
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }
        if(sizeof($result) < 1) {
            log_info("can_franchise_draft() function complete");
            return false;
        }
        if((int)$result['player_id'] != 0 || (int)$result['timestamp'] != 0) {
            log_error("draft pick has already been performed for round = $round / pick = $pick!");
            return false;
        }
        if((int)$result['franchise_id'] != (int)$franchise_id) {
            log_error("Franchise = $franchise_id can't draft at round = $round / pick = $pick!");
            return false;
        }
        log_info("can_franchise_draft() function complete");
        return true;
    }
    function get_pick_id($round, $pick) {
        log_info("get_pick_id() function called");
        
        $round = db_escape_string(trim($round));
        $pick = db_escape_string(trim($pick));
        
        $table_name = DRAFT_RESULTS_TABLE;
        $query = "SELECT id FROM $table_name WHERE round='$round' AND pick='$pick'"; 
        
        db_query($query);
        
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }
        $result = db_get_single_result();

        log_info("get_pick_id() function complete");
        return (int)$result['id'];
    }
    function get_franchise($franchise_id) {
        log_info("get_franchise() function called");
        
        $franchise_id = db_escape_string(trim($franchise_id));
        
        $table_name = FRANCHISES_TABLE;
        $query = "SELECT * FROM $table_name WHERE id='$franchise_id'"; 
        
        db_query($query);
        
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }
        $result = db_get_single_result();

        log_info("get_franchise() function complete");
        return $result;
    }
    
    function get_last_data_updates() {
        log_info("get_last_data_updates() function called");
        
        # Set Table Name
        $table_name = DATA_UPDATES_TABLE;

        # Build Query
        $query = "SELECT * FROM $table_name";
        
        # Do Query
        db_query($query);

        # Check for db error
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }    
        
        log_info("get_last_data_updates() function complete");
        
        return db_get_result_array();
    }

    # Notifications
    function SendDraftStartNotification() {
    $title = "The ".MFL_YEAR." draft has started!";
    $message = "You will receive a text and email notification when you are on the clock!";
    $headers = "From: DRAFTER@goallinegridiron.com\r\n";
    
    $franchises = GetNotificationFranchises();
    $email_to_address_string = '';
    $text_to_address_string = '';
    foreach($franchises as $franchise) {
        $email_to_address_string .= $franchise['email_address'].',';
        $text_to_address_string .= $franchise['phone_address'].',';
    }
    
    log_special("SendDraftStartNotifications - Email To: ".$email_to_address_string.", Text To: ".$text_to_address_string.", Title: ".$title.", Message: ".$message);

    $email_success = true;
    $text_success = true;
    
    if(SEND_NOTIFICATION_EMAILS) {
        log_special("SendDraftStartNotifications - Trying to send Emails...");
        $email_success = mail($email_to_address_string, $title, $message, $headers);
        if($email_success) {
            log_special("SendDraftStartNotifications - Emails sent successfully!");
        } else {
            log_special("SendDraftStartNotifications - Emails failed to send!");
        }
    } else {
        log_special("SendDraftStartNotifications - SEND_NOTIFICATION_EMAILS = false");
    }
    if(SEND_NOTIFICATION_TEXTS) {
        $text_success = mail($text_to_address_string, $title, $message, $headers);
        log_special("SendDraftStartNotifications - Trying to send Texts...");
        if($text_success) {
            log_special("SendDraftStartNotifications - Text sent successfully!");
        } else {
            log_special("SendDraftStartNotifications - Text failed to send!");
        }
    } else {
        log_special("SendDraftStartNotifications - SEND_NOTIFICATION_TEXTS = false");
    }
    if($email_success && $text_success) {
        return true;   
    } else {
        return false;
    }
}
    function SendDraftStopNotification() {
        $title = "The ".MFL_YEAR." draft has stopped!";
        $message = "You will receive text and email notificationa when the draft starts!";
        $headers = "From: DRAFTER@goallinegridiron.com\r\n";

        $franchises = GetNotificationFranchises();
        $email_to_address_string = '';
        $text_to_address_string = '';
        foreach($franchises as $franchise) {
            $email_to_address_string .= $franchise['email_address'].',';
            $text_to_address_string .= $franchise['phone_address'].',';
        }

        log_special("SendDraftStopNotification - Email To: ".$email_to_address_string.", Text To: ".$text_to_address_string.", Title: ".$title.", Message: ".$message);

        $email_success = true;
        $text_success = true;

        if(SEND_NOTIFICATION_EMAILS) {
            log_special("SendDraftStopNotification - Trying to send Emails...");
            $email_success = mail($email_to_address_string, $title, $message, $headers);
            if($email_success) {
                log_special("SendDraftStopNotification - Emails sent successfully!");
            } else {
                log_special("SendDraftStopNotification - Emails failed to send!");
            }
        } else {
            log_special("SendDraftStopNotification - SEND_NOTIFICATION_EMAILS = false");
        }
        if(SEND_NOTIFICATION_TEXTS) {
            $text_success = mail($text_to_address_string, $title, $message, $headers);
            log_special("SendDraftStopNotification - Trying to send Texts...");
            if($text_success) {
                log_special("SendDraftStopNotification - Text sent successfully!");
            } else {
                log_special("SendDraftStopNotification - Text failed to send!");
            }
        } else {
            log_special("SendDraftStopNotification - SEND_NOTIFICATION_TEXTS = false");
        }
        if($email_success && $text_success) {
            return true;   
        } else {
            return false;
        }
    }
    function SendDraftPickNotification() {
        $last_pick_details = get_current_pick_details(-1);
        $current_pick_details = get_current_pick_details();

        $drafted_franchise = get_franchise($last_pick_details['franchise_id']);
        $drafted_player_array = get_players(array($last_pick_details['player_id']));
        $drafted_player = $drafted_player_array[0];
        $drafted_player_name = $drafted_player['first_name'].' '.$drafted_player['last_name'].', '.$drafted_player['position'].', '.$drafted_player['team'];
        $drafted_franchise_name = $drafted_franchise['name'];

        $title = "A draft selection has been made!";
        $title_on_the_clock = "You are on the clock!";
        $message = "The $drafted_franchise_name have drafted $drafted_player_name.";
        $message_on_the_clock = "The $drafted_franchise_name have drafted $drafted_player_name.  You are now on the clock!";
        $headers = "From: DRAFTER@goallinegridiron.com\r\n";

        $franchises = GetNotificationFranchises();

        $email_to_address_string = '';
        $text_to_address_string = '';
        foreach($franchises as $franchise) {
            $email_to_address_string .= $franchise['email_address'].',';
            if((int)$franchise['franchise_id'] == (int)$current_pick_details['franchise_id']) {
                $text_to_address_string = $franchise['phone_address'];
            }
        }

        log_special("SendDraftPickNotifications - Email To: ".$email_to_address_string.", Text To: ".$text_to_address_string.", Title: ".$title.", Email Message: ".$message.", Text Message: ".$message_on_the_clock);

        $email_success = true;
        $text_success = true;

        if(SEND_NOTIFICATION_EMAILS) {
            log_special("SendDraftPickNotifications - Trying to send Emails...");
            $email_success = mail($email_to_address_string, $title, $message, $headers);
            if($email_success) {
                log_special("SendDraftPickNotifications - Emails sent successfully!");
            } else {
                log_special("SendDraftPickNotifications - Emails failed to send!");
            }
        } else {
            log_special("SendDraftPickNotifications - SEND_NOTIFICATION_EMAILS = false");
        }
        if(SEND_NOTIFICATION_TEXTS) {
            $text_success = mail($text_to_address_string, $title_on_the_clock, $message_on_the_clock, $headers);
            log_special("SendDraftPickNotifications - Trying to send Texts...");
            if($text_success) {
                log_special("SendDraftPickNotifications - Text sent successfully!");
            } else {
                log_special("SendDraftPickNotifications - Text failed to send!");
            }
        } else {
            log_special("SendDraftPickNotifications - SEND_NOTIFICATION_TEXTS = false");
        }
        if($email_success && $text_success) {
            return true;   
        } else {
            return false;
        }
    }
    function SendTestNotification() {
        $title = "This is just a test!";
        $message = "Test Message";
        $headers = "From: DRAFTER@goallinegridiron.com\r\n";

        $franchises = GetNotificationFranchises();

        $email_to_address_string = '';
        $text_to_address_string = '';
        foreach($franchises as $franchise) {
            $email_to_address_string .= $franchise['email_address'].',';
            $text_to_address_string .= $franchise['phone_address'].',';
        }

        log_special("SendTestNotification - Email To: ".$email_to_address_string.", Text To: ".$text_to_address_string.", Title: ".$title.", Message: ".$message);

        $email_success = true;
        $text_success = true;

        if(SEND_NOTIFICATION_EMAILS) {
            log_special("SendTestNotification - Trying to send Emails...");
            $email_success = mail($email_to_address_string, $title, $message, $headers);
            if($email_success) {
                log_special("SendTestNotification - Emails sent successfully!");
            } else {
                log_special("SendTestNotification - Emails failed to send!");
            }
        } else {
            log_special("SendTestNotification - SEND_NOTIFICATION_EMAILS = false");
        }
        if(SEND_NOTIFICATION_TEXTS) {
            $text_success = mail($text_to_address_string, $title, $message, $headers);
            log_special("SendTestNotification - Trying to send Texts...");
            if($text_success) {
                log_special("SendTestNotification - Text sent successfully!");
            } else {
                log_special("SendTestNotification - Text failed to send!");
            }
        } else {
            log_special("SendTestNotification - SEND_NOTIFICATION_TEXTS = false");
        }
        if($email_success && $text_success) {
            return true;   
        } else {
            return false;
        }
    }

    function GetNotificationFranchises() {
    // Generate Franchise Array
    $franchises = array();
    
    // 0001
    $franchises[] = array(
        'franchise_id' => '0001',
        'name' => 'Brent Adkins',
        'email_address' => 'xmarine365@gmail.com',
        'phone_address' => '4439030154@vtext.com'
    );
    // 0002
    $franchises[] = array(
        'franchise_id' => '0002',
        'name' => 'Greg Sypolt',
        'email_address' => 'sypolt@gmail.com',
        'phone_address' => '9728241110@txt.att.net'
    );
    // 0003
    $franchises[] = array(
        'franchise_id' => '0003',
        'name' => 'Isidoro Pulido',
        'email_address' => 'lolopulido@hotmail.com',
        'phone_address' => '4694080726@txt.att.net'
    );
    // 0004
    $franchises[] = array(
        'franchise_id' => '0004',
        'name' => 'Matt Dietz',
        'email_address' => 'mdietz529@yahoo.com',
        'phone_address' => '4438076529@vtext.com'
    );
    // 0005
    $franchises[] = array(
        'franchise_id' => '0005',
        'name' => 'Pete Burke',
        'email_address' => 'pjburke7@gmail.com',
        'phone_address' => '4437528910@txt.att.net'
    );
    // 0006
    $franchises[] = array(
        'franchise_id' => '0006',
        'name' => 'Greg Bush',
        'email_address' => 'gbusch66@gmail.com',
        'phone_address' => '4436290230@vtext.com'
    );
    // 0007
    $franchises[] = array(
        'franchise_id' => '0007',
        'name' => 'Dan Knorpp',
        'email_address' => 'dan.knorpp@Gmail.com',
        'phone_address' => '3045946344@txt.att.net'
    );
    // 0008
    $franchises[] = array(
        'franchise_id' => '0008',
        'name' => 'Wally Booker',
        'email_address' => 'sgtbook@gmail.com',
        'phone_address' => '9376898050@vtext.com'
    );
    // 0009
    $franchises[] = array(
        'franchise_id' => '0009',
        'name' => 'Greg Smyth',
        'email_address' => 'gregsmythwvu@gmail.com',
        'phone_address' => '7245038777@txt.att.net'
    );
    // 0010
    $franchises[] = array(
        'franchise_id' => '0010',
        'name' => 'Jason Hoy',
        'email_address' => 'jhoy74@gmail.com',
        'phone_address' => '6144066556@vtext.com'
    );
    return $franchises;
}