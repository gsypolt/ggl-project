<?php
    header('Content-Type: application/json');
    require_once "core.php";
    
    $details = gpc_get_bool('details');

    $players = get_players();
    $franchises = get_franchises();
    $draft_results = get_draft_results();
    
    $detailed_players = array();
    if($details) {
        foreach($draft_results as $draft_result) {
            $draft_result['player_position'] = "";
            $draft_result['player_team'] = "";
            $draft_result['player_name'] = "";
            $draft_result['franchise_name'] = "";
            $draft_result['pick_details'] = str_pad($draft_result['round'],2, '0', STR_PAD_LEFT).'-'.str_pad($draft_result['pick'], 2, '0', STR_PAD_LEFT);
            if((int)$draft_result['player_id'] > 0) {
                foreach($players as $player) {
                    if((int)$player['id'] == (int)$draft_result['player_id']) {
                        $draft_result['player_position'] = $player['position'];
                        $draft_result['player_team'] = $player['team'];
                        $draft_result['player_name'] = $player['first_name'] . ' ' . $player['last_name'];
                        break;
                    }
                }                
            }
            foreach($franchises as $franchise) {
                    if((int)$franchise['id'] == (int)$draft_result['franchise_id']) {
                        $draft_result['franchise_name'] = $franchise['name'];
                        $draft_result['franchise_icon_url'] = $franchise['icon_url'];
                        break;
                    }
                }
            $detailed_players[] = $draft_result;
        }        
        $return_message = $detailed_players;
    } else {
        $return_message = $draft_results;
    }

    # Check if request is for a datatable and display
    if(gpc_get('datatable')) {
        $output = array("aaData" => array());
        $output['aaData'] = $return_message;
        echo json_encode($output);
        exit;
    }
    
    echo json_encode($return_message);
    exit;