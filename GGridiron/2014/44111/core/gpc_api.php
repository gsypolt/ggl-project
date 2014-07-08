<?php
/**
* @copyright Copyright (C) 2014 SmythLLC
* @author Gregory A. Smyth
*/

/**
 * Strip slashes if necessary (supports arrays)
 * @param mixed $p_var
 * @return mixed
 */
function gpc_strip_slashes($variable) {
    if( 0 == get_magic_quotes_gpc() ) {
        return $variable;
    } else if( !is_array($variable) ) {
        return stripslashes($variable);
    } else {
        foreach($variable as $key => $value) {
            $variable[$key] = gpc_strip_slashes($value);
        }
        return $variable;
    }
}

/**
 * Get GET or POST values
 * ---------------
 * Retrieve a GPC variable.
 * If the variable is not set, the default is returned.
 * If magic_quotes_gpc is on, slashes will be stripped from the value before being returned.
 *
 *  You may pass in any variable as a default (including null) but if
 * If you pass in *no* default, the default is null if the field cannot be found
 *
 * @param string
 * @return null
 */
function gpc_get($var_name, $default = null) {
    if(isset($_POST[$var_name])) {
        $result = gpc_strip_slashes($_POST[$var_name]);
    } else if(isset($_GET[$var_name])) {
        $result = gpc_strip_slashes($_GET[$var_name]);
    } else if(func_num_args() > 1) {
        $result = $default;
    } else {
        $result = null;
    }
    return $result;
}

/**
 * Retrieve a file GPC variable.
 * If you pass in *no* default, the default is null if the field cannot be found
 * @param string $var_name
 * @param int $default (optional)
 * @return file|null
 */
function gpc_get_file($variable, $default = null) {        
    if(isset($_FILES[$variable])) {
       return $_FILES[$variable];
    }
    return $default;
}

/**
 * Retrieve a boolean GPC variable. Uses gpc_get().
 *  If you pass in *no* default, false will be used
 * @param string $var_name
 * @param bool $default (optional)
 * @return bool|null
 */
function gpc_get_bool($var_name, $default = false) {
    $value = gpc_get($var_name, $default);

    if(strcasecmp($value,"1") == 0 || strcasecmp($value,"true") == 0 || strcasecmp($value,"yes") == 0) {
        return true;
    }
    return false;
}

/**
 * Retrieve an integer GPC variable. Uses gpc_get().
 * If you pass in *no* default, an error will be triggered if
 * the variable does not exist
 * @param string $var_name
 * @param int $default (optional)
 * @return int|null
 */
function gpc_get_int($var_name, $default = null) {
    $result = gpc_get($var_name, $default);
    
    if ($result == $default) {
        return $default;
    }
    
    return (int)$result;
}

/**
 * Convert a string to a bool
 * @param string $string
 * @return bool
 */
function gpc_string_to_bool($string) {
    if( 0 == strcasecmp('off', $string) ||  0 == strcasecmp('no', $p_string) || 0 == strcasecmp('false', $p_string) || 0 == strcasecmp('', $p_string) || 0 == strcasecmp('0', $p_string)) {
        return false;
    } else {
        return true;
    }
}