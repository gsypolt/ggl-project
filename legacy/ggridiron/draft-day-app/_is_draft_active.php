<?php
    require_once "core.php";
    
    if(is_draft_active()) {
        echo json_encode(true);
        exit;
    }
    
    echo json_encode(false);
    exit;