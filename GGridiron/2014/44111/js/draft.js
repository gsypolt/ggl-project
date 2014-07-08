/**
* @copyright Copyright (C) 2014  SmythLLC
* @author Gregory A. Smyth
*/

function Draft () {
    var MFL_DRAFT_ENABLED = true;
    var SUCCESS_MODAL_SHOW_TIME = 1000;
    var MFL_YEAR = 2014;
    var MFL_LEAGUE_ID = 44111;
    
    // Initialization
    this.init = function() {
        addDraftingModal();
        addErrorModal();
        addSuccessModal();
        addDraftingIframe();
    };

    // HTML Adding
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

    // Loading Modal
    function show_drafting_modal() {
        $('#draft_modal_drafting').modal('show');
    }
    this.show_drafting_modal = function (){
        show_drafting_modal();
    };

    function hide_drafting_modal() {
        $('#draft_modal_drafting').modal('hide');
    }
    this.hide_drafting_modal = function (){
        hide_drafting_modal();
    };

    // Error Modal
    function show_error_modal(message) {
        $('#draft_modal_error_text').html('<h4>' + message + '</h4>');
        $('#draft_modal_error').modal('show');
    }
    this.show_error_modal = function (message){   
        show_error_modal(message);
    };

    // Success Modal
    function show_success_modal(display_time) {        
        $('#draft_modal_success').modal('show');
        if(display_time) {
            setTimeout(hide_success_modal,display_time);
        } else {
            setTimeout(hide_success_modal,SUCCESS_MODAL_SHOW_TIME);
        }
        
    }
    this.show_success_modal = function (display_time){
        show_success_modal(display_time);
    };

    function hide_success_modal() {
        $('#draft_modal_success').modal('hide');
    }
    this.hide_success_modal = function (){
        hide_success_modal();
    };
    
    function addDraftingIframe() {
        $("body").append('<iframe id="draft_frame" width="800" height="800" src="" class="hidden"></iframe>');
        //$("body").append('<iframe id="draft_frame" width="800" height="800" src="" class=""></iframe>');
    }
    
    function update_draft_results() {
        var db_url = '_update_draft_results.php';
        var return_value = false;
        $.ajax({
            type: "POST",
            url: db_url,
            dataType: "json",
            beforeSend: function(){},
            data: {},
            success: function(data){
                if(data.success) {
                   return_value = true;
                }
            },
            error: function() {
                 show_error_modal("Error Getting");
            },
            async: false,
            cache: false
        });
        return return_value;
    }
    this.update_draft_results = function (){
        return update_draft_results();
    };
    
    function draft_player_using_mfl(player_id, callback) {
        var iframe = $('#draft_frame');
        var mfl_url = 'http://football.myfantasyleague.com/' + MFL_YEAR + '/live_chat?L=' + MFL_LEAGUE_ID + '&PLAYER_PICK='+player_id+'&XML=1';
        //var mfl_url = '';
        var db_url = '_can_player_be_drafted.php';
        $.ajax({
            type: "POST",
            url: db_url,
            dataType: "json",
            beforeSend: function(){
                show_drafting_modal();
            },
            data: {player_id: player_id},
            success: function(data){
                if(data.success) {
                    iframe.attr('src', mfl_url);
                    document.getElementById('draft_frame').onload = function() {
                        if(update_draft_results()) {
                            hide_drafting_modal();
                            show_success_modal();
                        } else {
                            show_error_modal("Error Updating Draft Results");
                        }
                        hide_drafting_modal();
                        callback();                            
                    }; 
                    
                } else {
                    hide_drafting_modal();
                    show_error_modal(data.error);
                }
            },
            error: function(data) {
                 show_error_modal("Error Getting");
            },
            async: true,
            cache: false
        });
    }
    this.draft_player_using_mfl = function (player_id,callback){
        draft_player_using_mfl(player_id,callback);
    };
    function draft_player_using_db(player_id, callback) {
        var db_url = '_draft_player.php';
        $.ajax({
            type: "POST",
            url: db_url,            
            dataType: "json",
            data: {player_id: player_id},
            beforeSend: function(){
                show_drafting_modal();
            },            
            success: function(data){
                if(data.success) {
                   hide_drafting_modal();
                   show_success_modal();
                   callback();
                } else {
                    hide_drafting_modal();
                    show_error_modal(data.error);
                }
            },
            error: function() {
                 show_error_modal("Error Getting");
            },
            async: true,
            cache: false
        });
        return false;
    }
    this.draft_player_using_db = function (player_id,callback){
        draft_player_using_db(player_id,callback);
    };
    
    function draft_player(player_id, callback) {
        if(MFL_DRAFT_ENABLED) {
            draft_player_using_mfl(player_id,callback);
        } else {
            draft_player_using_db(player_id,callback);
        }       
    }
    this.draft_player = function (player_id,callback){
        draft_player(player_id,callback);
    };

    this.init();
}