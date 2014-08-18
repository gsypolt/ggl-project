<?php
require_once 'core.php';
authentication_handle_login();

$franchises = GetFranchises();

$to_email_string = '';
$to_text_string = '';
foreach($franchises as $franchise) {
    $to_email_string .= $franchise['email_address'].',';
    $to_text_string .= $franchise['phone_address'].',';
}

if(!SendTestMessage($to_email_string)) {
    json_print_error("Could not send email notifications"); 
    exit;
}
if(!SendTestMessage($to_text_string)) {
    json_print_error("Could not send text notifications"); 
    exit;
}

json_print_success();
exit;

function SendTestMessage($to_address_string) {
    //echo($to_address_string.'<hr>');
    $title = "This is a Test!";
    $message = "This is a test message.";
    $headers = "From: DRAFTER@goallinegridiron.com\r\n";
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