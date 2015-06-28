<?php
    ########################
    #  EXTERNAL FUNCTIONS  #
    ########################

    function authentication_handle_login() {
        log_info("authentication_handle_login() function called");
        if(!REQUIRE_AUTHENTICATION) {
            log_security("authentication_handle_login() - Authentication Bypassed");
            return true;
        }

        # Get Session Data
        $session_token = sessions_get_token();
        $franchise_id = sessions_get_franchise_id();

        # Check if session data is valid
        if(is_franchise_logged_in($franchise_id,$session_token)) {
            log_info("Franchise $franchise_id is already logged in via session");
            log_info("authentication_handle_login() function complete");
            return true;
        }

        # Get Cookie Data
        $session_token = cookies_get_token();
        $franchise_id = cookies_get_franchise_id();

        # Check if session data is valid
        if(is_franchise_logged_in($franchise_id,$session_token)) {
            log_info("Franchise $franchise_id is already logged in via cookies");
            log_info("authentication_handle_login() function complete");
            return true;
        }

        log_info("Franchise $franchise_id is not logged in, redirecting");
        log_info("authentication_handle_login() function complete");
        http_go_to_url(LOGIN_PAGE_URL);
        log_error("Page redirect to login page error");
        die("Page redirect to login page error");
    }
    function authentication_login($franchise_id, $password) {
        log_info("authentication_login() function called");

        # Clean inputs
        $franchise_id = db_escape_string(trim($franchise_id));  
        $password = urlencode($password);  

        # Destroy cookies and session seesion ids
        cookies_destroy_token();
        sessions_destroy_token();

        # Check MFL login
        $session_id = get_mfl_login_session_id($franchise_id, $password);

        # Check if mfl login was valid
        if(!$session_id) {
            log_info("login was invalid");
            log_info("authentication_login() function complete");
            return false;            
        }

        # Set cookie and session
        //cookies_set_token($session_id);
        //cookies_set_franchise_id($franchise_id);
        sessions_set_token($session_id);        
        sessions_set_franchise_id($franchise_id);
        //cookies_set_mfl_cookie($session_id);

        #Set Table Name
        $table_name = FRANCHISE_LOGIN_TABLE;

        # Build query  
        if(!does_franchise_login_exist($franchise_id)) {            
            $query = "INSERT INTO $table_name (franchise_id,session_id,last_login,created) VALUES ('$franchise_id','$session_id',NOW(),NOW())";
        } else {    
            $query = "UPDATE $table_name SET franchise_id='$franchise_id',session_id='$session_id',last_login=NOW() WHERE franchise_id='$franchise_id'";
        }

        # Perform Query
        db_query($query);  

        # Check for db error
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }    
        log_info("authentication_login() function complete");
        return true;
    }
    function authentication_logout() {  
        log_info("authentication_logout() function called");
        sessions_destroy_token();
        sessions_destroy_franchise_id();
        cookies_destroy_token();
        cookies_destroy_franchise_id(); 
        cookies_destroy_mfl_cookie();
        log_info("authentication_logout() function complete");
        return true;
    }
    function authentication_get_current_franchise() {
        # Get Session Data
        $session_token = sessions_get_token();
        $franchise_id = sessions_get_franchise_id();

        # Check if session data is valid
        if(is_franchise_logged_in($franchise_id,$session_token)) {
            log_info("Franchise $franchise_id is already logged in via session");
            log_info("authentication_handle_login() function complete");
            return $franchise_id;
        }

        # Get Cookie Data
        $session_token = cookies_get_token();
        $franchise_id = cookies_get_franchise_id();

        # Check if session data is valid
        if(is_franchise_logged_in($franchise_id,$session_token)) {
            log_info("Franchise $franchise_id is already logged in via cookies");
            log_info("authentication_handle_login() function complete");
            return $franchise_id;
        }
        return null;
    }
    
    ########################
    #  INTERNAL FUNCTIONS  #
    ########################

    # MFL Login
    function get_mfl_login_session_id($franchise_id, $password) {
        log_info("get_mfl_login_session_id() function called");
        
        # Definitions
        $year = MFL_YEAR;
        $league_id = MFL_LEAGUE_ID;

        # Grab Player details from MFL
        $url = "http://football.myfantasyleague.com/$year/login?L=$league_id&FRANCHISE_ID=$franchise_id&PASSWORD=$password&XML=1";
        $xml_array = xml_parse_to_array($url);
        //log_info("URL = $url");
        //log_info("XML Array = $xml_array");
        //log_info("Session id for $franchise_id:".$xml_array['@attributes']['session_id']);
        
        if($xml_array[0] == 'OK') {         
            //log_info("xml_array is OK");
            log_info("get_mfl_login_session_id() function complete");
            return $xml_array['@attributes']['session_id'];
        }
        //log_info("xml_array is NOT OK");
        log_info("get_mfl_login_session_id() function complete");
        return false;
    }  
    
    # Login
    function does_franchise_login_exist($franchise_id) {
        log_info("does_franchise_login_exist() function called");
        
        # Clean inputs
        $franchise_id = db_escape_string(trim($franchise_id));  
    
        # Run Query
        $table_name = FRANCHISE_LOGIN_TABLE;
        $query = "SELECT * FROM $table_name WHERE franchise_id='$franchise_id'";
        $result = db_query($query);

        # Check for db error
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }

        # Check
        if(sizeof($result) < 1) {
            log_info("does_franchise_login_exist() function complete");
            return false;
        }
        log_info("does_franchise_login_exist() function complete");
        return true;
    }
    function is_franchise_logged_in($franchise_id, $session_id) {
        log_info("is_franchise_logged_in() function called");
        # Clean inputs
        $franchise_id = db_escape_string(trim($franchise_id));  
        $session_id = db_escape_string(trim($session_id));  
        
        # Run Query
        $table_name = FRANCHISE_LOGIN_TABLE;
        $query = "SELECT * FROM $table_name WHERE franchise_id='$franchise_id' AND session_id='$session_id'";
        $result = db_query($query);

        # Check for db error
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        }

        # Check
        if(sizeof($result) < 1) {
            log_info("is_franchise_logged_in() function complete");
            return false;
        }
        log_info("is_franchise_logged_in() function complete");
        return true;
    }
    function get_franchise_login_token($franchise_id) {
        log_info("get_franchise_login_token() function called");
        # Clean inputs
        $franchise_id = db_escape_string(trim($franchise_id));

        $table_name = FRANCHISE_LOGIN_TABLE;
        $query = "SELECT session_id FROM $table_name WHERE franchise_id='$franchise_id' LIMIT 1";
        db_query($query);
        if(db_error_message()) {
            $error_message = "Database error: ".db_error_message();
            log_error($error_message);
            die($error_message);
        } 
        $result = db_get_single_result();
        log_info("get_franchise_login_token() function complete");
        return $result['session_id'];
    }