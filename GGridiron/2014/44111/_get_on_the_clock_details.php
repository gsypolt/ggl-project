<?php
    header('Content-Type: application/json');
    require_once "core.php";
    
    $current_pick = get_current_pick_details();
    $franchise = get_franchise($current_pick['franchise_id']);
    $timestamp = strtotime(get_last_pick_timestamp());
    
    if((int)$timestamp == 0) {
        $timestamp = strtotime('2014-07-06 00:00:00');
    }
    
    $on_time = time() - $timestamp;
    $round = str_pad($current_pick['round'],2, '0', STR_PAD_LEFT);
    $pick = str_pad($current_pick['pick'],2, '0', STR_PAD_LEFT);
    $icon_url = $franchise['icon_url'];
    
    $detailed_array = array (
        'on_time' => $on_time,
        'round' => $round,
        'pick' => $pick,
        'icon_url' => $icon_url,
        'franchise_id' => $current_pick['franchise_id']
    );
    echo json_encode($detailed_array);
    exit;