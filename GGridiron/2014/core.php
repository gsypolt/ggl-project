<?php
/**
* @copyright Copyright (C) 2014 SmythLLC
* @author Gregory A. Smyth
*/

###################
#  Offline Check  #
###################
if ( file_exists( 'offline.php' ) && !isset( $_GET['admin'] ) ) {
    include( 'offline.php' );
    exit;
}

#######################
#  PHP CONFIGURATION  #
#######################
error_reporting(E_ERROR | E_PARSE);  // Turn off non-error reporting
set_time_limit(600); // Set PHP timeout for 10 minutes
date_default_timezone_set('America/Los_Angeles');
//date_default_timezone_set('America/New_York');

###############
#  Constants  #
###############
require_once 'core/constants_inc.php';

##########
#  APIs  #
##########
# --GPC
require_once 'core/gpc_api.php'; 
# --Log
require_once 'core/log_api.php';
# --MYSQL
require_once 'core/mysql_api.php';
# --JSON
require_once 'core/json_api.php';
# --Functions
require_once 'core/functions_api.php';
# --Cookies
require_once 'core/cookies_api.php';
# --Session
require_once 'core/sessions_api.php';
# --Session
require_once 'core/authentication_api.php';
# --HTTP
require_once 'core/http_api.php';
# --Helper Functions
require_once 'core/helper_functions_api.php';

#############
#  Objects  #
#############
# --League
require_once 'core/objects/league_obj.php';
# --Franchise
require_once 'core/objects/franchise_obj.php';
# --Division
require_once 'core/objects/division_obj.php';
# --Player
require_once 'core/objects/player_obj.php';
# --Injury
require_once 'core/objects/injury_obj.php';
# --Roster Player
require_once 'core/objects/roster_player_obj.php';
# --Player Score
require_once 'core/objects/player_score_obj.php';
# --Free Agent
require_once 'core/objects/free_agent_obj.php';
# --Draft Result
require_once 'core/objects/draft_result_obj.php';
