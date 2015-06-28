<?php
    header('Content-Type: application/json');
    require_once "core.php";
    
    $draft_settings = get_draft_settings();
    echo json_encode($draft_settings);
    exit;