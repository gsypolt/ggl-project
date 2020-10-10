<?php
/**
* @copyright Copyright (C) 2014  SmythLLC
* @author Gregory A. Smyth
*/

$logging_fp = false;
$logging_last_error_message = "None";
$logging_last_info_message = "None";
$logging_last_security_message = "None";
$logging_last_special_message = "None";

function log_create_directories() {
    is_dir(LOG_FILE_PATH) || mkdir(LOG_FILE_PATH);
}

function log_open_file() {
    global $logging_fp;
    $max_log_file_size = LOG_FILE_MAX_SIZE_MB*(1024*1024); // Kb to bytes
    $lfile = LOG_FILE_PATH.LOG_FILENAME;
    
    if (file_exists($lfile)) {
        if (filesize($lfile) > $max_log_file_size) {
            rename($lfile, $lfile.'.'.time()) or exit("can't rename file!");
        }
    }
    //$logging_fp = fopen($lfile, 'a') or exit("Can't open $lfile!");
    $logging_fp = fopen($lfile, 'a');
    if(!$logging_fp) {
        return false;
    }
    return true;
}

function log_close_file() {
    global $logging_fp;
    fclose($logging_fp);
}

function log_write_message($message) {
    global $logging_fp;
    
    // if file pointer doesn't exist, then open log file
    if (!is_resource($logging_fp)) {
        if(!log_open_file()) {
            return;
        }
    }
    // define script name
    $script_name = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
    // define current time and suppress E_WARNING if using the system TZ settings
    // (don't forget to set the INI setting date.timezone)
    date_default_timezone_set('America/New_York');
    $time = @date('[Y/m/d H:i:s]');

    // write current time, script name and message to the log file
    fwrite($logging_fp, "$time $message ($script_name)" . PHP_EOL);

    if (!is_resource($logging_fp)) {
        $this->lclose();
    }
}

function log_special($message) {
    global $logging_last_special_message;
    if(LOG_SPECIAL_MESSAGES) {
        $message_to_write = "**SPECIAL** - ".$message;
        $logging_last_special_message = $message;
        log_write_message($message_to_write);
    }
}

function log_error($message) {
    global $logging_last_error_message;
    if(LOG_ERROR_MESSAGES) {
        $message_to_write = "ERROR - ".$message;
        $logging_last_error_message = $message;
        log_write_message($message_to_write);
    }
}

function log_info($message) {
    global $logging_last_info_message;
    if(LOG_INFO_MESSAGES) {
        $message_to_write = "INFO - ".$message;
        $logging_last_info_message = $message;
        log_write_message($message_to_write);
    }
}

function log_security($message) {
    global $logging_last_security_message;
    if(LOG_SECURITY_MESSAGES) {
        $message_to_write = "****SECURITY**** - ".$message;
        $logging_last_security_message = $message;
        log_write_message($message_to_write);
    }
}

function log_get_last_error_message() {
    global $logging_last_error_message;
    return $logging_last_error_message;
}

function log_get_last_info_message() {
    global $logging_last_info_message;
    return $logging_last_info_message;
}

function log_get_last_security_message() {
    global $logging_last_security_message;
    return $logging_last_security_message;
}

log_create_directories();