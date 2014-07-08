<?php
    require_once "core.php";
    authentication_handle_login();
?>
<!DOCTYPE html>
<html>
    <head>    
        <title>Draft Room</title>
        
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
        
        <style>       
            @font-face {
                font-family: 'digi';
                src: url('fonts/DS-DIGII.TTF');
            }

            .container {
                width: 1000px !important;
            }      
            body { 
                padding-top: 60px;
                background-image: url(images/background/dark_wood.png) format('embedded-opentype');
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
                width: 100%;
                height: 200px;
            }
            .your-clock{
                zoom: 0.475;
                -moz-transform: scale(0.475);
                margin-left: 30px;
            }
            .centered {
                margin-right: auto;
                margin-left: auto;
            }
            .numbers {
                font-family: 'digi';
                font-size: 30px;
            }
            .text-gray {
                color: lightpink;
            }
        </style>
        
        <script type="text/javascript">
            var draft = null;
            
            var free_agents_table = null;
            var watch_table = null;
            var draft_results_table = null;
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
                draft = new Draft();
                DoStartUp();               
            });
            
            function DoStartUp() {
                GetImportantStartupData();
                UpdateOnTheClock();
                BuildWatchTable();
                BuildFreeAgentTable();
                BuildDraftResultsTable();                  
                StartWatchingForDraftChange();
            }
            
            function show_player_details(player_id) {
                alert("TODO - Show player details ID = " + player_id);
            }

            function add_player_to_watch_list(player_id) {
                var url = '_add_player_id_to_watch_list.php';
                $.ajax({
                    type: "POST",
                    url: url,
                    dataType: "json",
                    data: {player_id: player_id},
                    success: function(data){
                        if(data.success) {
                            RefreshWatchTable();
                            RefreshFreeAgentsTable();
                        } else {
                            alert(data.error);
                        }
                    },
                    error: function(data) {
                         alert("***add_player_to_watch_list() GET Error***");
                    },
                    async: true,
                    cache: false
                });
            }
            function remove_player_from_watch_list(player_id) {
                var url = '_remove_player_id_from_watch_list.php';
                $.ajax({
                    type: "POST",
                    url: url,
                    dataType: "json",
                    data: {player_id: player_id},
                    success: function(data){
                        if(data.success) {
                            RefreshWatchTable();
                            RefreshFreeAgentsTable();
                        } else {
                            alert(data.error);
                        }
                    },
                    error: function(data) {
                        alert("***remove_player_from_watch_list() GET Error***");
                    },
                    async: true,
                    cache: false
                });
            }            
            function draft_player(player_id) {
                draft.draft_player(player_id,function(){RefreshFreeAgentsTable();RefreshDraftResultsTable();RefreshWatchTable();});
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
                    "jQueryUI": true,
                    "sAjaxSource": url,
                    "fnPreDrawCallback":function(){
                        if(_building_free_agent_table_flag) {
                            //_dreams_notification_modals.show_loading_modal();
                        }
                    },
                    "fnInitComplete":function(){
                        _building_free_agent_table_flag = false;
                        //_dreams_notification_modals.hide_loading_modal();						
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
                        if((franchise_id_on_the_clock === user_franchise_id) || admin) {
                            html += '<button class="btn btn-primary btn-xs" onclick="draft_player('+ aData.id +')"><span class="glyphicon glyphicon-ok"></span>&nbsp;DRAFT</button>';
                        } else {
                            html += '<button class="btn btn-default btn-xs disabled" onclick="draft_player('+ aData.id +')"><span class="glyphicon glyphicon-ok"></span>&nbsp;DRAFT</button>';
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
            }
            function RefreshFreeAgentsTable() {
                //_building_parts_table_flag = true;
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
                    "jQueryUI": true,
                    "sAjaxSource": url,
                    "fnPreDrawCallback":function(){
                        if(_building_watch_table_flag) {
                            //_dreams_notification_modals.show_loading_modal();
                        }
                    },
                    "fnInitComplete":function(){
                        _building_watch_table_flag = false;
                        //_dreams_notification_modals.hide_loading_modal();						
                    },
                    "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                        if(JSON.parse(aData.available)) {
                            var html = "";
                            html = '<button class="btn btn-info btn-xs" onclick="show_player_details('+ aData.id +')">&nbsp;<span class="glyphicon glyphicon-user"></span>&nbsp;</button>';
                            $('td:eq(0)', nRow).html('<div class="center">' + html + '</div>');
                            $('td:eq(1)', nRow).html(aData.name);
                            $('td:eq(2)', nRow).html('<div class="center">' + aData.position + '</div>');
                            $('td:eq(3)', nRow).html('<div class="center">' + aData.team + '</div>');
                            $('td:eq(4)', nRow).html('<div class="center">' + aData.age + '</div>');
                            $('td:eq(5)', nRow).html(aData.draft_details);
                            html = '<button class="btn btn-danger btn-xs" onclick="remove_player_from_watch_list('+ aData.id +')">&nbsp;<span class="glyphicon glyphicon-remove"></span>&nbsp;</button>&nbsp;&nbsp;&nbsp;'; 
                            if((franchise_id_on_the_clock === user_franchise_id) || admin) {
                                html += '<button class="btn btn-primary btn-xs" onclick="draft_player('+ aData.id +')"><span class="glyphicon glyphicon-ok"></span>&nbsp;DRAFT</button>';
                            } else {
                                html += '<button class="btn btn-default btn-xs disabled" onclick="draft_player('+ aData.id +')"><span class="glyphicon glyphicon-ok"></span>&nbsp;DRAFT</button>';
                            }
                            $('td:eq(6)', nRow).html(html);
                        } else {
                            html = '<button class="btn btn-default btn-xs disabled" onclick="show_player_details('+ aData.id +')">&nbsp;<span class="glyphicon glyphicon-user"></span>&nbsp;</button>';
                            $('td:eq(0)', nRow).html('<div class="center text-gray">' + html + '</div>');
                            $('td:eq(1)', nRow).html('<div class="text-gray">' + aData.name  + '</div>');
                            $('td:eq(2)', nRow).html('<div class="center text-gray">' + aData.position + '</div>');
                            $('td:eq(3)', nRow).html('<div class="center text-gray">' + aData.team + '</div>');
                            $('td:eq(4)', nRow).html('<div class="center text-gray">' + aData.age + '</div>');
                            $('td:eq(5)', nRow).html('<div class="text-gray">' + aData.draft_details + '</div>');
                            html = '<button class="btn btn-danger btn-xs" onclick="remove_player_from_watch_list('+ aData.id +')">&nbsp;<span class="glyphicon glyphicon-remove"></span>&nbsp;</button>&nbsp;&nbsp;&nbsp;'; 
                            html += '<button class="btn btn-default btn-xs disabled" onclick="draft_player('+ aData.id +')"><span class="glyphicon glyphicon-ok"></span>&nbsp;DRAFT</button>';
                            $('td:eq(6)', nRow).html(html);
                        }
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
            }
            function RefreshWatchTable() {
                //_building_parts_table_flag = true;
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
                    "jQueryUI": true,
                    "sAjaxSource": url,
                    "fnPreDrawCallback":function(){
                        if(_building_draft_results_table_flag) {
                            //_dreams_notification_modals.show_loading_modal();
                        }
                    },
                    "fnInitComplete":function(){
                        _building_draft_results_table_flag = false;
                        //_dreams_notification_modals.hide_loading_modal();						
                    },
                    "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                        //_parts.push(aData);
                        var html = "";
                        html = '<button class="btn btn-default btn-info btn-xs" onclick="show_player_details('+ aData.player_id +')">&nbsp;<span class="glyphicon glyphicon-user"></span>&nbsp;</button>';
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
                        { "mData": "pick_details", "sWidth": "1%"},
                        { "mData": "pick_details", "sWidth": "5%"},
                        { "mData": "player_name", "sWidth": "20%"},
                        { "mData": "player_position", "sWidth": "2%"},
                        { "mData": "player_team", "sWidth": "2%"},
                        { "mData": "franchise_name", "sWidth": "15%"}
                    ]
                });
            }
            function RefreshDraftResultsTable() {
                //_building_parts_table_flag = true;
                draft_results_table.ajax.reload(null,false);
            } 

            function GetImportantStartupData() {
                if($.get_url_var('admin')) {
                    admin = true;
                }  
                $.ajax({
                    type: "GET",
                    url: '_get_last_pick_timestamp.php',
                    dataType: "json",
                    data: {},
                    success: function(data){
                        current_draft_timestamp = data;
                    },
                    error: function(data) {
                        alert("***GetImportantStartupData()-Last Pick Timestamp GET Error***");
                    },
                    async: false,
                    cache: false
                });
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
                var url = '_get_on_the_clock_details.php';
                if(on_clock === null) {
                    on_clock = $('#clock').FlipClock({
                        clockFace: 'DailyCounter'
                    });
                }                
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "json",
                    data: {},
                    success: function(data){
                        on_clock.setTime(parseInt(data.on_time));
                        on_clock.start();
                        var round_details = "R"+data.round+"-P"+data.pick+"&nbsp;&nbsp;";
                        $('#on_clock_round_details').html(round_details);
                        $("#on_clock_icon").attr("src",data.icon_url);
                        franchise_id_on_the_clock = data.franchise_id;
                    },
                    error: function(data) {
                        alert("***UpdateOnTheClock() GET Error***");
                    },
                    async: false,
                    cache: false
                });
            }
            
            function CheckForDraftChange() {
                $.ajax({
                    type: "GET",
                    url: '_get_last_pick_timestamp.php',
                    dataType: "json",
                    data: {},
                    success: function(data){
                        if(data !== current_draft_timestamp) {
                            current_draft_timestamp = data;
                            UpdateOnTheClock();
                            RefreshFreeAgentsTable();
                            RefreshWatchTable();
                            RefreshDraftResultsTable();
                        }
                    },
                    error: function(data) {
                        alert("***CheckForDraftChange() GET Error***");
                    },
                    async: true,
                    cache: false
                });
            }   
            function StartWatchingForDraftChange() {
                setInterval(function(){CheckForDraftChange()},watching_delay*1000);
            }
            
        </script>
    </head>

    <body>        
        <div class="container bg-black">
            <!-- Navigation --> 
            <?php include 'navigation.php'; ?>
            <!-- /Navigation -->  
            
            <div class="row">
                <img class="league-logo center" alt="" src="http://i1088.photobucket.com/albums/i340/4Gdynasty/GG2014.png"/>
            </div>
            <br>
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
                                <br>
                                <div id="clock" class="your-clock"></div>
                                <div class="stitched-red"><span id="on_clock_round_details" class="numbers"></span><img id="on_clock_icon" alt="" class="small_logo centered" src=""></div><br>
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
                                                <th>&nbsp;&nbsp;<i class="glyphicon glyphicon-user"></i></th>
                                                <th class="center">Name</th>
                                                <th class="center">Pos</th>
                                                <th class="center">Team</th>
                                                <th class="center">Age</th>
                                                <th class="center">Drafted</th>
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
                </div>
            </div>            
        </div>
    </body>
</html>