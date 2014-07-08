<?php
/**
* @copyright Copyright (C) 2014  SmythLLC
* @author Gregory A. Smyth
*/

/**
 * Sets username cookie
 *
 * @return bool
 */
function cookies_set_franchise_id($franchise_id)
{
    log_info("cookies_set_franchise_id() function called");    
    $expirationTime = time()+COOKIE_EXPIRATION_TIME;    
    log_info("cookies_set_franchise_id() function complete");    
    return setcookie(COOKIE_LOGIN_FRANCHISE_ID, $franchise_id, $expirationTime);
}

/**
 * Sets token cookie
 *
 * @return bool
 */
function cookies_set_token($token)
{
    log_info("cookies_set_token() function called");    
    $expirationTime = time()+COOKIE_EXPIRATION_TIME;    
    log_info("cookies_set_token() function complete");    
    return setcookie(COOKIE_LOGIN_TOKEN, $token, $expirationTime);
}

/**
 * Gets token cookie
 *
 * @return string Username.
 */
function cookies_get_franchise_id()
{
    log_info("cookies_get_franchise_id() function called");
    
    if (isset($_COOKIE[COOKIE_LOGIN_FRANCHISE_ID])) 
    {        
        log_info("cookie ".$_COOKIE[COOKIE_LOGIN_FRANCHISE_ID]." found");
        log_info("cookies_get_franchise_id() function complete");
        return $_COOKIE[COOKIE_LOGIN_FRANCHISE_ID];
    }
    log_info("cookie for franchise id is not set");
    log_info("cookies_get_franchise_id() function complete");
    return false;
}

/**
 * Gets token cookie
 *
 * @return string Token.
 */
function cookies_get_token()
{
    log_info("cookies_get_token() function called");
    
    if (isset($_COOKIE[COOKIE_LOGIN_TOKEN])) 
    {
        log_info("cookie ".$_COOKIE[COOKIE_LOGIN_TOKEN]." found");
        log_info("cookies_get_token() function complete");
        return $_COOKIE[COOKIE_LOGIN_TOKEN];
    }
    log_info("cookie for token is not set");
    log_info("cookies_get_token() function complete");
    return false;
}

/**
 * Destroys username cookie
 *
 * @return bool
 */
function cookies_destroy_franchise_id()
{
    log_info("cookies_destroy_franchise_id() function called");    
    $expirationTime = time()-3600;    
    log_info("cookies_destroy_franchise_id() function complete");
    return setcookie(COOKIE_LOGIN_FRANCHISE_ID, "", $expirationTime);
}

/**
 * Destroys token cookie
 *
 * @return bool
 */
function cookies_destroy_token()
{
    log_info("cookies_destroy_token() function called");    
    $expirationTime = time()-3600;
    log_info("cookies_destroy_token() function complete");
    return setcookie(COOKIE_LOGIN_TOKEN, "", $expirationTime);
}

function cookies_set_mfl_cookie($token) {
    log_info("cookies_establish_mfl_cookie() function called");    
    $expirationTime = time()+COOKIE_EXPIRATION_TIME;  
    log_info("cookies_establish_mfl_cookie() function complete");
    return setcookie(MFL_LOGIN_TOKEN, $token, $expirationTime, "/", MFL_MAIN_COOKIE_URL);
}
function cookies_establish_mfl_cookie() {
    log_info("cookies_establish_mfl_cookie() function called");    
    $expirationTime = time()+COOKIE_EXPIRATION_TIME;  
    $token = cookies_get_token();
    log_info("cookies_establish_mfl_cookie() function complete");
    return setcookie(MFL_LOGIN_TOKEN, $token, $expirationTime, "/", MFL_MAIN_COOKIE_URL);
}

function cookies_destroy_mfl_cookie() {
    log_info("cookies_destroy_franchise_id() function called");    
    $expirationTime = time()-3600;    
    log_info("cookies_destroy_franchise_id() function complete");
    return setcookie(MFL_LOGIN_TOKEN, "", $expirationTime);
}