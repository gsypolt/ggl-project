<?php
require_once 'core.php';

log_info("Initialization Requested");

$force = gpc_get_bool('force');

if(is_initialized() && !$force) {
    log_info("ALREADY INITIALIZED");
} else {
    if($force) {
        log_info("FORCED INITIALIZATION");
    }
    # TABLES
    log_info("Creating Tables");
    log_info('Creating admin heartbeat table');
    if(create_admin_heartbeat_table()) { log_info('SUCCESS'); } else { log_info('**FAILED**'); }
    log_info('Creating franchise heartbeat table');
    if(create_franchise_heartbeat_table()) { log_info('SUCCESS'); } else { log_info('**FAILED**'); }
    log_info('Creating franchise login table');
    if(create_franchise_login_table()) { log_info('SUCCESS'); } else { log_info('**FAILED**'); }
    log_info('Creating franchises table');
    if(create_franchises_table()) { log_info('SUCCESS'); } else { log_info('**FAILED**'); }
    log_info('Creating league table');
    if(create_league_table()) { log_info('SUCCESS'); } else { log_info('**FAILED**'); }
    log_info('Creating divisions table');
    if(create_divisions_table()) { log_info('SUCCESS'); } else { log_info('**FAILED**'); }
    log_info('Creating roster players table');
    if(create_roster_players_table()) { log_info('SUCCESS'); } else { log_info('**FAILED**'); }
    log_info('Creating players table');
    if(create_players_table()) { log_info('SUCCESS'); } else { log_info('**FAILED**'); }
    log_info('Creating injuries table');
    if(create_player_injuries_table()) { log_info('SUCCESS'); } else { log_info('**FAILED**'); }
    log_info('Creating data updates table');
    if(create_data_updates_table()) { log_info('SUCCESS'); } else { log_info('**FAILED**'); }
    log_info('Creating draft results table');
    if(create_draft_results_table()) { log_info('SUCCESS'); } else { log_info('**FAILED**'); }
    log_info('Creating player scores table');
    if(create_player_scores_table()) { log_info('SUCCESS'); } else { log_info('**FAILED**'); }
    log_info('Creating free agents table');
    if(create_free_agents_table()) { log_info('SUCCESS'); } else { log_info('**FAILED**'); }
    log_info('Creating watched players table');
    if(create_watched_players_table()) { log_info('SUCCESS'); } else { log_info('**FAILED**'); }
    
    log_info("Tables Complete");

    
    # Update Data
    log_info("Updating Data");
    log_info("Updating League DB");
    update_league_db();
    log_info("Updating Players DB");
    update_players_db();
    log_info("Updating Injuries DB");
    update_injuries_db();
    log_info("Updating Roster Players DB");
    update_roster_players_db();
    log_info("Updating Scores DB");
    update_player_scores_db();
    log_info("Updating Free Agents DB");
    update_free_agents_db();    
    log_info("Updating Draft Results DB");
    update_draft_results_db();
    
    log_info("Data Complete");
    
    log_info("Setting as Initialized");
    set_as_initialized();
}
log_info("Initialization Complete");
echo "complete";
//http_go_to_url(MAIN_PAGE_URL);

