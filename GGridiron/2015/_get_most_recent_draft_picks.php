<?php
    header('Content-Type: application/json');
    require_once "core.php";
    
    $get_picks_count = gpc_get_int('count');
    if(!$get_picks_count) {
        $get_picks_count = 5;
    }
    
    $current_pick = get_current_pick_details();
    $franchises = get_franchises();
    
    $last_pick_index = (int)$current_pick['id'] - 1;
    $detailed_players = array();
    
    if($last_pick_index >= 1) {    
        $draft_results = get_draft_results();

        # Get Last 5 Picks
        if($last_pick_index <= $get_picks_count) {
            $start_index = $last_pick_index;
            $stop_index = 1;
        } else {
            $start_index = $last_pick_index;
            $stop_index = $last_pick_index - $get_picks_count + 1;            
        }

        for($i = $start_index - 1; $i >= $stop_index - 1; $i--) {  //adjust for array indexing
            $draft_result['franchise_name'] = "";
            $draft_result['round'] = str_pad($draft_results[$i]['round'],2, '0', STR_PAD_LEFT);
            $draft_result['pick'] = str_pad($draft_results[$i]['pick'],2, '0', STR_PAD_LEFT);
            //$draft_result['pick_details'] = str_pad($draft_results[$i]['round'],2, '0', STR_PAD_LEFT).'-'.str_pad($draft_results[$i]['pick'], 2, '0', STR_PAD_LEFT);

            $player = get_players(array((int)$draft_results[$i]['player_id']));
            
            $draft_result['player_position'] = $player[0]['position'];
            $draft_result['player_team'] = $player[0]['team'];
            $draft_result['player_name'] = $player[0]['first_name'] . ' ' . $player[0]['last_name'];               

            foreach($franchises as $franchise) {
                if((int)$franchise['id'] == (int)$draft_results[$i]['franchise_id']) {
                    $draft_result['franchise_name'] = $franchise['name'];
                    $draft_result['franchise_icon_url'] = $franchise['icon_url'];
                    break;
                }
            }
            $detailed_players[] = $draft_result;
        }
    }

    echo json_encode($detailed_players);
    exit;