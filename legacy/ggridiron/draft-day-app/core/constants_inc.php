<?php
/**
* @copyright Copyright (C) 2014 SmythLLC
* @author Gregory A. Smyth
*/

# Server or local setting
$SERVER_MODE_ENABLED = false;

# Configurable Details
define('MFL_YEAR','2014');
define('MFL_LEAGUE_ID','44111');
define('DRAFT_START_DATE', '2014-08-22 20:00:00');
define('SEND_NOTIFICATION_EMAILS', true);
define('SEND_NOTIFICATION_TEXTS', true);
define('REQUIRE_AUTHENTICATION', true);
define('REQUIRE_COMMISH_PRIV', true);

if($SERVER_MODE_ENABLED) {
    # Local Server Settings
    define('MYSQL_HOST','ggridiron2.db.11749711.hostedresource.com');
    define('MYSQL_USERNAME','ggridiron2');
    define('MYSQL_PASSWORD','gg!QAZ1qaz');
    define('MYSQL_DATABASE','ggridiron2');
    define('MYSQL_CHARSET', 'utf8');
    define('HTDOCS_FOLDER','/2014');
} else {
    # Remote Server Settings
    define('MYSQL_HOST','127.0.0.1');
    define('MYSQL_USERNAME','admin');
    define('MYSQL_PASSWORD','admin');
    define('MYSQL_DATABASE','mfl_2014');
    define('MYSQL_CHARSET', 'utf8');
    define('HTDOCS_FOLDER','/ggl/ggl-project/GGridiron/2014');
}

# Folders and Paths
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
$MAIN_FILE_PATH = $DOCUMENT_ROOT.HTDOCS_FOLDER;
$PHP_SELF = $_SERVER['PHP_SELF'];
$WEB_PATH = str_replace($DOCUMENT_ROOT, "", dirname($PHP_SELF));
$WEB_ROOT = ltrim($WEB_PATH,'/');
define('WEB_ROOT',$WEB_ROOT);

# Log
define('LOG_FILENAME','log.txt');
define('LOG_FILE_PATH', $MAIN_FILE_PATH.'/log/');
define('LOG_FILE_MAX_SIZE_MB', 25);
define('LOG_SPECIAL_MESSAGES', true);
define('LOG_ERROR_MESSAGES', true);
define('LOG_INFO_MESSAGES', false);
define('LOG_SECURITY_MESSAGES', true);

# Initialization file
define('INITIALIZATION_FILENAME', 'initialized');

# Tables
define(ADMIN_HEARTBEAT_TABLE,'admin_heartbeat');
define(FRANCHISE_HEARTBEAT_TABLE,'franchise_heartbeat');
//define(ADMIN_LOGIN_TABLE,'admin_login');
define(FRANCHISE_LOGIN_TABLE,'franchise_login');
define(FRANCHISES_TABLE,'franchises');
define(LEAGUE_TABLE,'league');
define(DIVISIONS_TABLE,'divisions');
define(ROSTER_PLAYERS_TABLE,'roster_players');
define(PLAYERS_TABLE,'players');
define(INJURIES_TABLE,'injuries');
define(DATA_UPDATES_TABLE,'data_updates');
define(DRAFT_RESULTS_TABLE,'draft_results');
define(PLAYER_SCORES_TABLE,'player_scores');
define(FREE_AGENTS_TABLE,'free_agents');
define(INITIALIZATION_TABLE,'initialization');
define(WATCHED_PLAYERS_TABLE,'watched_players');
define(DRAFT_SETTINGS_TABLE,'draft_settings');

# Heartbeats
define(HEARTBEAT_TIMEOUT,5);

# Draft timestamp offset (HRS)
define(DRAFT_TIMESTAMP_OFFSET,(int)0);

# Pages
define(LOGIN_PAGE_URL,'login.php');

# Cookies
define('COOKIE_LOGIN_TOKEN','login_token');
define('COOKIE_LOGIN_FRANCHISE_ID','login_franchise_id');
define('COOKIE_EXPIRATION_TIME', 31536000); //1 year
define('MFL_LOGIN_TOKEN','USER_ID'); // For MFL
define('MFL_MAIN_COOKIE_URL','myfantasyleague.com'); // For MFL

# Sessions
define('SESSION_LOGIN_TOKEN','login_token');
define('SESSION_LOGIN_FRANCHISE_ID','login_franchise_id');

# Data Sets
define('LEAGUE_DATA_SET','LEAGUE');
define('FRANCHISES_DATA_SET','FRANCHISES');
define('DIVISIONS_DATA_SET','DIVISIONS');
define('PLAYERS_DATA_SET','PLAYERS');
define('INJURIES_DATA_SET','INJURIES');
define('ROSTER_PLAYERS_DATA_SET','ROSTER_PLAYERS');
define('PLAYER_SCORES_DATA_SET','PLAYER_SCORES');
define('FREE_AGENTS_DATA_SET','FREE_AGENTS');
define('DRAFT_RESULTS_DATA_SET','DRAFT_RESULTS');