<?php
/**
* @copyright Copyright (C) 2014 SmythLLC
* @author Gregory A. Smyth
*/

/**
 * Redirects to a url
 * @param string $url
 * @return none
 */
function http_go_to_url($url) {
    # Send out headers to go to url
    if(!headers_sent()) {
        header( 'Content-Type: text/html; charset=utf-8' );
        header( "Location: $url" );
        exit();
    }
    log_error("http_go_to_url() - Headers already sent");
    die("Redirect Error");
}