<?php
    header('Content-Type: application/json');
    require_once "core.php";
    
    $franchise_id = authentication_get_current_franchise();
    echo json_encode($franchise_id);