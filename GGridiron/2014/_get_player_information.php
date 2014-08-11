<?php
    header('Content-Type: application/json');
    require_once "core.php";
    
    $player_id = gpc_get('player_id');
    $players = get_players(array($player_id));    
    echo json_encode($players[0]);
    exit;