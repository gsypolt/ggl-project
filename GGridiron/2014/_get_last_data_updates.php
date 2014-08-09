<?php
    header('Content-Type: application/json');
    require_once "core.php";
    
    $last_updates = get_last_data_updates();
    
    echo json_encode($last_updates);
    exit;