function create_franchise_login_table() {
    # Set table name
    $table_name = FRANCHISE_LOGIN_TABLE;
    
    # Check if table exists
    if(db_does_table_exist($table_name)) {
        log_info("Table ".$table_name." already exists");
        return true;
    } else {
        log_info("Creating table ".$table_name);
    }   
    
    
    # Create Table
    $query = "CREATE TABLE IF NOT EXISTS $table_name";
    $query .= "(";
    $query .= "franchise_id VARCHAR(4) NOT NULL,PRIMARY KEY (franchise_id), ";
    $query .= "session_id VARCHAR(32) NOT NULL DEFAULT 0, ";
    $query .= "last_login TIMESTAMP NOT NULL, ";
    $query .= "created TIMESTAMP NOT NULL";
    $query .= ")";

    db_query($query);
    
    # Check for database error
    if(db_error_message()) {
        $error_message = "Database error: ".db_error_message();
        log_error($error_message);
        return false;
    }
    log_info("Created table ".$table_name);
    return true;
}
function create_franchises_table() {
    # Set table name
    $table_name = FRANCHISES_TABLE;
    
    # Check if table exists
    if(db_does_table_exist($table_name)) {
        log_info("Table ".$table_name." already exists");
        return true;
    } else {
        log_info("Creating table ".$table_name);
    }   
    # Create Table
    $query = "CREATE TABLE IF NOT EXISTS $table_name";
    $query .= "(";
    $query .= "id VARCHAR(4) NOT NULL DEFAULT 0,PRIMARY KEY (id), ";
    $query .= "name VARCHAR(64) NOT NULL, ";
    $query .= "abbreviation VARCHAR(64) NOT NULL, ";
    $query .= "icon_url VARCHAR(128) NOT NULL, ";
    $query .= "logo_url VARCHAR(128) NOT NULL, ";
    $query .= "division VARCHAR(2) NOT NULL DEFAULT 0, ";
    $query .= "is_commish INT(1) NOT NULL DEFAULT 0, ";
    $query .= "waiver_sort_order INT(4) NOT NULL DEFAULT 0";    
    $query .= ")";

    db_query($query);
    
    # Check for database error
    if(db_error_message()) {
        $error_message = "Database error: ".db_error_message();
        log_error($error_message);
        die($error_message);
    }
    log_info("Created table ".$table_name);
    return true;
}
function create_league_table() {
    # Set table name
    $table_name = LEAGUE_TABLE;
    
    # Check if table exists
    if(db_does_table_exist($table_name)) {
        log_info("Table ".$table_name." already exists");
        return true;
    } else {
        log_info("Creating table ".$table_name);
    }   
    # Create Table
    $query = "CREATE TABLE IF NOT EXISTS $table_name";
    $query .= "(";
    $query .= "id INT(8) NOT NULL DEFAULT 0,PRIMARY KEY (id), ";
    $query .= "name VARCHAR(64) NOT NULL, ";
    $query .= "roster_size INT(4) NOT NULL DEFAULT 0, ";
    $query .= "injured_reserve INT(4) NOT NULL DEFAULT 0, ";
    $query .= "taxi_squad INT(4) NOT NULL DEFAULT 0, ";
    $query .= "rosters_per_player INT(4) NOT NULL DEFAULT 0, ";
    $query .= "player_limit_units VARCHAR(12) NOT NULL, ";
    $query .= "start_week INT(4) NOT NULL DEFAULT 0, ";
    $query .= "end_week INT(4) NOT NULL DEFAULT 0, ";
    $query .= "last_regular_season_week INT(4) NOT NULL DEFAULT 0, ";
    $query .= "base_url VARCHAR(128) NOT NULL, ";
    $query .= "max_keepers INT(4) NOT NULL DEFAULT 0, ";
    $query .= "precision_value INT(4) NOT NULL DEFAULT 0, ";
    $query .= "h2h VARCHAR(8) NOT NULL, ";
    $query .= "current_waiver_type VARCHAR(64) NOT NULL, ";
    $query .= "lockout VARCHAR(8) NOT NULL, ";
    $query .= "tie_breaker VARCHAR(64) NOT NULL, ";
    $query .= "tie_breaker_count INT(4) NOT NULL DEFAULT 0, ";
    $query .= "tie_breaker_position VARCHAR(8) NOT NULL, ";
    $query .= "standings_sort VARCHAR(64) NOT NULL, ";
    $query .= "surviver_pool VARCHAR(8) NOT NULL, ";
    $query .= "survivor_pool_start_week INT(4) NOT NULL DEFAULT 0, ";
    $query .= "survivor_pool_end_week INT(4) NOT NULL DEFAULT 0, ";
    $query .= "nfl_pool_type VARCHAR(64) NOT NULL, "; 
    $query .= "nfl_pool_start_week INT(4) NOT NULL DEFAULT 0, ";
    $query .= "nfl_pool_end_week INT(4) NOT NULL DEFAULT 0, ";
    $query .= "fantasy_pool_type VARCHAR(64) NOT NULL, ";
    $query .= "fantasy_pool_start_week INT(4) NOT NULL DEFAULT 0, ";
    $query .= "fantasy_pool_end_week INT(4) NOT NULL DEFAULT 0, ";
    $query .= "draft_limit_hours VARCHAR(64) NOT NULL, ";
    $query .= "load_rosters VARCHAR(64) NOT NULL";      
    $query .= ")";

    db_query($query);
    
    # Check for database error
    if(db_error_message()) {
        $error_message = "Database error: ".db_error_message();
        log_error($error_message);
        die($error_message);
    }
    log_info("Created table ".$table_name);
    return true;
}
function create_divisions_table() {
    # Set table name
    $table_name = DIVISIONS_TABLE;
    
    # Check if table exists
    if(db_does_table_exist($table_name)) {
        log_info("Table ".$table_name." already exists");
        return true;
    } else {
        log_info("Creating table ".$table_name);
    }   
    # Create Table
    $query = "CREATE TABLE IF NOT EXISTS $table_name";
    $query .= "(";
    $query .= "id VARCHAR(4) NOT NULL DEFAULT 0,PRIMARY KEY (id), ";
    $query .= "name VARCHAR(64) NOT NULL";    
    $query .= ")";

    db_query($query);
    
    # Check for database error
    if(db_error_message()) {
        $error_message = "Database error: ".db_error_message();
        log_error($error_message);
        die($error_message);
    }
    log_info("Created table ".$table_name);
    return true;
}
function create_roster_players_table() {
    # Set table name
    $table_name = ROSTER_PLAYERS_TABLE;
    
    # Check if table exists
    if(db_does_table_exist($table_name)) {
        log_info("Table ".$table_name." already exists");
        return true;
    } else {
        log_info("Creating table ".$table_name);
    }   
    # Create Table
    $query = "CREATE TABLE IF NOT EXISTS $table_name";
    $query .= "(";    
    $query .= "franchise_id VARCHAR(4) NOT NULL, ";
    $query .= "player_id INT(12) NOT NULL DEFAULT 0, ";
    $query .= "status VARCHAR(64) NOT NULL"; 
    $query .= ")";

    db_query($query);
    
    # Check for database error
    if(db_error_message()) {
        $error_message = "Database error: ".db_error_message();
        log_error($error_message);
        die($error_message);
    }
    log_info("Created table ".$table_name);
    return true;
}
function create_players_table() {
    # Set table name
    $table_name = PLAYERS_TABLE;
    
    # Check if table exists
    if(db_does_table_exist($table_name)) {
        log_info("Table ".$table_name." already exists");
        return true;
    } else {
        log_info("Creating table ".$table_name);
    }   
    
    # Create Table
    $query = "CREATE TABLE IF NOT EXISTS $table_name";
    $query .= "(";
    $query .= "id INT(8) NOT NULL,PRIMARY KEY (id), ";
    $query .= "first_name VARCHAR(64) NOT NULL, ";
    $query .= "last_name VARCHAR(64) NOT NULL, ";
    $query .= "team VARCHAR(10) NOT NULL, ";
    $query .= "position VARCHAR(10) NOT NULL, ";
    $query .= "jersey INT(4) NOT NULL DEFAULT 0, ";
    $query .= "birthdate INT(12) NOT NULL DEFAULT 0, ";
    $query .= "height INT(4) NOT NULL DEFAULT 0, ";
    $query .= "weight INT(4) NOT NULL DEFAULT 0, ";
    $query .= "college VARCHAR(64) NOT NULL, ";
    $query .= "draft_team VARCHAR(10) NOT NULL, ";
    $query .= "draft_year INT(4) NOT NULL, ";
    $query .= "draft_round INT(4) NOT NULL, ";
    $query .= "draft_pick INT(4) NOT NULL, ";    
    $query .= "fleaflicker_id INT(12) NOT NULL DEFAULT 0, ";
    $query .= "fanball_id INT(12) NOT NULL DEFAULT 0, ";
    $query .= "cbs_id INT(12) NOT NULL DEFAULT 0, ";
    $query .= "kffl_id INT(12) NOT NULL DEFAULT 0, ";
    $query .= "sportsticker_id INT(12) NOT NULL DEFAULT 0, ";
    $query .= "rotoworld_id INT(12) NOT NULL DEFAULT 0, ";
    $query .= "espn_id INT(12) NOT NULL DEFAULT 0, ";
    $query .= "stats_id INT(12) NOT NULL DEFAULT 0, ";    
    $query .= "twitter_username VARCHAR(64) NOT NULL";
    $query .= ")";
    
    db_query($query);
    
    # Check for database error
    if(db_error_message()) {
        $error_message = "Database error: ".db_error_message();
        log_error($error_message);
        die($error_message);
    }
    log_info("Created table ".$table_name);
    return true;
}
function create_player_injuries_table() {
    # Set table name
    $table_name = INJURIES_TABLE;
    
    # Check if table exists
    if(db_does_table_exist($table_name)) {
        log_info("Table ".$table_name." already exists");
        return true;
    } else {
        log_info("Creating table ".$table_name);
    }   
    
    # Create Table
    $query = "CREATE TABLE IF NOT EXISTS $table_name";
    $query .= "(";
    $query .= "player_id INT(8) NOT NULL,PRIMARY KEY (player_id), ";
    $query .= "status VARCHAR(64) NOT NULL, ";
    $query .= "details VARCHAR(128) NOT NULL";    
    $query .= ")";
    
    db_query($query);
    
    # Check for database error
    if(db_error_message()) {
        $error_message = "Database error: ".db_error_message();
        log_error($error_message);
        die($error_message);
    }
    log_info("Created table ".$table_name);
    return true;
}
function create_data_updates_table() {
    # Set table name
    $table_name = DATA_UPDATES_TABLE;
    
    # Check if table exists
    if(db_does_table_exist($table_name)) {
        log_info("Table ".$table_name." already exists");
        return true;
    } else {
        log_info("Creating table ".$table_name);
    }   
    # Create Table
    $query = "CREATE TABLE IF NOT EXISTS $table_name";
    $query .= "(";
    $query .= "data_set VARCHAR(32) NOT NULL DEFAULT 0,PRIMARY KEY (data_set), ";
    $query .= "updated_datetime TIMESTAMP DEFAULT 0"; 
    $query .= ")";

    db_query($query);
    
    # Check for database error
    if(db_error_message()) {
        $error_message = "Database error: ".db_error_message();
        log_error($error_message);
        die($error_message);
    }
    log_info("Created table ".$table_name);
    return true;
}
function create_draft_results_table() {
    # Set table name
    $table_name = DRAFT_RESULTS_TABLE;
    
    # Check if table exists
    if(db_does_table_exist($table_name)) {
        log_info("Table ".$table_name." already exists");
        return true;
    } else {
        log_info("Creating table ".$table_name);
    }   
    # Create Table
    $query = "CREATE TABLE IF NOT EXISTS $table_name";
    $query .= "(";    
    $query .= "id INT(4) NOT NULL DEFAULT NULL AUTO_INCREMENT,PRIMARY KEY (id), ";
    $query .= "round INT(4) NOT NULL DEFAULT 0, ";
    $query .= "pick INT(4) NOT NULL DEFAULT 0, ";
    $query .= "franchise_id VARCHAR(4) NOT NULL, ";
    $query .= "player_id INT(12) NOT NULL DEFAULT 0, ";
    $query .= "timestamp TIMESTAMP NOT NULL DEFAULT 0, "; 
    $query .= "comments VARCHAR(128) NOT NULL";
    $query .= ")";

    db_query($query);
    
    # Check for database error
    if(db_error_message()) {
        $error_message = "Database error: ".db_error_message();
        log_error($error_message);
        die($error_message);
    }
    log_info("Created table ".$table_name);
    return true;
}
function create_free_agents_table() {
    # Set table name
    $table_name = FREE_AGENTS_TABLE;
    
    # Check if table exists
    if(db_does_table_exist($table_name)) {
        log_info("Table ".$table_name." already exists");
        return true;
    } else {
        log_info("Creating table ".$table_name);
    }   
    # Create Table
    $query = "CREATE TABLE IF NOT EXISTS $table_name";
    $query .= "(";
    $query .= "id INT(12) NOT NULL DEFAULT 0,PRIMARY KEY (id)";
    $query .= ")";

    db_query($query);
    
    # Check for database error
    if(db_error_message()) {
        $error_message = "Database error: ".db_error_message();
        log_error($error_message);
        die($error_message);
    }
    log_info("Created table ".$table_name);
    return true;   
}
function create_watched_players_table() {
    # Set table name
    $table_name = WATCHED_PLAYERS_TABLE;
    
    # Check if table exists
    if(db_does_table_exist($table_name)) {
        log_info("Table ".$table_name." already exists");
        return true;
    } else {
        log_info("Creating table ".$table_name);
    }   
    # Create Table
    $query = "CREATE TABLE IF NOT EXISTS $table_name";
    $query .= "(";
    $query .= "id INT(12) NOT NULL DEFAULT NULL AUTO_INCREMENT,PRIMARY KEY (id), ";
    $query .= "franchise_id VARCHAR(4) NOT NULL DEFAULT 0, ";
    $query .= "player_id INT(8) NOT NULL DEFAULT 0";
    $query .= ")";

    db_query($query);
    
    # Check for database error
    if(db_error_message()) {
        $error_message = "Database error: ".db_error_message();
        log_error($error_message);
        return false;
    }
    log_info("Created table ".$table_name);
    return true;
}

