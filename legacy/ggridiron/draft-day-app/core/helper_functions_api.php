<?php

# Other Helper Functions
function xml_parse_to_array($url) {
    log_info("xml_parse_to_array() function called");
    $xml = simplexml_load_file($url);
    $xml_array = unserialize(serialize(json_decode(json_encode((array) $xml), 1)));
    log_info("xml_parse_to_array() function complete");
    return $xml_array;
}
function clear_db_table($table_name) {
    log_info("clear_db_table() function called");
    log_info("Trying to clear table $table_name");

    $query = "TRUNCATE TABLE $table_name";

    # Do Query
    db_query($query);  

    # Check for db error
    if(db_error_message()) {
        $error_message = "Database error: ".db_error_message();
        log_error($error_message);
        die($error_message);
    }    
    log_info("clear_db_table() function complete");
    return true;
}
function is_multi_array($array) {
    if (count($array) == count($array, COUNT_RECURSIVE)) {
      return false;
    } else {
      return true;
    }
}
function get_current_timestamp() {
    return time();
}