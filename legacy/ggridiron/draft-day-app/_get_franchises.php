<?php
    header('Content-Type: application/json');
    
    require_once 'core.php';

    $franchises = get_franchises();

    echo json_encode($franchises);