<?php
    require_once 'core.php';

    log_info("Initialization Requested");

    $force = gpc_get_bool('force');

    if(is_initialized() && !$force) {
        log_info("Already Initialized");
    } else {
        if($force) {
            log_info("Initialization Forced");
        }
        if(!create_all_tables()) {
            echo json_print_error("Unable to Create Tables");
            log_error("Initialization Faileds");
            exit;
        }
        if(!update_league_db()) {
            echo json_print_error("Unable to update Laegue DB");
            log_error("Initialization Faileds");
            exit;
        }
        if(!update_players_db()) {
            echo json_print_error("Unable to update Players DB");
            log_error("Initialization Faileds");
            exit;
        }
        if(!update_injuries_db()) {
            echo json_print_error("Unable to update Injuries DB");
            log_error("Initialization Faileds");
            exit;
        }
        if(!update_roster_players_db()) {
            echo json_print_error("Unable to update Roster Players DB");
            log_error("Initialization Faileds");
            exit;
        }
        if(!update_free_agents_db()) {
            echo json_print_error("Unable to update Free Agents DB");
            log_error("Initialization Faileds");
            exit;
        }
        if(!update_draft_results_db()) {
            echo json_print_error("Unable to update Draft Results DB");
            log_error("Initialization Faileds");
            exit;
        }
    }    
    //set_as_initialized();
    log_info("Initialization Complete");
    echo json_print_success();
