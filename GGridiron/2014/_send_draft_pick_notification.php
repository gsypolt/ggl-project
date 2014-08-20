<?php
require_once 'core.php';
authentication_handle_login();

$this_franchise_id = authentication_get_current_franchise();
if($this_franchise_id <= 0) {
    json_print_error("Invalid franchises");
    exit;
}

$last_pick_details = get_current_pick_details(-1);

if($this_franchise_id != (int)$last_pick_details['franchise_id']) {
    if(!is_franchise_commish($this_franchise_id) && REQUIRE_COMMISH_PRIV) {
        json_print_error("Could not send draft pick notifications since you are not a commish and you are not the drafting franchises"); 
        exit;
    }
}

if(SendDraftPickNotification()) {
    json_print_success();
    exit;
}

json_print_error("Could not send draft pick notifications");
exit;
