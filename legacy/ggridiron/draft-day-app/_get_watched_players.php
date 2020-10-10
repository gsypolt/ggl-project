<?php
    header('Content-Type: application/json');
    require_once "core.php";
    
    $details = gpc_get_bool('details');
    $franchise_id = authentication_get_current_franchise();
    
    $watched_players = get_watched_players($franchise_id);
    $free_agents_data = get_free_agents();
    
    $player_ids = array();
    foreach($watched_players as $watched_player) {
        $player_ids[] = $watched_player['player_id'];
    }
    $detailed_players = array();
    if($details && sizeof($player_ids)!=0) {
        $players = get_players($player_ids);
        
        foreach($players as $player) {
            $player['available'] = false;
            foreach($free_agents_data as $free_agent_data) {
                if((int)$free_agent_data['id'] == (int)$player['id']) {
                    $player['available'] = true;
                    break;
                }
            }
            $player['age'] = get_age($player['birthdate']);
            $player['name'] = $player['first_name'] . ' ' . $player['last_name'];
            $player['draft_details'] = $player['draft_year'] . '-R' . $player['draft_round'] . '-P' . $player['draft_pick'];
            $player['sort_order'] = -1;
            foreach($watched_players as $watched_player) {
                if((int)$watched_player['player_id'] == (int)$player['id']) {
                    $player['sort_order'] = $watched_player['sort_order'];
                }
            }
            $detailed_players[] = $player;
        }
        
        $return_message = $detailed_players;
    } else {
        $return_message = $player_ids;
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