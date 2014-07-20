<?php
    header('Content-Type: application/json');
    require_once "core.php";
    
    $details = gpc_get_bool('details');
    
    $free_agents_data = get_free_agents();
    $franchise_id = authentication_get_current_franchise();
    $watch_list_player_ids = get_watched_player_ids($franchise_id);

    $free_agents = array();
    if($details) {
        $player_id_array = array();
        foreach($free_agents_data as $free_agent_data) {
            $player_id_array[] = (int)$free_agent_data['id'];
        }
        $free_agents = get_players($player_id_array);
        
        $detailed_free_agents = array();
        foreach($free_agents as $free_agent) {
            $free_agent['watching'] = false;
            $free_agent['age'] = get_age($free_agent['birthdate']);
            $free_agent['name'] = $free_agent['first_name'] . ' ' . $free_agent['last_name'];
            $free_agent['draft_details'] = $free_agent['draft_year'] . '-R' . $free_agent['draft_round'] . '-P' . $free_agent['draft_pick'];    
            foreach($watch_list_player_ids as $watch_list_player_id) {
                if((int)$watch_list_player_id == (int)$free_agent['id']) {
                    $free_agent['watching'] = true;
                    break;
                }
            }
            $detailed_free_agents[] = $free_agent;
        }
        $return_message = $detailed_free_agents;
    } else {
        $return_message = $free_agent_ids;
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