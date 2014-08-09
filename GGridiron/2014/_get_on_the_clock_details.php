<?php
    header('Content-Type: application/json');
    require_once "core.php";
    
    $current_pick = get_current_pick_details();
    $on_deck_picks = array();
    $on_deck_picks[] = get_current_pick_details(1);
    $on_deck_picks[] = get_current_pick_details(2);
    $count_down = false;
    $franchise = get_franchise($current_pick['franchise_id']);
    
    $on_deck_data_array = array();
        
    foreach($on_deck_picks as $on_deck_pick):
        $on_deck_franchise = get_franchise($on_deck_pick['franchise_id']);
        $on_deck_round = str_pad($on_deck_pick['round'],2, '0', STR_PAD_LEFT);
        $on_deck_pick = str_pad($on_deck_pick['pick'],2, '0', STR_PAD_LEFT);
        $on_deck_icon_url = $on_deck_franchise['icon_url'];
        $on_deck_data_array[] = array(
            'round' => $on_deck_round,
            'pick' => $on_deck_pick,
            'icon_url' => $on_deck_icon_url,
            'franchise_id' => $on_deck_franchise['franchise_id']
        );
    endforeach;
    $on_deck_franchise_1 = get_franchise($ondeck_pick_1['franchise_id']);
    $on_deck_franchise_2 = get_franchise($ondeck_pick_2['franchise_id']);

    $draft_active = is_draft_active();    
    $last_pick_timestamp = strtotime(get_last_pick_timestamp());
    $draft_start_timestamp = strtotime(DRAFT_START_DATE);
    $current_timestamp = get_current_timestamp();    
    $seconds_until_draft = $draft_start_timestamp - $current_timestamp;
    
    if($last_pick_timestamp > 0) {  //Pick has been made regardless of anything else
        $on_time =  $current_timestamp - $last_pick_timestamp;
        $count_down = false;
    } else if($last_pick_timestamp == 0 && $seconds_until_draft > 0 && !$draft_active) {   //No Picks, draft has not started yet, normal    
        $on_time = $seconds_until_draft;
        $count_down = true;
    } elseif($current_timestamp == 0 && $seconds_until_draft > 0 && $draft_active) {    //No Picks, draft has started early
        $on_time = 1;
        $count_down = false;
    } elseif($current_timestamp == 0 && $seconds_until_draft < 0 && $draft_active) {    //No Picks, draft started on time or later  
        $on_time = $current_timestamp - $draft_start_timestamp;
        $count_down = false;
    } elseif ($current_timestamp == 0 && $seconds_until_draft < 0 && !$draft_active) {   //No Picks, draft has not started on time
        $on_time = 1;
        $count_down = true;
    } else {
        $on_time = 1;
        $count_down = true;
    }
    $round = str_pad($current_pick['round'],2, '0', STR_PAD_LEFT);
    $pick = str_pad($current_pick['pick'],2, '0', STR_PAD_LEFT);
    $icon_url = $franchise['icon_url'];

    $detailed_array = array (
        'draft_active' => $draft_active,
        'count_down' => $count_down,
        'on_time' => $on_time,
        'round' => $round,
        'pick' => $pick,
        'icon_url' => $icon_url,
        'franchise_id' => $current_pick['franchise_id'],
        'on_deck_picks' => $on_deck_data_array
    );
    echo json_encode($detailed_array);
    exit;