<?php
require_once "core.php";

$franchise_id = sessions_get_franchise_id();
$session_id = sessions_get_token();

$franchise_logged_in = is_franchise_logged_in($franchise_id, $session_id);

$html = "";

$html .= '<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">';
$html .=    '<div class="navbar-header">';
//$html .=        '<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">';
//$html .=            '<span class="sr-only">Toggle navigation</span>';
//$html .=            '<span class="icon-bar">BLAH 1</span>';
//$html .=            '<span class="icon-bar">BLAH 2</span>';
//$html .=            '<span class="icon-bar">BLAH 3</span>';
//$html .=        '</button>';
$html .=        '<a class="navbar-brand" href="#">Goal-Line Gridiron</a>';
$html .=        '<a class="navbar-brand" href="http://www3.myfantasyleague.com/2014/home/44111#0" target="_blank">MFL Site</a>';
$html .=    '</div>';
if($franchise_logged_in) {
    $franchise = get_franchise($franchise_id);
    $franchise_name = $franchise['name'];    
 
    $html .=    '<ul class="nav navbar-nav navbar-right">';
    $html .=        '<li class="dropdown">';
    $html .=            '<a href="#" id="nav_userblock" class="dropdown-toggle" data-toggle="dropdown">'.$franchise_name.' Options<b class="caret"></b></a>';
    $html .=            '<ul class="dropdown-menu">';
    if(is_franchise_commish($franchise_id)) {
        $html .= '<li><a href="admin.php"><i class="glyphicon glyphicon-cog"></i> Admin Controls</a></li>';
    }
    $html .=                '<li><a href="logout.php"><i class="glyphicon glyphicon-off"></i> Logout</a></li>';
    $html .=            '</ul>';
    $html .=        '</li>';
    $html .=    '</ul>';
}
$html .=    '<div class="navbar-collapse collapse"></div>';
$html .= '</div>';

print $html;