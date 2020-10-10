/**
* @copyright Copyright (C) 2014  SmythLLC
* @author Gregory A. Smyth
*/
function Draft () {    
    var Draft = this;
    
    var SUCCESS_MODAL_SHOW_TIME = 3000;    
    var LIVE_DRAFT_ENABLED = false;
    var MFL_DRAFT_ENABLED = true;
    
    this.ON_THE_CLOCK_UPDATE_SECONDS = 5;
    this.UPDATE_ON_THE_CLOCK_INTERVAL = null;
    this.on_the_clock_data = new Array();
    
    this.DRAFT_RESULTS_UPDATE_SECONDS = 10;
    this.UPDATE_DRAFT_RESULTS_INTERVAL = null;
    this.draft_results_data = new Array();
    this.last_draft_timestamp = 0;
    
    this.DRAFT_STATUS_UPDATE_SECONDS = 5;
    this.UPDATE_DRAFT_STATUS_INTERVAL = null;
    
    this.DRAFT_ACTIVE = false;
    
    // Initialization
    this.init = function() {
        addDraftingNotActiveModal();
        addDraftingModal();
        addErrorModal();
        addSuccessModal();  
        addDraftingIframe();
        this.updateOnTheClockData();
    };
    
    this.isDraftActive = function () {
        return Draft.DRAFT_ACTIVE;
    };

    // HTML Adding
    function addDraftingNotActiveModal() {
        var html =  "";
        html += '<div class="modal" id="draft_modal_drafting_not_active" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">';
        html +=     '<div class="modal-dialog" style="width:80%;margin-top:70px;">';
        html +=         '<div class="modal-content">';
        html +=             '<div class="modal-body center" align="center">';
        html +=                 '<br><br><br><br><h1>DRAFTING IS NOT ACTIVATED</h1><br><br><br><br><br>';
        html +=                 '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
        html +=             '</div>';
        html +=         '</div>';
        html +=     '</div>';
        html += '</div>';   
        $("body").append(html); 
    }
    function addDraftingModal() {
        var html =  "";
        html += '<div class="modal" id="draft_modal_drafting" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">';
        html +=     '<div class="modal-dialog" style="width:400px;margin-top:75px;">';
        html +=         '<div class="modal-content">';
        html +=             '<div class="modal-body center" align="center">';
        html +=                 '<h3>Drafting...</h3>';
        html +=             '</div>';
        html +=         '</div>';
        html +=     '</div>';
        html += '</div>';   
        $("body").append(html); 
    }
    function addErrorModal() {
        var html =  "";
        html += '<div class="modal" id="draft_modal_error" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">';
        html +=     '<div class="modal-dialog" style="width:400px;margin-top:75px;">';
        html +=         '<div class="modal-content">';
        html +=             '<div class="modal-body center" align="center">';
        html +=                 '<h3>ERROR</h3>';
        html +=                 '<br>';
        html +=                 '<h4><div id="draft_modal_error_text"></div></h4>';
        html +=             '</div>';
        html +=             '<div class="modal-footer">';
        html +=                 '<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Acknowledge</button>';
        html +=             '</div>';
        html +=         '</div>';
        html +=     '</div>';
        html += '</div>';        
        $("body").append(html); 
    }
    function addSuccessModal() {
        var html =  "";
        html += '<div class="modal" id="draft_modal_success" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">';
        html +=     '<div class="modal-dialog" style="width:400px;margin-top:75px;">';
        html +=         '<div class="modal-content">';
        html +=             '<div class="modal-body center" align="center">';
        html +=                 '<h3>Successful Draft!</h3>';
        html +=             '</div>';
        html +=         '</div>';
        html +=     '</div>';
        html += '</div>';   
        $("body").append(html); 
    }
    function addDraftingIframe() {
        $("body").append('<iframe id="draft_frame" width="800" height="800" src="" class="hidden"></iframe>');
        //$("body").append('<iframe id="draft_frame" width="800" height="800" src="" class=""></iframe>');
    }    
    
    // Loading Modal
    this.showDraftingNotActiveModal = function (){
        console.log("handleDraftActive() called"); 
        $('#draft_modal_drafting_not_active').modal('show');
        console.log("handleDraftActive() complete"); 
    };
    this.hideDraftingNotActiveModal = function (){
        console.log("hideDraftingNotActiveModal() called");
        $('#draft_modal_drafting_not_active').modal('hide');
        console.log("hideDraftingNotActiveModal() complete");
    };
    this.showDraftingModal = function (){
        console.log("showDraftingModal() called"); 
        $('#draft_modal_drafting').modal('show');
        console.log("showDraftingModal() complete");
    };
    this.hideDraftingModal = function (){
        console.log("hideDraftingModal() called"); 
        $('#draft_modal_drafting').modal('hide');
        console.log("hideDraftingModal() complete");
    };
    this.showDraftingErrorModal = function (message){  
        console.log("showDraftingErrorModal() called"); 
        $('#draft_modal_error_text').html('<h4>' + message + '</h4>');
        $('#draft_modal_error').modal('show');
        console.log("showDraftingErrorModal() complete");
    };
    this.showDraftingSuccessModal = function (display_time){
        console.log("showDraftingSuccessModal() called"); 
        $('#draft_modal_success').modal('show');
        if(display_time) {
            setTimeout(this.hideDraftingSuccessModal,display_time);
        } else {
            setTimeout(this.hideDraftingSuccessModal,SUCCESS_MODAL_SHOW_TIME);
        }
        console.log("showDraftingSuccessModal() complete");
    };
    this.hideDraftingSuccessModal = function (){
        console.log("hideDraftingSuccessModal() called"); 
        $('#draft_modal_success').modal('hide');
        console.log("hideDraftingSuccessModal() complete");
    };

    // On The Clock Functions
    this.updateOnTheClockData = function(){
        console.log("updateOnTheClockData() called");       
        var url = '_get_on_the_clock_details.php';             
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            data: {},
            success: function(data){
                Draft.on_the_clock_data = data;
                console.log("updateOnTheClockData() success");
            },
            error: function() {
                console.log("updateOnTheClockData() ***ERROR***");
            },
            async: false,
            cache: false
        });
    };
    /*this.startOnTheClockUpdate = function(){
        console.log("startOnTheClockUpdate() called");
        this.updateOnTheClockData();
        this.UPDATE_ON_THE_CLOCK_INTERVAL = setInterval(this.updateOnTheClockData,this.ON_THE_CLOCK_UPDATE_SECONDS*1000);
        console.log("startOnTheClockUpdate() complete");
    };
    this.stopOnTheClockUpdate = function(){
        console.log("stopOnTheClockUpdate() called");
        clearInterval(this.UPDATE_ON_THE_CLOCK_INTERVAL);
        console.log("stopOnTheClockUpdate() complete");
    };
    */
    // Live Draft Functions
    this.startLiveDraft = function() {
        console.log("startLiveDraft() called");       
        var url = '_start_live_draft.php';             
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            data: {},
            success: function(data){
                if(!data.success) {
                    Draft.showDraftingErrorModal("Unable to start the Live Draft");
                }
                console.log("startLiveDraft() success");
            },
            error: function() {
                Draft.showDraftingErrorModal("Error while trying to start the Live Draft");
                console.log("startLiveDraft() ***ERROR***");
            },
            async: true,
            cache: false
        });
    };
    this.stopLiveDraft = function() {
        console.log("stopLiveDraft() called");       
        var url = '_stop_live_draft.php';             
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            data: {},
            success: function(data){
                if(!data.success) {
                    Draft.showDraftingErrorModal("Unable to stop the Live Draft");
                }
                console.log("stopLiveDraft() success");
            },
            error: function() {
                Draft.showDraftingErrorModal("Error while trying to stop the Live Draft");
                console.log("stopLiveDraft() ***ERROR***");
            },
            async: true,
            cache: false
        });
    };
    
    // Offline Draft Functions
    this.startOfflineDraft = function() {
        console.log("startOfflineDraft() called");       
        var url = '_start_offline_draft.php';             
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            data: {},
            success: function(data){
                if(!data.success) {
                    Draft.showDraftingErrorModal("Unable to start the Offline Draft");
                    console.log("startOfflineDraft() success");
                } else {
                    Draft.SendDraftStartNotifications();
                }
                console.log("startOfflineDraft() error");
            },
            error: function() {
                Draft.showDraftingErrorModal("Error while trying to start the Offline Draft");
                console.log("startOfflineDraft() ***ERROR***");
            },
            async: true,
            cache: false
        });
    };
    this.stopOfflineDraft = function() {
        console.log("stopOfflineDraft() called");       
        var url = '_stop_offline_draft.php';             
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            data: {},
            success: function(data){
                if(!data.success) {
                    Draft.showDraftingErrorModal("Unable to stop the Offline Draft");
                    console.log("stopOfflineDraft() success");
                } else {
                    Draft.SendDraftStopNotifications();
                }
                console.log("stopOfflineDraft() error");
            },
            error: function() {
                Draft.showDraftingErrorModal("Error while trying to stop the Offline Draft");
                console.log("stopOfflineDraft() ***ERROR***");
            },
            async: true,
            cache: false
        });
    };
    
    // Draft Results
    this.handleDraftChange = function(on_change_callback) {
        console.log("handleDraftChange() called");
        var url = '_get_last_pick_timestamp.php';
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            data: {},
            success: function(data){
                if(Draft.last_draft_timestamp !== data) {
                    console.log("checkForDraftChange() draft timestamp change detected");
                    Draft.last_draft_timestamp = data;                    
                    Draft.updateDraftResults();
                    Draft.updateOnTheClockData();
                    try {
                        on_change_callback();
                    } catch (ex){ }
                }                
                console.log("handleDraftChange() complete");
            },
            error: function() {
                console.log("checkForDraftChange() ***ERROR***");
            },
            async: false,
            cache: false
        });
    };
    this.startCheckForDraftChangeUpdate = function(on_change_callback){
        console.log("startCheckForDraftChangeUpdate() called");
        //this.handleDraftChange(on_change_callback);
        this.UPDATE_DRAFT_RESULTS_INTERVAL = setInterval(function(){Draft.handleDraftChange(on_change_callback);},this.DRAFT_RESULTS_UPDATE_SECONDS*1000);
        console.log("startCheckForDraftChangeUpdate() complete");
    };
    this.stopCheckForDraftChangeUpdate = function(){
        console.log("stopCheckForDraftChangeUpdate() called");
        clearInterval(this.UPDATE_DRAFT_RESULTS_INTERVAL);
        console.log("stopCheckForDraftChangeUpdate() complete");
    };
    this.updateDraftResults = function() {
        console.log("updateDraftResults() called");
        var url = '_get_draft_results.php?details=1';
        var return_value = false;
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            beforeSend: function(){},
            data: {},
            success: function(data){
                Draft.draft_results_data = data;
                console.log("updateDraftResults() complete");
            },
            error: function() {
                console.log("updateDraftResults() ***ERROR***");
                Draft.showDraftingErrorModal("Error updating the database");
                console.log("updateDraftResults() complete");
            },
            async: true,
            cache: false
        });
        return return_value;
    };
    this.updateFromMflDraftResults = function() {
        console.log("updateFromMflDraftResults() called");
        var url = '_update_draft_results.php';
        var return_value = false;
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            beforeSend: function(){},
            data: {},
            success: function(data){
                if(data.success) {
                   return_value = true;
                }
            },
            error: function() {
                 console.log("updateFromMflDraftResults() ***ERROR***");
            },
            async: false,
            cache: false
        });
        return return_value;
    };
    
    // Drafting
    this.SendDraftStartNotifications = function (){
        console.log("SendDraftStartNotifications() called");
        var url = '_send_draft_start_notification.php';
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: {},
            success: function(data){
                if(!data.success) {
                    Draft.showDraftingErrorModal(data.error);
                }
                console.log("SendDraftStartNotifications() complete");
            },
            error: function(data) {
                console.log("SendDraftStartNotifications() ***ERROR***");
                Draft.showDraftingErrorModal("ERROR SENDING NOTIFICATIONS");
                console.log("SendDraftStartNotifications() complete");
            },
            async: false,
            cache: false
        });
    };
    this.SendDraftStopNotifications = function (){
        console.log("SendDraftStopNotifications() called");
        var url = '_send_draft_stop_notification.php';
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: {},
            success: function(data){
                if(!data.success) {
                    Draft.showDraftingErrorModal(data.error);
                }
                console.log("SendDraftStopNotifications() complete");
            },
            error: function(data) {
                console.log("SendDraftStopNotifications() ***ERROR***");
                Draft.showDraftingErrorModal("ERROR SENDING NOTIFICATIONS");
                console.log("SendDraftStopNotifications() complete");
            },
            async: false,
            cache: false
        });
    };
    this.SendDraftPickNotifications = function (){
        console.log("SendDraftPickNotifications() called");
        var url = '_send_draft_pick_notification.php';
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: {},
            success: function(data){
                if(!data.success) {
                    Draft.showDraftingErrorModal(data.error);
                }
                console.log("SendDraftPickNotifications() complete");
            },
            error: function(data) {
                console.log("SendDraftPickNotifications() ***ERROR***");
                Draft.showDraftingErrorModal("ERROR SENDING NOTIFICATIONS");
                console.log("SendDraftPickNotifications() complete");
            },
            async: false,
            cache: false
        });
    };
    this.draftPlayerUsingMfl = function (player_id,on_success_callback){
        console.log("draftPlayerUsingMfl() called");
        var iframe = $('#draft_frame');
        var mfl_url = 'http://football.myfantasyleague.com/' + MFL_YEAR + '/live_chat?L=' + MFL_LEAGUE_ID + '&PLAYER_PICK='+player_id+'&XML=1';
        var db_url = '_can_player_be_drafted.php';
        $.ajax({
            type: "POST",
            url: db_url,
            dataType: "json",
            beforeSend: function(){
                Draft.showDraftingModal();
            },
            data: {player_id: player_id},
            success: function(data){
                if(data.success) {
                    iframe.attr('src', mfl_url);
                    document.getElementById('draft_frame').onload = function() {
                        if(Draft.updateFromMflDraftResults()) {
                            
                            Draft.SendDraftPickNotifications();
                            Draft.hideDraftingModal();
                            Draft.showDraftingSuccessModal();
                        } else {
                            Draft.showDraftingErrorModal("Error Updating Draft Results");
                        }
                        Draft.hideDraftingModal();
                        try { on_success_callback(); } catch(ex){}
                    }; 
                    
                } else {
                    Draft.hideDraftingModal();
                    Draft.showDraftingErrorModal(data.error);
                }
                console.log("draftPlayerUsingMfl() complete");
            },
            error: function(data) {
                console.log("draftPlayerUsingMfl() ***ERROR***");
                Draft.showDraftingErrorModal("Error Getting");
                console.log("draftPlayerUsingMfl() complete");
            },
            async: true,
            cache: false
        });
    };
    this.draftPlayerUsingDb = function (player_id,on_success_callback){
        console.log("draftPlayerUsingDb() called");
        var db_url = '_draft_db_player.php';
        $.ajax({
            type: "POST",
            url: db_url,            
            dataType: "json",
            data: {player_id: player_id},
            beforeSend: function(){
                Draft.showDraftingModal();
            },            
            success: function(data){
                if(data.success) {
                   Draft.SendDraftPickNotifications();
                   Draft.updateOnTheClockData();                   
                   Draft.hideDraftingModal();
                   Draft.showDraftingSuccessModal(); 
                   try { on_success_callback(); } catch(ex){}
                } else {
                    Draft.hideDraftingModal();
                    Draft.showDraftingErrorModal(data.error);
                }
                console.log("draftPlayerUsingDb() complete");
            },
            error: function() {
                console.log("draftPlayerUsingDb() ***ERROR***");
                Draft.showDraftingErrorModal("Error Getting");
                console.log("draftPlayerUsingDb() complete");
            },
            async: true,
            cache: false
        });
        return false;
    };
    this.draftPlayer = function (player_id, callback) {
        console.log("draftPlayer() called");
        if(MFL_DRAFT_ENABLED) {
            this.draftPlayerUsingMfl(player_id,callback);
        } else {
            this.draftPlayerUsingDb(player_id,callback);
        } 
        console.log("draftPlayer() complete");
    };
    
    // Watch Lists
    this.addPlayerToWatchList = function(player_id,on_success_callback) {
        console.log("addPlayerToWatchList() called");
        var url = '_add_player_id_to_watch_list.php';
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: {player_id: player_id},
            success: function(data){
                if(data.success) {
                    try { on_success_callback(); } catch(ex){}
                } else {
                    alert(data.error);
                }
                console.log("addPlayerToWatchList() complete");
            },
            error: function(data) {
                console.log("addPlayerToWatchList() ***ERROR");
                alert("Could Not Add Player");
                console.log("addPlayerToWatchList() complete");
            },
            async: true,
            cache: false
        });  
    };
    this.removePlayerFromWatchList = function(player_id,on_success_callback) {
        console.log("removePlayerFromWatchList() called");
        var url = '_remove_player_id_from_watch_list.php';
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: {player_id: player_id},
            success: function(data){
                if(data.success) {
                    try { on_success_callback(); } catch(ex){}
                } else {
                    alert(data.error);
                }
                console.log("removePlayerFromWatchList() complete");
            },
            error: function(data) {
                console.log("removePlayerFromWatchList() ***ERROR");
                alert("Could Not Remove Player");
                console.log("removePlayerFromWatchList() complete");
            },
            async: true,
            cache: false
        });  
    };
    this.moveWatchedPlayerUp = function(player_id,on_success_callback) {
        console.log("moveWatchedPlayerUp() called");
        var url = '_move_watched_player.php';
        var return_value = false;
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            beforeSend: function(){},
            data: {
                player_id:player_id,
                action:'up'
            },
            success: function(){
                if(on_success_callback) { on_success_callback(); }
                console.log("moveWatchedPlayerUp() complete");
            },
            error: function() {
                console.log("moveWatchedPlayerUp() ***ERROR***");
                console.log("moveWatchedPlayerUp() complete");
            },
            async: true,
            cache: false
        });
        return return_value;
    };
    this.moveWatchedPlayerDown = function(player_id,on_success_callback) {
        console.log("moveWatchedPlayerDown() called");
        var url = '_move_watched_player.php';
        var return_value = false;
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            beforeSend: function(){},
            data: {
                player_id:player_id,
                action:'down'
            },
            success: function(){
                if(on_success_callback) { on_success_callback(); }
                console.log("moveWatchedPlayerDown() complete");
            },
            error: function() {
                console.log("moveWatchedPlayerDown() ***ERROR***");
                console.log("moveWatchedPlayerDown() complete");
            },
            async: true,
            cache: false
        });
        return return_value;
    };
    this.moveWatchedPlayerToTop = function(player_id,on_success_callback) {
        console.log("moveWatchedPlayerToTop() called");
        var url = '_move_watched_player.php';
        var return_value = false;
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            beforeSend: function(){},
            data: {
                player_id:player_id,
                action:'top'
            },
            success: function(){
                if(on_success_callback) { on_success_callback(); }
                console.log("moveWatchedPlayerToTop() complete");
            },
            error: function() {
                console.log("moveWatchedPlayerToTop() ***ERROR***");
                console.log("moveWatchedPlayerToTop() complete");
            },
            async: true,
            cache: false
        });
        return return_value;
    };
    this.moveWatchedPlayerToBottom = function(player_id,on_success_callback) {
        console.log("moveWatchedPlayerToBottom() called");
        var url = '_move_watched_player.php';
        var return_value = false;
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            beforeSend: function(){},
            data: {
                player_id:player_id,
                action:'bottom'
            },
            success: function(){
                if(on_success_callback) { on_success_callback(); }
                console.log("moveWatchedPlayerToBottom() complete");
            },
            error: function() {
                console.log("moveWatchedPlayerToBottom() ***ERROR***");
                console.log("moveWatchedPlayerToBottom() complete");
            },
            async: true,
            cache: false
        });
        return return_value;
    };
    
    // Player Details
    this.showPlayerDetails = function(player_id) {
        var url = "http://football3.myfantasyleague.com/2014/player?L=44111&P="+player_id;
        window.open(url,'_blank');
    };
    
    this.updateDraftStatus = function(status_change_callback) {
        console.log("updateDraftStatus() called");       
        var url = '_is_draft_active.php';             
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            data: {},
            success: function(data){
                if(!JSON.parse(data) && Draft.DRAFT_ACTIVE) {
                    Draft.DRAFT_ACTIVE = false;
                    if(status_change_callback) {
                        Draft.updateDraftResults();
                        Draft.updateOnTheClockData();
                        status_change_callback();
                    }
                } else if(JSON.parse(data) && !Draft.DRAFT_ACTIVE) {
                    Draft.DRAFT_ACTIVE = true;
                    if(status_change_callback) {
                        Draft.updateDraftResults();
                        Draft.updateOnTheClockData();
                        status_change_callback();
                    }
                }
                console.log("updateDraftStatus() complete");
            },
            error: function() {
                console.log("updateDraftStatus() ***ERROR***");
            },
            async: true,
            cache: false
        });
    };
    this.startCheckingForDraftStatus = function(status_change_callback){
        console.log("startCheckingForDraftStatus() called");
        this.updateDraftStatus(status_change_callback);
        this.UPDATE_DRAFT_STATUS_INTERVAL = setInterval(function(){Draft.updateDraftStatus(status_change_callback);},this.DRAFT_STATUS_UPDATE_SECONDS*1000);
        console.log("startCheckingForDraftStatus() complete");
    };
    this.stopCheckingForDraftStatus = function(){
        console.log("stopCheckingForDraftStatus() called");
        clearInterval(this.UPDATE_DRAFT_STATUS_INTERVAL);
        console.log("stopCheckingForDraftStatus() complete");
    };
    
    this.getPlayerInformation = function(player_id) {
        console.log("getPlayerInformation() called");  
        var return_data = null;
        var url = '_get_player_information.php';             
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            data: {player_id:player_id},
            success: function(data){   
                return_data = data;
                console.log("getPlayerInformation() complete");
            },
            error: function() {
                console.log("getPlayerInformation() ***ERROR***");
            },
            async: false,
            cache: false
        });
        return return_data;
    };
    
    //Initialization
    this.init();
}