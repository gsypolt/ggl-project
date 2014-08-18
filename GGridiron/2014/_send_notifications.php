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
    json_print_error("Could not send notifications since you are not the drafting franchises"); 
    exit;
}
$current_pick_details = get_current_pick_details();
$franchises = GetFranchises();
$drafted_franchise = get_franchise($last_pick_details['franchise_id']);
$drafted_player = get_players(array($last_pick_details['player_id']))[0];
$drafted_player_name = $drafted_player['first_name'].' '.$drafted_player['last_name'].', '.$drafted_player['position'].', '.$drafted_player['team'];
$drafted_franchise_name = $drafted_franchise['name'];

$email_notification_to_address_string = '';
foreach($franchises as $franchise) {
    $email_notification_to_address_string .= $franchise['email_address'].',';
}

$text_notification_to_address = "";
foreach($franchises as $franchise) {
    if((int)$franchise['franchise_id'] == (int)$current_pick_details['franchise_id']) {
        $text_notification_to_address = $franchise['phone_address'];
    }
}

if(!SendEmailNotifications($email_notification_to_address_string,$drafted_franchise_name,$drafted_player_name)) {
    json_print_error("Could not send email notifications"); 
    exit;
}
if(!SendOnDeckText($text_notification_to_address,$drafted_franchise_name,$drafted_player_name)) {
    json_print_error("Could not send text notifications");   
    exit;
}

json_print_success();
exit;

function SendEmailNotifications($to_address_string, $franchises_name, $drafted_player_name) {
    $title = "Draft Selection Made!";
    $message = "$franchises_name have drafted $drafted_player_name";
    $headers = "From: DRAFTER@goallinegridiron.com\r\n";
    log_info("Emails - To: ".$to_address_string.", Title: ".$title.", Message: ".$message);
    return mail($to_address_string, $title, $message, $headers);
}

function SendOnDeckText($to_address_string, $franchises_name, $drafted_player_name) {
    $title = "Draft Selection Made!";
    $message = "$franchises_name have drafted $drafted_player_name.  YOU ARE ON THE CLOCK!";
    $headers = "From: DRAFTER@goallinegridiron.com\r\n";
    log_info("SENDING TEXTS - To: ".$to_address_string.", Title: ".$title.", Message: ".$message);
    return mail($to_address_string, $title, $message, $headers);
}

function GetFranchises() {
    // Generate Franchise Array
    $franchises = array();
    
    // 0001
    $franchises[] = array(
        'franchise_id' => '0001',
        'name' => 'Brent Adkins',
        'email_address' => 'xmarine365@gmail.com',
        'phone_address' => '4439030154@vtext.com'
    );
    // 0002
    $franchises[] = array(
        'franchise_id' => '0002',
        'name' => 'Greg Sypolt',
        'email_address' => 'sypolt@gmail.com',
        'phone_address' => '9728241110@txt.att.net'
    );
    // 0003
    $franchises[] = array(
        'franchise_id' => '0003',
        'name' => 'Isidoro Pulido',
        'email_address' => 'lolopulido@hotmail.com',
        'phone_address' => '9724080726@txt.att.net'
    );
    // 0004
    $franchises[] = array(
        'franchise_id' => '0004',
        'name' => 'Matt Dietz',
        'email_address' => 'mdietz529@yahoo.com',
        'phone_address' => '4438076529@vtext.com'
    );
    // 0005
    $franchises[] = array(
        'franchise_id' => '0005',
        'name' => 'Pete Burke',
        'email_address' => 'pjburke7@gmail.com',
        'phone_address' => '4437528910@txt.att.net'
    );
    // 0006
    $franchises[] = array(
        'franchise_id' => '0006',
        'name' => 'Greg Bush',
        'email_address' => 'gbusch66@gmail.com',
        'phone_address' => '4436290230@vtext.com'
    );
    // 0007
    $franchises[] = array(
        'franchise_id' => '0007',
        'name' => 'Dan Knorpp',
        'email_address' => 'dan.knorpp@Gmail.com',
        'phone_address' => '3045946344@txt.att.net'
    );
    // 0008
    $franchises[] = array(
        'franchise_id' => '0008',
        'name' => 'Wally Booker',
        'email_address' => 'sgtbook@gmail.com',
        'phone_address' => '9376898050@vtext.com'
    );
    // 0009
    $franchises[] = array(
        'franchise_id' => '0009',
        'name' => 'Greg Smyth',
        'email_address' => 'gregsmythwvu@gmail.com',
        'phone_address' => '7245038777@txt.att.net'
    );
    // 0010
    $franchises[] = array(
        'franchise_id' => '0010',
        'name' => 'Jason Hoy',
        'email_address' => 'jhoy74@gmail.com',
        'phone_address' => '6144066556@vtext.com'
    );
    return $franchises;
}