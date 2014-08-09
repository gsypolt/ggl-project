<?php
    require_once "core.php";
    authentication_handle_login();
    $franchise_id = authentication_get_current_franchise();

    if(!is_franchise_commish($franchise_id)) {
        log_error("Franchise isn't a commish");
        json_print_error("Franchise isn't a commish");
        exit;
    }
?>
<html>
    <head>    
        <title>Administrator</title>
        
        <script type="text/javascript" language="javascript" src="jQuery/jquery-2.0.3.js"></script>
        
        <link rel="stylesheet" href="flipclock-0.5.5/compiled/flipclock.css">
        <script src="flipclock-0.5.5/compiled/flipclock.js"></script>        
                
        <link href="datatables-1.10.0/media/css/jquery.dataTables.css" rel="stylesheet">
        <link href="datatables-1.10.0/media/css/dataTables.jqueryui.css" rel="stylesheet">
        <script type="text/javascript" language="javascript" src="datatables-1.10.0/media/js/jquery.dataTables.js"></script>
        <script type="text/javascript" language="javascript" src="datatables-1.10.0/media/js/dataTables.jqueryui.js"></script> 
        
        <link href="jquery-ui/jquery-ui.css" rel="stylesheet">                      
        <script type="text/javascript" language="javascript" src="jquery-ui/jquery-ui.js"></script>
        
        <script type="text/javascript" src="bootstrap-3.1.1/js/bootstrap.min.js"></script>
        <link href="bootstrap-3.1.1/css/bootstrap.css" rel="stylesheet">

        <script type="text/javascript" src="js/addons.js"></script>
        <script type="text/javascript" src="js/globals.js"></script>
        <script type="text/javascript" src="js/draft.js"></script>
        <script type="text/javascript" src="js/league.js"></script>
        
        <script type="text/javascript">
            var draft = null;
            var league = null;
            var count = 0;
            $(document).ready(function() {  
                draft = new Draft(); 
                league = new League();
                updateDraftSettings();
                updateLastUpdates();
                setInterval(updateDraftSettings,5000);
                setInterval(updateLastUpdates,5000);
            });
            
            function updateDraftSettings() {
                console.log("updateDraftSettings() called");       
                var url = '_get_draft_settings.php';             
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "json",
                    data: {},
                    success: function(data){
                        if(JSON.parse(data.offline_draft_enabled)) {
                            $("#offline_draft_button_on").
                                removeClass("btn-default").
                                addClass("btn-success");
                            $("#offline_draft_button_off").
                                removeClass("btn-danger").
                                addClass("btn-default");
                        }else {
                            $("#offline_draft_button_on").
                                addClass("btn-default").
                                removeClass("btn-success");
                            $("#offline_draft_button_off").
                                addClass("btn-danger").
                                removeClass("btn-default");
                        }
                        console.log("updateDraftSettings() complete");
                    },
                    error: function() {
                        console.log("updateDraftSettings() ***ERROR***");
                    },
                    async: true,
                    cache: false
                });
            }
            function updateLastUpdates() {
                console.log("updateDraftSettings() called");       
                var url = '_get_last_data_updates.php';             
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "json",
                    data: {},
                    success: function(data){
                        for(var i = 0;i < data.length;i++) {
                            if(data[i].data_set === "DRAFT_RESULTS") {
                                $("#draft_results_last_update").html(data[i].updated_datetime);
                                $("#draft_results_update_rate").html(data[i].update_rate_seconds);
                            }
                            if(data[i].data_set === "LEAGUE") {
                                $("#league_last_update").html(data[i].updated_datetime);
                                $("#league_update_rate").html(data[i].update_rate_seconds);
                            }
                            if(data[i].data_set === "FREE_AGENTS") {
                                $("#free_agents_last_update").html(data[i].updated_datetime);
                                $("#free_agents_update_rate").html(data[i].update_rate_seconds);
                            }
                            if(data[i].data_set === "INJURIES") {
                                $("#injuries_last_update").html(data[i].updated_datetime);
                                $("#injuries_update_rate").html(data[i].update_rate_seconds);
                            }
                            if(data[i].data_set === "PLAYERS") {
                                $("#players_last_update").html(data[i].updated_datetime);
                                $("#players_update_rate").html(data[i].update_rate_seconds);
                            }
                            if(data[i].data_set === "PLAYER_SCORES") {
                                $("#player_scores_last_update").html(data[i].updated_datetime);
                                $("#player_scores_update_rate").html(data[i].update_rate_seconds);
                            }
                            if(data[i].data_set === "ROSTER_PLAYERS") {
                                $("#roster_players_last_update").html(data[i].updated_datetime);
                                $("#roster_players_update_rate").html(data[i].update_rate_seconds);
                            }

                        }
                        console.log("updateDraftSettings() complete");
                    },
                    error: function() {
                        console.log("updateDraftSettings() ***ERROR***");
                    },
                    async: true,
                    cache: false
                });
            }
        </script>
    </head>

    <body>  
        <div class="col-xs-8">
            <table class="table table-condensed table-bordered" style="border:1px; width:100%;"> 
                <colgroup>
                    <col span="1" style="width: 200px;">
                    <col span="1" style="width: 200px;">
                    <col span="1" style="width: 300px;">
                </colgroup>
                <thead>
                    <th>DESCRIPTION</th>
                    <th>ACTION</th>
                    <th>LAST UPDATE</th>
                    <th>UPDATE RATE</th>
                </thead>
                <tbody>
                    <tr>
                        <td>DRAFT RESULTS</td>
                        <td><button class="btn btn-primary" onclick="draft.updateFromMflDraftResults()"><span class="glyphicon glyphicon-star"></span> UPDATE</button></td>
                        <td><div id="draft_results_last_update"></div></td>
                        <td><div id="draft_results_update_rate"></td>
                    </tr>
                    <tr>
                        <td>LEAGUE</td>
                        <td><button class="btn btn-primary" onclick="league.updateLeague()"><span class="glyphicon glyphicon-star"></span> UPDATE</button></td>
                        <td><div id="league_last_update"></div></td>
                        <td><div id="league_update_rate"></td>
                    </tr>
                    <tr>
                        <td>PLAYER SCORES</td>
                        <td><button class="btn btn-primary" onclick="league.updateFreeAgents()"><span class="glyphicon glyphicon-star"></span> UPDATE</button></td>
                        <td><div id="free_agents_last_update"></div></td>
                        <td><div id="free_agents_update_rate"></td>
                    </tr>
                    <tr>
                        <td>INJURIES</td>
                        <td><button class="btn btn-primary" onclick="league.updateInjuries()"><span class="glyphicon glyphicon-star"></span> UPDATE</button></td>
                        <td><div id="injuries_last_update"></div></td>
                        <td><div id="injuries_update_rate"></td>
                    </tr>
                    <tr>
                        <td>PLAYERS</td>
                        <td><button class="btn btn-primary" onclick="league.updatePlayers()"><span class="glyphicon glyphicon-star"></span> UPDATE</button></td>
                        <td><div id="players_last_update"></div></td>
                        <td><div id="players_update_rate"></td>
                    </tr>
                    <tr>
                        <td>PLAYER SCORES</td>
                        <td><button class="btn btn-primary" onclick="league.updatePlayerScores()"><span class="glyphicon glyphicon-star"></span> UPDATE</button></td>
                        <td><div id="player_scores_last_update"></div></td>
                        <td><div id="player_scores_update_rate"></td>
                    </tr>
                    <tr>
                        <td>ROSTER PLAYERS</td>
                        <td><button class="btn btn-primary" onclick="league.updateRosterPlayers()"><span class="glyphicon glyphicon-star"></span> UPDATE</button></td>
                        <td><div id="roster_players_last_update"></div></td>
                        <td><div id="roster_players_update_rate"></td>
                    </tr>
                    <tr>
                        <td>OFFLINE DRAFT</td>
                        <td>
                            <div class="btn-group btn-toggle"> 
                                <button id="offline_draft_button_on" class="btn btn-default" onclick="draft.startOfflineDraft()">ON</button>
                                <button id="offline_draft_button_off" class="btn btn-default" onclick="draft.stopOfflineDraft()">OFF</button>
                            </div>
                        </td>
                        <td>----</td>
                        <td>----</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>