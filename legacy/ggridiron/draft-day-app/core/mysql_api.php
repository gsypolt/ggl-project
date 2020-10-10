<?php
/**
* @copyright Copyright (C) 2014  SmythLLC
* @author Gregory A. Smyth
*
* @uses log_api.php 
*/

$db_connected = false;
$db = false;
$db_result = null;

function db_connect() {
    global $db, $db_connected;
    
    $db = new mysqli(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);
   
    if(mysqli_connect_errno()) {
        log_error("db_connect() - Database Error: ".mysqli_connect_errno());
        $db_connected = false;
        return false;
    }
    $db_connected = true;
    
    $db->set_charset(MYSQL_CHARSET);
    
    return true;
}

function db_query($query) {
    global $db, $db_connected, $db_result;
    $result_array = array();
    $db_result = array();
    if(!$db_connected) {
        log_error("db_query() - Not connected to the database");
        die(log_get_last_error_message());
    }
    $result = $db->query($query);
    if(db_error_message()) {
        log_error("db_query() - Database Error: ".db_error_message());
        return false;
    }   
    if(is_object($result)) { 
        if($result->num_rows > 1 ){
            while ($row = $result->fetch_assoc()) {
                $result_array[] = $row;
            }	
        } else if($result->num_rows == 1) {
            $result_array[] = $result->fetch_assoc();
        }
    }
    $db_result = $result_array;
    return $result_array;     
}
function db_get_single_result($index = 0) {
    global $db_result;
    if(sizeof($db_result) > $index) {
        return $db_result[$index];
    } else {
        return null;
    }
}
function db_get_result_array() {
    global $db_result;
    return $db_result;
}

function db_escape_string($string) {
    global $db;
    return $db->escape_string($string);
}

function db_get_insert_id() {
    global $db;
    return $db->insert_id;
}

function db_error_message() {
    global $db;
    return $db->error;
}

function db_affected_rows() {
    global $db;
    return $db->affected_rows;
}

function db_does_table_exist($table_name) {
    $table_name = db_escape_string(trim($table_name));
    $query = "SHOW TABLES LIKE '$table_name'";
    $result = db_query($query);
    if($result) {
        return true;
    } else {
        return false;
    }
}

function db_get_backup_sql_file_text() {
    global $db;
    // start buffering output
    ob_start();

    $f_output = fopen("php://output", 'w');

    // put a few comments into the SQL file
    $text = "";
    $text .= ("-- pjl SQL Dump\n");
    $text .= ("-- Server version:".$db->server_info."\n");
    $text .= ("-- Generated: ".date('Y-m-d h:i:s')."\n");
    $text .= ('-- Current PHP version: '.phpversion()."\n");
    $text .= ('-- Host: '.MYSQL_HOST."\n");
    $text .= ('-- Database:'.MYSQL_DATABASE."\n");

    //get a list of all the tables
    $aTables = array();
    $strSQL = 'SHOW TABLES';
    if (!$res_tables = $db->query($strSQL)) {
        echo json_encode(array("success" => false, "error" => $db->error));
        exit;
    }

    while($row = $res_tables->fetch_array()) {
        $aTables[] = $row[0];
    }

    $res_tables->free();

    //Go through all the tables in the database
    foreach($aTables as $table)
    {
        $text .= ("-- --------------------------------------------------------\n");
        $text .= ("-- Structure for '". $table."'\n");
        $text .= ("--\n\n");

        // remove the table if it exists
        $text .= ('DROP TABLE IF EXISTS '.$table.';');

        // ask MySQL how to create the table
        $strSQL = 'SHOW CREATE TABLE '.$table;
        if (!$res_create = $db->query($strSQL)) {
            echo json_encode(array("success" => false, "error" => $db->error));
            exit;
        }

        $row_create = $res_create->fetch_assoc();

        $text .= ("\n".$row_create['Create Table'].";\n");


        $text .= ("-- --------------------------------------------------------\n");
        $text .= ('-- Dump Data for `'. $table."`\n");
        $text .= ("--\n\n");
        $res_create->free();

        // get the data from the table
        $strSQL = 'SELECT * FROM '.$table;
        if (!$res_select = $db->query($strSQL)) {
            echo json_encode(array("success" => false, "error" => $db->error));
            exit;
        }            

        // get information about the fields
        $fields_info = $res_select->fetch_fields();

        // now we can go through every field/value pair.
        // for each field/value we build a string strFields/strValues
        while ($values = $res_select->fetch_assoc()) {
            $strFields = '';
            $strValues = '';
            foreach ($fields_info as $field) {
                if ($strFields != '') $strFields .= ',';
                $strFields .= "`".$field->name."`";

                // put quotes round everything - MYSQL will do type convertion (I hope) - also strip out any nasty characters
                if ($strValues != '') $strValues .= ',';
                $strValues .= '"'.preg_replace('/[^(\x20-\x7F)\x0A]*/','',$values[$field->name].'"');
            }

            // now we can put the values/fields into the insert command.
            $text .= ("INSERT INTO ".$table." (".$strFields.") VALUES (".$strValues.");\n");
        }
        $text .= ("\n\n\n");
        $res_select->free();
    }

    fwrite($f_output, $text);
    fclose($f_output);
    $text .= (ob_get_clean());
    return $text;
}

function db_is_connected() {
    global $db_connected;
    return $db_connected;
}

db_connect();