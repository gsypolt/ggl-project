<?php
    header('Content-Type: application/json');
    require_once "core.php";
    
    $return_array = array(
        'MFL_YEAR' => MFL_YEAR,
        'MFL_LEAGUE_ID' => MFL_LEAGUE_ID,
        'HTDOCS_FOLDER' => HTDOCS_FOLDER,
        'WEB_ROOT' => WEB_ROOT
    );
    echo json_encode($return_array);
    exit;

