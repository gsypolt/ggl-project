<?php
    header('Content-Type: application/json');
    
    require_once "core.php";  
    
    json_print_message(get_franchise_connections());