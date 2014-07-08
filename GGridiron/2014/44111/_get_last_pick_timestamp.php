<?php
    header('Content-Type: application/json');
    require_once "core.php";
    
    $timestamp = strtotime(get_last_pick_timestamp());
    echo json_encode($timestamp);
    exit;