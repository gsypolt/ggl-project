/**
* @copyright Copyright (C) 2014  SmythLLC
* @author Gregory A. Smyth
*/

function Modals () {
    var SUCCESS_MODAL_SHOW_TIME = 1000;
    
    // Initialization
    this.init = function() {
        addProcessingModal();
        addErrorModal();
        addNotificationModal();
        addSuccessModal();
    };

    // HTML Adding
    function addProcessingModal() {
        var html =  "";
        html += '<div class="modal" id="modal_static_processing" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">';
        html +=     '<div class="modal-dialog" style="width:400px;margin-top:75px;">';
        html +=         '<div class="modal-content">';
        html +=             '<div class="modal-body center" align="center">';
        html +=                 '<h3>Processing...</h3>';
        html +=             '</div>';
        html +=         '</div>';
        html +=     '</div>';
        html += '</div>';   
        $("body").append(html); 
    }
    function addErrorModal() {
        var html =  "";
        html += '<div class="modal" id="modal_error" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">';
        html +=     '<div class="modal-dialog" style="width:400px;margin-top:75px;">';
        html +=         '<div class="modal-content">';
        html +=             '<div class="modal-body center" align="center">';
        html +=                 '<h3>ERROR</h3>';
        html +=                 '<br>';
        html +=                 '<h4><div id="modal_error_text"></div></h4>';
        html +=             '</div>';
        html +=             '<div class="modal-footer">';
        html +=                 '<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Acknowledge</button>';
        html +=             '</div>';
        html +=         '</div>';
        html +=     '</div>';
        html += '</div>';        
        $("body").append(html); 
    }
    function addNotificationModal() {
        var html =  "";
        html += '<div class="modal" id="modal_notification" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">';
        html +=     '<div class="modal-dialog style="width:300px;margin-top:75px;"">';
        html +=         '<div class="modal-content">';
        html +=             '<div class="modal-header"></div>';
        html +=             '<div class="modal-body center" align="center">';
        html +=                 '<div id="modal_notification_text"></div>';
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
        html += '<div class="modal" id="modal_success" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">';
        html +=     '<div class="modal-dialog" style="width:400px;margin-top:75px;">';
        html +=         '<div class="modal-content">';
        html +=             '<div class="modal-body center" align="center">';
        html +=                 '<h3>SUCCESS</h3>';
        html +=             '</div>';
        html +=         '</div>';
        html +=     '</div>';
        html += '</div>';   
        $("body").append(html); 
    }

    // Loading Modal
    function show_loading_modal() {
        $('#modal_static_processing').modal('show');
    }
    this.show_loading_modal = function (){
        show_loading_modal();
    };

    function hide_loading_modal() {
        $('#modal_static_processing').modal('hide');
    }
    this.hide_loading_modal = function (){
        hide_loading_modal();
    };

    // Error Modal
    function show_error_modal(message) {
        $('#modal_error_text').html('<h4>' + message + '</h4>');
        $('#modal_error').modal('show');
    }
    this.show_error_modal = function (message){   
        show_error_modal(message);
    };

    // Notification Modal
    function show_notification_modal(message) {
        $('#modal_notification_text').html('<h4>' + message + '</h4>');
        $('#modal_notification').modal('show');
    }
    this.show_notification_modal = function (message){
        show_notification_modal(message);
    };

    // Success Modal
    function show_success_modal(display_time) {
        
        $('#modal_success').modal('show');
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
        $('#modal_success').modal('hide');
    }
    this.hide_success_modal = function (){
        hide_success_modal();
    };

    // Initialization
    this.init();
}