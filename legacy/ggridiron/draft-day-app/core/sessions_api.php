<?php
/**
* @copyright Copyright (C) 2014  SmythLLC
* @author Gregory A. Smyth
*/

/**
 * Starts session if it does not exist
 *
 * @return bool
 */
function sessions_start()
{
    log_info("sessions_start() function called");
    $session_id = session_id();
    if(!$session_id)
    {
        log_info("sessions_start() function complete");
        return session_start();
    }
    log_info("session already started");
    log_info("sessions_start() function complete");
    return true;
}

/**
 * Sets username session variable
 *
 * @return bool
 */
function sessions_set_franchise_id($franchise_id)
{
    log_info("sessions_set_franchise_id() function called");
    sessions_start();
    $_SESSION[SESSION_LOGIN_FRANCHISE_ID] = $franchise_id;
    log_info("sessions_set_franchise_id() function complete");
    return true;
}

/**
 * Sets token session variable
 *
 * @return bool
 */
function sessions_set_token($token)
{
    log_info("sessions_set_token() function called");
    sessions_start();
    $_SESSION[SESSION_LOGIN_TOKEN] = $token;
    log_info("sessions_set_token() function complete");
    return true;
}

/**
 * Gets token session variable
 *
 * @return string Username.
 */
function sessions_get_franchise_id()
{
    log_info("sessions_get_franchise_id() function called");
    sessions_start();
    if (isset($_SESSION[SESSION_LOGIN_FRANCHISE_ID])) 
    {
        log_info("sessions_get_franchise_id() function complete");
        return $_SESSION[SESSION_LOGIN_FRANCHISE_ID];
    }
    log_info("no session franchise found");
    log_info("sessions_get_franchise_id() function complete");
    return false;
}

/**
 * Gets token session variable
 *
 * @return string Token.
 */
function sessions_get_token()
{
    log_info("sessions_get_token() function called");
    sessions_start();
    if (isset($_SESSION[SESSION_LOGIN_TOKEN])) 
    {
        log_info("sessions_get_token() function complete");
        return $_SESSION[SESSION_LOGIN_TOKEN];
    }
    log_info("no session token found");
    log_info("sessions_get_token() function complete");
    return false;
}

/**
 * Destroys username session variable
 *
 * @return bool
 */
function sessions_destroy_franchise_id()
{
    log_info("sessions_destroy_franchise_id() function called");
    sessions_start();
    if(!isset($_SESSION[SESSION_LOGIN_FRANCHISE_ID]))
    {
        log_info("no session franchise found");
        log_info("sessions_destroy_franchise_id() function complete");
        return true;
    }
    unset($_SESSION[SESSION_LOGIN_FRANCHISE_ID]);
    log_info("sessions_destroy_franchise_id() function complete");
    return true;
}

/**
 * Destroys token session variable
 *
 * @return bool
 */
function sessions_destroy_token()
{
    log_info("sessions_destroy_token() function called");
    sessions_start();
    if(!isset($_SESSION[SESSION_LOGIN_TOKEN]))
    {
        log_info("no session token found");
        log_info("sessions_destroy_token() function complete");
        return true;
    }
    unset($_SESSION[SESSION_LOGIN_TOKEN]);
    
    log_info("sessions_destroy_token() function complete");
}