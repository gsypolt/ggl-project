<?php
require_once 'core.php';
authentication_handle_login();

$this_franchise_id = authentication_get_current_franchise();
if($this_franchise_id <= 0) {
    json_print_error("Invalid franchises"); 
    exit;
}

if(!is_franchise_commish($this_franchise_id) && REQUIRE_COMMISH_PRIV) {
    json_print_error("Could not send draft start notifications since you are not a commish"); 
    exit;
}

if(SendDraftStartNotification()) {
    json_print_success();
    exit;   
}

json_print_error("Could not send draft start notifications");   
exit;