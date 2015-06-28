<?php
    header('Content-Type: application/json');
    require_once "core.php";

    $players = get_roster_players();
    echo json_encode($players);
    exit;