function set_as_initialized() { 
    log_info("set_as_initialized() function called");
    $file_name = INITIALIZATION_FILENAME;
    $file_handle = fopen($file_name, 'w');
    if(!$file_handle) {
        log_error("Can't create initialization file!");
        die("Can't create initialization file!");
    }
    fclose($file_handle);
    log_info("set_as_initialized() function complete");
    return true;
}
function is_initialized() {
    log_info("is_initialized() function called");
    $file_name = INITIALIZATION_FILENAME;
    if(!file_exists($file_name)) {
        log_info("Not initialized");
        log_info("is_initialized() function complete");
        return false;
    }
    log_info("Initialized");
    log_info("is_initialized() function complete");
    return true;
}

# OTHERS
function create_player_scores_table() {
    # Set table name
    $table_name = PLAYER_SCORES_TABLE;
    
    # Check if table exists
    if(db_does_table_exist($table_name)) {
        log_info("Table ".$table_name." already exists");
        return true;
    } else {
        log_info("Creating table ".$table_name);
    }   
    # Create Table
    $query = "CREATE TABLE IF NOT EXISTS $table_name";
    $query .= "(";
    $query .= "unique_id VARCHAR(32) NOT NULL DEFAULT 0,PRIMARY KEY (unique_id), ";
    $query .= "league_id INT(5) NOT NULL DEFAULT 0, ";
    $query .= "player_id INT(12) NOT NULL, ";
    $query .= "year INT(4) NOT NULL, ";
    $query .= "week INT(2) NOT NULL, ";
    $query .= "score FLOAT(6) NOT NULL";    
    $query .= ")";

    db_query($query);
    
    # Check for database error
    if(db_error_message()) {
        $error_message = "Database error: ".db_error_message();
        log_error($error_message);
        die($error_message);
    }
    log_info("Created table ".$table_name);
    return true;   
}
function create_admin_heartbeat_table() {
    # Set table name
    $table_name = ADMIN_HEARTBEAT_TABLE;
    
    # Check if table exists
    if(db_does_table_exist($table_name)) {
        log_info("Table ".$table_name." already exists");
        return true;
    } else {
        log_info("Creating table ".$table_name);
    }   
    # Create Table
    $query = "CREATE TABLE IF NOT EXISTS $table_name";
    $query .= "(";
    $query .= "heartbeat INT(32) NOT NULL DEFAULT 0, ";
    $query .= "ip_address VARCHAR(15) NOT NULL DEFAULT 0";
    $query .= ")";

    db_query($query);
    
    # Check for database error
    if(db_error_message()) {
        $error_message = "Database error: ".db_error_message();
        log_error($error_message);
        return false;
    }
    log_info("Created table ".$table_name);
    return true;
}
function create_franchise_heartbeat_table() {
    # Set table name
    $table_name = FRANCHISE_HEARTBEAT_TABLE;
    
    # Check if table exists
    if(db_does_table_exist($table_name)) {
        log_info("Table ".$table_name." already exists");
        return true;
    } else {
        log_info("Creating table ".$table_name);
    }   
    
    
    # Create Table
    $query = "CREATE TABLE IF NOT EXISTS $table_name";
    $query .= "(";
    $query .= "franchise_id VARCHAR(4) NOT NULL,PRIMARY KEY (franchise_id), ";
    $query .= "heartbeat INT(32) NOT NULL DEFAULT 0, ";
    $query .= "ip_address VARCHAR(15) NOT NULL DEFAULT 0";     
    $query .= ")";

    db_query($query);
    
    # Check for database error
    if(db_error_message()) {
        $error_message = "Database error: ".db_error_message();
        log_error($error_message);
        return false;
    }
    log_info("Created table ".$table_name);
    return true;
}