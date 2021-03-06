<?php
    require_once "core.php";
    authentication_handle_login();
?>
<html>
    <head>    
        <title>Draft Room</title>
        
        <script type="text/javascript" language="javascript" src="jQuery/jquery-2.0.3.js"></script>
        <script src="time-to/jquery.timeTo.min.js"></script>
        
                
        <link href="datatables-1.10.0/media/css/jquery.dataTables.css" rel="stylesheet">
        <link href="datatables-1.10.0/media/css/dataTables.jqueryui.css" rel="stylesheet">
        <script type="text/javascript" language="javascript" src="datatables-1.10.0/media/js/jquery.dataTables.js"></script>
        <script type="text/javascript" language="javascript" src="datatables-1.10.0/media/js/dataTables.jqueryui.js"></script> 
        
        <link href="jquery-ui/jquery-ui.css" rel="stylesheet">                      
        <script type="text/javascript" language="javascript" src="jquery-ui/jquery-ui.js"></script>
        
        <script type="text/javascript" src="bootstrap-3.1.1/js/bootstrap.min.js"></script>
        <link href="bootstrap-3.1.1/css/bootstrap.css" rel="stylesheet">
        <link href="time-to/timeTo.css" type="text/css" rel="stylesheet"/>

        <script type="text/javascript" src="js/addons.js"></script>
        <script type="text/javascript" src="js/globals.js"></script>
        <script type="text/javascript" src="js/draft.js"></script>
        <script type="text/javascript" src="js/league.js"></script>
        
        <style>       
            @font-face {
                font-family: 'digi';
                src: url('fonts/DS-DIGII.eot'); /* IE9 Compat Modes */
                src: url('fonts/DS-DIGII.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
                     url('fonts/DS-DIGII.woff') format('woff'), /* Modern Browsers */
                     url('fonts/DS-DIGII.ttf')  format('truetype'), /* Safari, Android, iOS */
                     url('fonts/DS-DIGII.svg#svgFontName') format('svg'); /* Legacy iOS */
            }

            .container {
                width: 1000px !important;
            }      
            body { 
                padding-top: 60px;
                background-image: url(images/background/dark_wood.png);
                position: relative;
                width: 101%;
                margin-top: -10px;
                margin-left: -10px;
                margin-right: -200px;
                margin-bottom: -10px;
            }
            

            .bg-green {
                background-color: greenyellow;
            }
            .bg-black {
                background-color: black;
            }
            .bg-white {
                background-color: white;
            }
            .no_padding {
                padding:0px;
            }
            .no-margin {
                margin: 0px;
            }
            img.small_logo{
                width: 180px;
                height: auto; 
                text-align: center;
            }
            img.very_small_logo{
                width: 80px;
                height: auto; 
            }            
            .round_pick_div{
                width: 205px;
                height: 15px;            
                text-align: center;
                font-size: 10px;
                font-weight: bold;                     
            }
            .pick-container {
                width: auto;
                height: auto;
                float: left;
                padding: 3px;
                background-color: greenyellow;   
                border: 2px dashed #fff;
                border-radius: 10px;
            }
            .stitched-red {
                padding: 6px;
                margin: 5px;
                background: #ff0030;
                color: #fff;
                font-size: 21px;
                font-weight: bold;
                line-height: 1.3em;
                border: 2px dashed #fff;
                border-radius: 10px;
                box-shadow: 0 0 0 4px #ff0030, 2px 1px 6px 4px rgba(10, 10, 0, 0.5);
                text-shadow: -1px -1px #000000;
                font-weight: normal;
             }
            .stitched-green {
               padding: 6px;
               margin: 5px;
               background: #00CC66;
               color: #fff;
               font-size: 21px;
               font-weight: bold;
               line-height: 1.3em;
               border: 2px dashed #fff;
               border-radius: 10px;
               box-shadow: 0 0 0 4px #00CC66, 2px 1px 6px 4px rgba(10, 10, 0, 0.5);
               text-shadow: -1px -1px #000000;
               font-weight: normal;
            }
            .stitched-black {
               padding: 6px;
               margin: 5px;
               background: #000000;
               color: #fff;
               font-size: 21px;
               font-weight: bold;
               line-height: 1.3em;
               border: 2px dashed #fff;
               border-radius: 10px;
               box-shadow: 0 0 0 4px #000000, 2px 1px 6px 4px rgba(10, 10, 0, 0.5);
               text-shadow: -1px -1px #000000;
               font-weight: normal;
            }
            .stitched-gray {
               padding: 6px;
               margin: 5px;
               background: #B8B8B8;
               color: #000000;
               font-size: 21px;
               font-weight: bold;
               line-height: 1.3em;
               border: 2px dashed #000000;
               border-radius: 10px;
               box-shadow: 0 0 0 4px #B8B8B8, 2px 1px 6px 4px rgba(10, 10, 0, 0.5);

               font-weight: normal;
            }
            .stitched-clear {
                padding: 6px;
                margin: 5px;
                color: #000000;
                font-size: 21px;
                font-weight: bold;
                line-height: 1.3em;
                border: 2px solid #000000;
                border-radius: 10px;
                font-weight: normal;
             }
            .center {
                display: box;
                flex-align: center;
                flex-pack: center;
                margin: auto;
                text-align: center;
            }
            .highlight {
                background-color: #33FF44;
            }
            .spacer_div {
                padding-top: 20px;
            }
            .lite-padding {
                padding: 3px;
            }
            .pre-overflow-scroll-y {
                margin-right: 3px;
                margin-left: 3px;
            }
            .overflow-scroll-y {  
                height: 80% !important;
                overflow-y: scroll;
                overflow-x: hidden;
            }

            .table-really-condensed > thead > tr > th,
            .table-really-condensed > tbody > tr > th,
            .table-really-condensed > tfoot > tr > th,
            .table-really-condensed > thead > tr > td,
            .table-really-condensed > tbody > tr > td,
            .table-really-condensed > tfoot > tr > td {
                padding: 1px;
                font-size:14px !important;
            }
            .fg-toolbar{
                font-size: 14px;                  
            }
            tr:hover { 
                background: #BDEFFF !important; 
            }
            .dark-header {}
            .dark-header > thead > tr > th,
            .dark-header > tbody > tr > th,
            .dark-header > tfoot > tr > th {
                background-color: #CCCCCC !important;
            }
            td .center,tr .center { 
                text-align: center;
            }
            .something{}
            .league-logo {
                width: 1000px;
                height: 150px;
            }
            .centered {
                margin-right: auto;
                margin-left: auto;
            }
            .numbers {
                font-family: 'digi';
                font-size: 30px;
            }
            .small-numbers {
                font-family: 'digi';
                font-size: 20px;
            }
            .medium-text {
                font-size: 13px;
            }
            .text-gray {
                color: lightpink;
            }
            
            
            .draft-state {
                height: 30px;
                background-color: gray;
                font-size: 22px;
                font-weight: bold;
                text-align: center;
            }
            .draft-state-active {
                 background-color: #00CC66;
            }
            .draft-state-paused {
                background-color: #FF1751;
            }
            .draft-state-unknown {
                background-color: #000000;
            }
            .my-little-clock {
                position: relative !important;
                margin-right: auto;
                margin-left: auto;
            }
        </style>
        
        <script type="text/javascript">
            var draft = null;
            var league = null;
            
            var TO_DRAFT_PLAYER_ID = 0;
            
            var free_agents_table = null;
            var watch_table = null;
            var draft_results_table = null;
            var team_roster_table = null;
            
            var on_clock = null;
            var current_draft_timestamp = null;
            var watching_delay = 1;
            
            var free_agents = null;
            var watch_list = null;
            var drafted = null;
            
            var clock = null;
            
            var user_franchise_id = null;
            var franchise_id_on_the_clock = null;
            
            var admin = false;
            
            $(document).ready(function() {
                AddConfirmDraftPickModal(); 
                draft = new Draft();
                league = new League();
                DoStartUp();
            });
            function UpdateDraftStatusBanner() {
                if(draft.isDraftActive()) {
                    $("#draft_state_div").html("DRAFT STARTED");
                    $("#draft_state_div").removeClass("draft-state-unknown").removeClass("draft-state-paused").addClass("draft-state-active");
                } else {
                    $("#draft_state_div").html("DRAFT NOT STARTED");
                    $("#draft_state_div").removeClass("draft-state-unknown").removeClass("draft-state-active").addClass("draft-state-paused");
                }
            }
            function ActivatePopOver(id, text) {
                var search_help = $('#'+id);
                search_help.data('state', 'hover');

                var enterShow = function () {
                    if (search_help.data('state') === 'hover') {
                        search_help.popover('show');
                    }
                };
                var exitHide = function () {
                    if (search_help.data('state') === 'hover') {
                        search_help.popover('hide');
                    }
                };
                if(text) {
                    search_help.attr('data-content',text);
                }                
                search_help.popover({trigger: 'manual'}).on('mouseenter', enterShow).on('mouseleave', exitHide);
            }
            
            function DoStartUp() {                
                GetImportantStartupData();
                UpdateOnTheClock();
                BuildWatchTable();
                BuildFreeAgentTable();
                BuildDraftResultsTable();    
                BuildTeamRosterTable();
                UpdateRecentPicks();
                UpdateDraftStatusBanner();
                draft.startCheckForDraftChangeUpdate(UpdateEverything);
                draft.startCheckingForDraftStatus(UpdateEverything);
            }
            
            function show_player_details(player_id) {
                draft.showPlayerDetails(player_id);
            }
            function add_player_to_watch_list(player_id) {
                draft.addPlayerToWatchList(player_id,function(){RefreshWatchTable(); RefreshFreeAgentsTable();});
            }
            function remove_player_from_watch_list(player_id) {
                draft.removePlayerFromWatchList(player_id,function(){RefreshWatchTable(); RefreshFreeAgentsTable();});
            }            
                        
            var _building_free_agent_table_flag = false;
            function BuildFreeAgentTable() {
                var url = '_get_free_agents.php?details=1&datatable=1';
                _building_free_agent_table_flag = true;

                if(free_agents_table !== null) {
                    free_agents_table.fnDestroy();
                }
                $('#tbody_free_agents_table').empty();
                free_agents_table = $('#free_agents_table').DataTable( {
                    "oLanguage": {"sSearch": '<i data-container="body" id="free_agents_search_help" class="popover-dismiss" data-toggle="popover" data-placement="bottom" title="Search Help" data-content=""><span class="glyphicon glyphicon-question-sign"></span></i>&nbsp;Search: '},
                    "jQueryUI": true,
                    "sAjaxSource": url,
                    "fnPreDrawCallback":function(){
                        if(_building_free_agent_table_flag) {
                            // Show Loading Modal
                        }
                    },
                    "fnInitComplete":function(){
                        _building_free_agent_table_flag = false;
                        // Hide Loading Modal						
                    },
                    "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                        var html = "";

                        html = '<button class="btn btn-info btn-xs" onclick="show_player_details('+ aData.id +')">&nbsp;<span class="glyphicon glyphicon-user"></span>&nbsp;</button>';
                        $('td:eq(0)', nRow).html('<div class="center">' + html + '</div>');                        
                        $('td:eq(1)', nRow).html(aData.name);
                        $('td:eq(2)', nRow).html('<div class="center">' + aData.position + '</div>');
                        $('td:eq(3)', nRow).html('<div class="center">' + aData.team + '</div>');
                        $('td:eq(4)', nRow).html('<div class="center">' + aData.age + '</div>');                        
                        $('td:eq(5)', nRow).html(aData.draft_details);
                        if(!JSON.parse(aData.watching)) {
                            html = '<button class="btn btn-success btn-xs" onclick="add_player_to_watch_list('+ aData.id +')">&nbsp;<span class="glyphicon glyphicon-plus"></span>&nbsp;</button>&nbsp;&nbsp;&nbsp;';                     
                        } else {
                            html = '<button class="btn btn-default btn-xs disabled" onclick="add_player_to_watch_list('+ aData.id +')">&nbsp;<span class="glyphicon glyphicon-plus"></span>&nbsp;</button>&nbsp;&nbsp;&nbsp;';                     
                        }
                        if(((franchise_id_on_the_clock === user_franchise_id) || admin) && draft.isDraftActive()) {
                            html += '<button class="btn btn-primary btn-xs" onclick="ConfirmDraftPick('+ aData.id +')"><span class="glyphicon glyphicon-ok"></span>&nbsp;DRAFT</button>';
                        } else {
                            html += '<button class="btn btn-default btn-xs disabled" onclick="ConfirmDraftPick('+ aData.id +')"><span class="glyphicon glyphicon-ok"></span>&nbsp;DRAFT</button>';
                        }
                        $('td:eq(6)', nRow).html(html);
                                               
			return nRow;
                    },
                    "bAutoWidth": false,       
                    "aoColumns": [
                        { "mData": "id", "sWidth": "5%"},
                        { "mData": "name", "sWidth": "30%"},
                        { "mData": "position", "sWidth": "6%"},
                        { "mData": "team", "sWidth": "6%"},
                        { "mData": "age", "sWidth": "6%"},
                        { "mData": "draft_details", "sWidth": "15%"},
                        { "mData": "id", "sWidth": "18%"}
                    ]
                });
                ActivatePopOver('free_agents_search_help','If you want to search for a quarterback (QB) whos first name is Tom (Tom) and is on Houston (HOU) and was draft in 2014 (2014) you can search for all of these terms by entering spaces such as "QB Tom HOU 2014". Criteria order and capitalization do not matter.');
            }
            function RefreshFreeAgentsTable() {
                //_building_free_agent_table_flag = true;
                free_agents_table.ajax.reload(null,false);
            }
            
            var _building_watch_table_flag = false;
            function BuildWatchTable() {
                var url = '_get_watched_players.php?details=1&datatable=1';
                _building_watch_table_flag = true;

                if(watch_table !== null) {
                    watch_table.fnDestroy();
                }
                $('#tbody_watch_table').empty();
                
                watch_table = $('#watch_table').DataTable( {
                    "oLanguage": {"sSearch": '<i data-container="body" id="watched_search_help" class="popover-dismiss" data-toggle="popover" data-placement="bottom" title="Search Help" data-content=""><span class="glyphicon glyphicon-question-sign"></span></i>&nbsp;Search: '},
                    "jQueryUI": true,
                    "sAjaxSource": url,
                    "fnPreDrawCallback":function(){
                        if(_building_watch_table_flag) {
                            // Show Loading Modal
                        }
                    },
                    "fnInitComplete":function(){
                        _building_watch_table_flag = false;
                        // Hide Loading Modal						
                    },
                    "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                        if(JSON.parse(aData.available)) {
                            var html = "";
                            html = '<div class="center">';
                            html += '<img onclick="MoveWatchedPlayerToTop('+ aData.id +')" src="images/arrows/small_up_up_arrow.png"></img>';
                            html += '<img onclick="MoveWatchedPlayerUp('+ aData.id +')" src="images/arrows/small_up_arrow.png"></img>';
                            html += '<img onclick="MoveWatchedPlayerDown('+ aData.id +')" src="images/arrows/small_down_arrow.png"></img>';
                            html += '<img onclick="MoveWatchedPlayerToBottom('+ aData.id +')" src="images/arrows/small_down_down_arrow.png"></img>';
                            //html += '<button class="btn btn-default btn-xs" onclick="MoveWatchedPlayerToTop('+ aData.id +')">&nbsp;<span class="glyphicon glyphicon-arrow-up"></span>&nbsp;</button>';
                            //html += '<button class="btn btn-default btn-xs" onclick="MoveWatchedPlayerUp('+ aData.id +')">&nbsp;<span class="glyphicon glyphicon-chevron-up"></span>&nbsp;</button>';
                            //html += '<button class="btn btn-default btn-xs" onclick="MoveWatchedPlayerDown('+ aData.id +')">&nbsp;<span class="glyphicon glyphicon-chevron-down"></span>&nbsp;</button>';
                            //html += '<button class="btn btn-default btn-xs" onclick="MoveWatchedPlayerToBottom('+ aData.id +')">&nbsp;<span class="glyphicon glyphicon-arrow-down"></span>&nbsp;</button>';
                            html += '</div>';
                            $('td:eq(0)', nRow).html('<div class="center">' + aData.sort_order + '</div>');
                            $('td:eq(1)', nRow).html(html);
                            //$('td:eq(0)', nRow).html(aData.sort_order);
                            $('td:eq(2)', nRow).html(aData.name);
                            $('td:eq(3)', nRow).html('<div class="center">' + aData.position + '</div>');
                            $('td:eq(4)', nRow).html('<div class="center">' + aData.team + '</div>');
                            $('td:eq(5)', nRow).html('<div class="center">' + aData.age + '</div>');
                            $('td:eq(6)', nRow).html(aData.draft_details);
                            html = '<button class="btn btn-danger btn-xs" onclick="remove_player_from_watch_list('+ aData.id +')">&nbsp;<span class="glyphicon glyphicon-remove"></span>&nbsp;</button>&nbsp;&nbsp;&nbsp;'; 
                            if(((franchise_id_on_the_clock === user_franchise_id) || admin) && draft.isDraftActive()) {
                                html += '<button class="btn btn-primary btn-xs" onclick="ConfirmDraftPick('+ aData.id +')"><span class="glyphicon glyphicon-ok"></span>&nbsp;DRAFT</button>';
                            } else {
                                html += '<button class="btn btn-default btn-xs disabled" onclick="ConfirmDraftPick('+ aData.id +')"><span class="glyphicon glyphicon-ok"></span>&nbsp;DRAFT</button>';
                            }
                            $('td:eq(7)', nRow).html(html);
                        } else {
                            html = "";
                            html = '<div class="center">';
                            html += '<img onclick="MoveWatchedPlayerToTop('+ aData.id +')" src="images/arrows/small_up_up_arrow.png"></img>';
                            html += '<img onclick="MoveWatchedPlayerUp('+ aData.id +')" src="images/arrows/small_up_arrow.png"></img>';
                            html += '<img onclick="MoveWatchedPlayerDown('+ aData.id +')" src="images/arrows/small_down_arrow.png"></img>';
                            html += '<img onclick="MoveWatchedPlayerToBottom('+ aData.id +')" src="images/arrows/small_down_down_arrow.png"></img>';
                            //html += '<button class="btn btn-default btn-xs" onclick="MoveWatchedPlayerToTop('+ aData.id +')">&nbsp;<span class="glyphicon glyphicon-arrow-up"></span>&nbsp;</button>';
                            //html += '<button class="btn btn-default btn-xs" onclick="MoveWatchedPlayerUp('+ aData.id +')">&nbsp;<span class="glyphicon glyphicon-chevron-up"></span>&nbsp;</button>';
                            //html += '<button class="btn btn-default btn-xs" onclick="MoveWatchedPlayerDown('+ aData.id +')">&nbsp;<span class="glyphicon glyphicon-chevron-down"></span>&nbsp;</button>';
                            //html += '<button class="btn btn-default btn-xs" onclick="MoveWatchedPlayerToBottom('+ aData.id +')">&nbsp;<span class="glyphicon glyphicon-arrow-down"></span>&nbsp;</button>';
                            html += '</div>';
                            $('td:eq(0)', nRow).html('<div class="center">' + aData.sort_order + '</div>');
                            $('td:eq(1)', nRow).html(html);
                            $('td:eq(2)', nRow).html('<div class="text-gray">' + aData.name  + '</div>');
                            $('td:eq(3)', nRow).html('<div class="center text-gray">' + aData.position + '</div>');
                            $('td:eq(4)', nRow).html('<div class="center text-gray">' + aData.team + '</div>');
                            $('td:eq(5)', nRow).html('<div class="center text-gray">' + aData.age + '</div>');
                            html = '<button class="btn btn-danger btn-xs" onclick="remove_player_from_watch_list('+ aData.id +')">&nbsp;<span class="glyphicon glyphicon-remove"></span>&nbsp;</button>&nbsp;&nbsp;&nbsp;'; 
                            html += '<button class="btn btn-default btn-xs disabled" onclick="ConfirmDraftPick('+ aData.id +')"><span class="glyphicon glyphicon-ok"></span>&nbsp;DRAFT</button>';
                            $('td:eq(6)', nRow).html(aData.draft_details);
                            $('td:eq(7)', nRow).html(html);                            
                        }
			return nRow;
                    },
                    "bAutoWidth": false,       
                    "aoColumns": [
                        { "mData": "sort_order", "sWidth": "3%"},
                        { "mData": "sort_order", "sWidth": "7%"},
                        { "mData": "name", "sWidth": "27%"},
                        { "mData": "position", "sWidth": "5%"},
                        { "mData": "team", "sWidth": "5%"},
                        { "mData": "age", "sWidth": "5%"},
                        { "mData": "draft_details", "sWidth": "13%"},
                        { "mData": "sort_order", "sWidth": "15%", "bSortable": false}
                    ]
                });
                ActivatePopOver('watched_search_help','If you want to search for a quarterback (QB) whos first name is Tom (Tom) and is on Houston (HOU) and was draft in 2014 (2014) you can search for all of these terms by entering spaces such as "QB Tom HOU 2014". Criteria order and capitalization do not matter.');
            }
            function RefreshWatchTable() {
                //_building_watch_table_flag = true;
                watch_table.ajax.reload(null,false);
            }    
            
            var _building_draft_results_table_flag = false;
            function BuildDraftResultsTable() {
                var url = '_get_draft_results.php?details=1&datatable=1';
                _building_draft_results_table_flag = true;

                if(draft_results_table !== null) {
                    draft_results_table.fnDestroy();
                }
                $('#tbody_draft_results_table').empty();
                
                draft_results_table = $('#draft_results_table').DataTable( {
                    "oLanguage": {"sSearch": '<i data-container="body" id="drafted_search_help" class="popover-dismiss" data-toggle="popover" data-placement="bottom" title="Search Help" data-content=""><span class="glyphicon glyphicon-question-sign"></span></i>&nbsp;Search: '},
                    "jQueryUI": true,
                    "sAjaxSource": url,
                    "fnPreDrawCallback":function(){
                        if(_building_draft_results_table_flag) {
                            // Show Loading Modal
                        }
                    },
                    "fnInitComplete":function(){
                        _building_draft_results_table_flag = false;
                        // Hide Loading Modal						
                    },
                    "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                        //_parts.push(aData);
                        var html = "";
                        if(aData.player_id > 0) {
                            html = '<button class="btn btn-default btn-info btn-xs" onclick="show_player_details('+ aData.player_id +')">&nbsp;<span class="glyphicon glyphicon-user"></span>&nbsp;</button>';
                        }
                        $('td:eq(0)', nRow).html('<div class="center">' + html + '</div>');
                        $('td:eq(1)', nRow).html('<div class="center">' + aData.pick_details + '</div>');
                        $('td:eq(2)', nRow).html(aData.player_name);
                        $('td:eq(3)', nRow).html('<div class="center">' + aData.player_position + '</div>');
                        $('td:eq(4)', nRow).html('<div class="center">' + aData.player_team + '</div>');
                        $('td:eq(5)', nRow).html(aData.franchise_name);
			return nRow;
                    },
                    "bAutoWidth": false,       
                    "aoColumns": [
                        { "mData": "pick_details", "sWidth": "3%"},
                        { "mData": "pick_details", "sWidth": "5%"},
                        { "mData": "player_name", "sWidth": "20%"},
                        { "mData": "player_position", "sWidth": "2%"},
                        { "mData": "player_team", "sWidth": "2%"},
                        { "mData": "franchise_name", "sWidth": "15%"}
                    ]
                });
                ActivatePopOver('drafted_search_help','If you want to search for a quarterback (QB) whos first name is Tom (Tom) and is on Houston (HOU) and was draft in 2014 (2014) you can search for all of these terms by entering spaces such as "QB Tom HOU 2014". Criteria order and capitalization do not matter.');
            }
            function RefreshDraftResultsTable() {
                //_building_draft_results_table_flag = true;
                draft_results_table.ajax.reload(null,false);
            } 
            
            var _building_team_roster_table_flag = false;
            function BuildTeamRosterTable() {
                var url = '_get_team_roster.php?details=1&datatable=1';
                _building_team_roster_table_flag = true;

                if(team_roster_table !== null) {
                    team_roster_table.fnDestroy();
                }
                $('#tbody_draft_results_table').empty();
                
                team_roster_table = $('#team_roster_table').DataTable( {
                    "oLanguage": {"sSearch": '<i data-container="body" id="drafted_search_help" class="popover-dismiss" data-toggle="popover" data-placement="bottom" title="Search Help" data-content=""><span class="glyphicon glyphicon-question-sign"></span></i>&nbsp;Search: '},
                    "jQueryUI": true,
                    "sAjaxSource": url,
                    "fnPreDrawCallback":function(){
                        if(_building_team_roster_table_flag) {
                            // Show Loading Modal
                        }
                    },
                    "fnInitComplete":function(){
                        _building_draft_results_table_flag = false;
                        // Hide Loading Modal						
                    },
                    "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                        //_parts.push(aData);
                        var html = "";
                        if(aData.id > 0) {
                            html = '<button class="btn btn-default btn-info btn-xs" onclick="show_player_details('+ aData.id +')">&nbsp;<span class="glyphicon glyphicon-user"></span>&nbsp;</button>';
                        }
                        $('td:eq(0)', nRow).html('<div class="center">' + html + '</div>');
                        $('td:eq(1)', nRow).html(aData.name);
                        $('td:eq(2)', nRow).html('<div class="center">' + aData.position + '</div>');
                        $('td:eq(3)', nRow).html('<div class="center">' + aData.team + '</div>');
                        $('td:eq(4)', nRow).html('<div class="center">' + aData.age + '</div>');
			return nRow;
                    },
                    "bAutoWidth": false,   
                    "order": [[ 2, "desc" ]],
                    "aoColumns": [
                        { "mData": "id", "sWidth": "5%", "bSortable": false},
                        { "mData": "name", "sWidth": "50%"},
                        { "mData": "position", "sWidth": "10%"},                        
                        { "mData": "team", "sWidth": "10%"},
                        { "mData": "age", "sWidth": "10%"}
                    ]
                });
                ActivatePopOver('drafted_search_help','If you want to search for a quarterback (QB) whos first name is Tom (Tom) and is on Houston (HOU) and was draft in 2014 (2014) you can search for all of these terms by entering spaces such as "QB Tom HOU 2014". Criteria order and capitalization do not matter.');
            }
            function RefreshTeamRosterTable() {
                //_building_team_roster_table_flag = true;
                team_roster_table.ajax.reload(null,false);
            } 

            function GetImportantStartupData() {
                if($.get_url_var('admin')) {
                    admin = true;
                }  
                $.ajax({
                    type: "GET",
                    url: '_get_current_franchise_id.php',
                    dataType: "json",
                    data: {},
                    success: function(data){
                        user_franchise_id = data;
                    },
                    error: function(data) {
                        alert("***GetImportantStartupData()-Get Franchise Id GET Error***");
                    },
                    async: false,
                    cache: false
                });
            }
            function UpdateOnTheClock() {
                try {                       
                    var round_details = "R"+draft.on_the_clock_data.round+"-P"+draft.on_the_clock_data.pick+"&nbsp;&nbsp;";
                    if(!JSON.parse(draft.on_the_clock_data.draft_active)) {
                        $("#on_the_clock_outline").removeClass("stitched-green").addClass("stitched-clear");
                    } else {
                        $("#on_the_clock_outline").removeClass("stitched-clear").addClass("stitched-green");
                    }
                    if(JSON.parse(draft.on_the_clock_data.count_down)) {
                        SetClockSeconds(parseInt(draft.on_the_clock_data.on_time),true);
                    } else {                        
                        SetClockSeconds(parseInt(draft.on_the_clock_data.on_time),false);
                    }                    
                    if(!JSON.parse(draft.on_the_clock_data.draft_active) && JSON.parse(draft.on_the_clock_data.count_down)) {
                        $('#clock_heading').html('<div><h4 class="center"><u>TIME UNTIL DRAFT STARTS</u></h4><br></div>');
                    } else {
                        $('#clock_heading').html('<div><h4 class="center"><u>TIME SINCE LAST PICK</u></h4><br></div>');
                    }
                    $('#on_clock_round_details').html(round_details);
                    $("#on_clock_icon").attr("src",draft.on_the_clock_data.icon_url);
                    franchise_id_on_the_clock = draft.on_the_clock_data.franchise_id;
                    for(var i = 0; i < draft.on_the_clock_data.on_deck_picks.length; i++) {
                        round_details = "R"+draft.on_the_clock_data.on_deck_picks[i].round+"-P"+draft.on_the_clock_data.on_deck_picks[i].pick+"&nbsp;&nbsp;";
                        $('#on_deck_round_details_' + i).html(round_details);
                        $('#on_deck_icon_' + i).attr("src",draft.on_the_clock_data.on_deck_picks[i].icon_url);
                    }
                } catch(ex){ console.log(ex);}
            }
            
            function UpdateRecentPicks() {
                var url = '_get_most_recent_draft_picks.php';              
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "json",
                    data: {},
                    success: function(data){
                        //Build HTML
                        var html = "";
                        if(data.length == 0) {
                            html += '<div class="stitched-clear"><div class="center">NO PICKS HAVE OCCURRED</div></div>';
                        }
                        for(var i = 0; i < data.length; i++) {
                            var round_details = "R"+data[i].round+"-P"+data[i].pick+"&nbsp;&nbsp;";
                            html += '<div class="stitched-clear">';
                            //html +=     '<span class="small-numbers">' + round_details + '&nbsp;&nbsp;</span>';
                            html +=     '<img alt="" class="very_small_logo centered" src="' + data[i].franchise_icon_url + '">&nbsp;';
                            html +=     '<span class="medium-text">' + data[i].player_name + ', ' + data[i].player_position + ', ' + data[i].player_team+ '</span><br>';
                            html +=     '<span class="medium-text">' + '</span>';
                            html += '</div>';
                        }
                        $('#last_picks_div').html(html);
                    },
                    error: function(data) {
                        alert("***UpdateRecentPicks() GET Error***");
                    },
                    async: true,
                    cache: false
                });
            }
            
            function UpdateEverything() {
                league.updateRosterPlayers();
                UpdateOnTheClock();
                RefreshFreeAgentsTable();
                RefreshWatchTable();
                RefreshDraftResultsTable();
                RefreshTeamRosterTable();
                UpdateRecentPicks();
                UpdateDraftStatusBanner();
            }
            function SetClockSeconds(seconds, countdown) {
                $('#clock').timeTo({
                    seconds: seconds,
                    countdown: countdown,
                    theme: "black",
                    fontSize: 36,
                    displayDays: 2,
                    displayCaptions: true,
                    captionSize: 15
                });
            }

            function MoveWatchedPlayerToTop(player_id) {
                 draft.moveWatchedPlayerToTop(player_id,function(){RefreshWatchTable();});
            }
            function MoveWatchedPlayerUp(player_id) {
                 draft.moveWatchedPlayerUp(player_id,function(){RefreshWatchTable();});
            }
            function MoveWatchedPlayerDown(player_id) {
                 draft.moveWatchedPlayerDown(player_id,function(){RefreshWatchTable();});
            }
            function MoveWatchedPlayerToBottom(player_id) {
                 draft.moveWatchedPlayerToBottom(player_id,function(){RefreshWatchTable();});
            }
            
            function ConfirmDraftPick(player_id) {
                TO_DRAFT_PLAYER_ID = player_id;
                var player = draft.getPlayerInformation(TO_DRAFT_PLAYER_ID);
                $('#confirm_draft_modal_text').html(player.first_name + ' ' + player.last_name + ', ' + player.team + ', ' + player.position);
                ShowConfirmDraftModal();
            }
            function ReallyDraftSelectedPlayer() {
                draft.draftPlayer(TO_DRAFT_PLAYER_ID,function(){UpdateEverything();});
            }
            function DontReallyDraftSelectedPlayer() {
                TO_DRAFT_PLAYER_ID = 0;
                $('#confirm_draft_modal_text').html('');
            }
            function AddConfirmDraftPickModal() {
                var html =  "";
                html += '<div class="modal" id="confirm_draft_modal" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">';
                html +=     '<div class="modal-dialog" style="width:600px;margin-top:75px;">';
                html +=         '<div class="modal-content">';
                html +=             '<div class="modal-header">';
                html +=                 '<h2>Confirm Draft Pick</h2>';
                html +=             '</div>';
                html +=             '<div class="modal-body center" align="center">';
                html +=                 '<h2><div id="confirm_draft_modal_text"></div></h2>';
                html +=             '</div>';
                html +=             '<div class="modal-footer">';
                html +=                 '<button onclick="ReallyDraftSelectedPlayer()" data-dismiss="modal" class="btn btn-lg btn-success">&nbsp;&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;</button>';
                html +=                 '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                html +=                 '<button onclick="DontReallyDraftSelectedPlayer()" data-dismiss="modal" aria-hidden="true" class="btn btn-lg btn-danger">&nbsp;&nbsp;&nbsp;No&nbsp;&nbsp;&nbsp;</button>';
                html +=             '</div>';
                html +=         '</div>';
                html +=     '</div>';
                html += '</div>';        
                $("body").append(html); 
            }
            function ShowConfirmDraftModal() {
                $('#confirm_draft_modal').modal('show');
            }
            
            function UPDATE() {
                alert("NOTHING CONFIGURED");
            }
        </script>
    </head>

    <body>        
        <div class="container bg-black">
            <!-- Navigation --> 
            <?php include 'navigation.php'; ?>
            <!-- /Navigation -->  

            <div class="row no_padding">
                <img class="league-logo center" alt="" src="images/banners/GGDraft14.jpg"/>
                <div id="draft_state_div" class="col-xs-12 draft-state draft-state-unknown"></div>
            </div>
            <div class="row no_padding">  
                <div class="col-xs-4 lite-padding">                    
                    <div class="panel-group" id="accordion0">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion0" href="#collapseZero">On The Clock</a>
                                </h4>
                            </div>
                            <div id="collapseZero" class="panel-collapse collapse in">
                                <!--<div><button class="btn btn-block btn-xs btn-primary" onclick="UPDATE()">UPDATE</button><hr></div>-->
                                <div id="clock_heading"></div>
                                <div id="clock" class="my-little-clock centered"></div><br><hr>

                                <div><h4 class="center"><u>ON THE CLOCK</u></h4></div>
                                <div class="stitched-clear" id="on_the_clock_outline"><span id="on_clock_round_details" class="numbers"></span><img id="on_clock_icon" alt="" class="small_logo centered" src=""></div>
                                <hr>
                                <div><h4 class="center"><u>ON DECK</u></h4></div>
                                <div class="stitched-clear"><span id="on_deck_round_details_0" class="numbers"></span><img id="on_deck_icon_0" alt="" class="small_logo centered" src=""></div>
                                <div class="stitched-clear"><span id="on_deck_round_details_1" class="numbers"></span><img id="on_deck_icon_1" alt="" class="small_logo centered" src=""></div>
                            </div>
                        </div>
                    </div>         

                    <div class="col-xs-12 lite-padding">
                        <div class="panel-group" id="last_picks_accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#last_picks_accordion" href="#last_picks_collapse">Most Recent Picks</a>
                                    </h4>
                                </div>
                                <div id="last_picks_collapse" class="panel-collapse collapse in"> 
                                    <div id="last_picks_div"></div>
                                </div>
                            </div>
                        </div>         
                    </div>
                </div>
                <div class="col-xs-8 lite-padding">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Available Free Agents</a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body no_padding">
                                    <table id="free_agents_table" class="table table-bordered table-really-condensed dark-header">
                                        <thead>
                                            <tr>
                                                <th>&nbsp;&nbsp;<i class="glyphicon glyphicon-user"></i></th>
                                                <th class="center">Name</th>
                                                <th class="center">Pos</th>
                                                <th class="center">Team</th>
                                                <th class="center">Age</th>
                                                <th class="center">Drafted</th>
                                                <th class="center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_free_agents_table"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-group" id="accordion1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo">Custom Watch List</a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse in">
                                <div class="panel-body no_padding">
                                    <table id="watch_table" class="table table-bordered table-really-condensed dark-header">
                                        <thead>
                                            <tr>
                                                <th class="center">#</th>
                                                <th class="center">Sorting</th>
                                                <th class="center">Name</th>
                                                <th class="center">Pos</th>
                                                <th class="center">Team</th>
                                                <th class="center">Age</th>
                                                <th class="center">Draft Pick</th>
                                                <th class="center">Actions</th>
                                            </tr>
                                        </thead>                                       
                                        <tbody id="tbody_watch_table"></tbody>
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-group" id="accordion3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion3" href="#collapseThree">Drafted List</a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse in">
                                <div class="panel-body no_padding">   
                                    <table id="draft_results_table" class="table table-bordered table-really-condensed dark-header">
                                        <thead>
                                            <tr>
                                                <th class="center">&nbsp;&nbsp;<i class="glyphicon glyphicon-user"></i></th>
                                                <th class="center">Pick</th>
                                                <th class="center">Name</th>
                                                <th class="center">Pos</th>
                                                <th class="center">Team</th>
                                                <th class="center">Franchise</th>
                                            </tr>
                                        </thead>                                       
                                        <tbody id="tbody_draft_results_table"></tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="panel-group" id="accordion4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion4" href="#collapseFour">Team Roster</a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse in">
                                <div class="panel-body no_padding">   
                                    <table id="team_roster_table" class="table table-bordered table-really-condensed dark-header">
                                        <thead>
                                            <tr>
                                                <th class="center">&nbsp;&nbsp;<i class="glyphicon glyphicon-user"></i></th>
                                                <th class="center">Name</th>
                                                <th class="center">Pos</th>
                                                <th class="center">Team</th>
                                                <th class="center">Age</th>
                                            </tr>
                                        </thead>                                       
                                        <tbody id="tbody_team_roster_table"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </body>
</html>