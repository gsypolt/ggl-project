<?php

$html = "";

$html .= '<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">';
$html .=    '<div class="navbar-header">';
$html .=        '<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">';
$html .=            '<span class="sr-only">Toggle navigation</span>';
$html .=            '<span class="icon-bar">BLAH 1</span>';
$html .=            '<span class="icon-bar">BLAH 2</span>';
$html .=            '<span class="icon-bar">BLAH 3</span>';
$html .=        '</button>';
$html .=        '<a class="navbar-brand" href="#">Goal-Line Gridiron</a>';
$html .=    '</div>';
$html .=    '<ul class="nav navbar-nav navbar-right">';
$html .=        '<li class="dropdown">';
$html .=            '<a href="#" id="nav_userblock" class="dropdown-toggle" data-toggle="dropdown">User Options<b class="caret"></b></a>';
$html .=            '<ul class="dropdown-menu">';
$html .=                '<li><a href="logout.php"><i class="glyphicon glyphicon-off"></i> Logout</a></li>';
$html .=            '</ul>';
$html .=        '</li>';
$html .=    '</ul>';
$html .=    '<div class="navbar-collapse collapse"></div>';
$html .= '</div>';

print $html;