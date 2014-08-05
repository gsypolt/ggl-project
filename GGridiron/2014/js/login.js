/**
* @copyright Copyright (C) 2014  SmythLLC
* @author Gregory A. Smyth
*/

function Login () {
    // Initialization
    this.init = function() {
        addLoggingInModal();
        addErrorModal();
        addLoginIframe();
    };

    // HTML Adding
    function addLoggingInModal() {
        var html =  "";
        html += '<div class="modal" id="login_modal_logging_in" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">';
        html +=     '<div class="modal-dialog" style="width:400px;margin-top:75px;">';
        html +=         '<div class="modal-content">';
        html +=             '<div class="modal-body center" align="center">';
        html +=                 '<h3>Checking Login...</h3>';
        html +=             '</div>';
        html +=         '</div>';
        html +=     '</div>';
        html += '</div>';   
        $("body").append(html); 
    }
    function addErrorModal() {
        var html =  "";
        html += '<div class="modal" id="login_modal_error" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">';
        html +=     '<div class="modal-dialog" style="width:400px;margin-top:75px;">';
        html +=         '<div class="modal-content">';
        html +=             '<div class="modal-body center" align="center">';
        html +=                 '<h3>ERROR</h3>';
        html +=                 '<br>';
        html +=                 '<h4><div id="login_modal_error_text"></div></h4>';
        html +=             '</div>';
        html +=             '<div class="modal-footer">';
        html +=                 '<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Acknowledge</button>';
        html +=             '</div>';
        html +=         '</div>';
        html +=     '</div>';
        html += '</div>';        
        $("body").append(html); 
    }

    // Loading Modal
    function show_logging_in_modal() {
        $('#login_modal_logging_in').modal('show');
    }
    this.show_logging_in_modal = function (){
        show_logging_in_modal();
    };

    function hide_logging_in_modal() {
        $('#login_modal_logging_in').modal('hide');
    }
    this.hide_logging_in_modal = function (){
        hide_logging_in_modal();
    };

    // Error Modal
    function show_error_modal() {
        $('#login_modal_error_text').html('<h4>Incorrect Login</h4>');
        $('#login_modal_error').modal('show');
    }
    this.show_error_modal = function (message){   
        show_error_modal();
    };
    
    function addLoginIframe() {
        $("body").append('<iframe id="login_frame" width="0" height="0" src="" class="hidden"></iframe>');
        //$("body").append('<iframe id="login_frame" width="800" height="800" src="" class=""></iframe>');
    }
    
    function login(franchise_id, password, callback) {
        var iframe = $('#login_frame');
        $.ajax({
           type: "POST",
           url: '_login.php',
           dataType: "json",
           data: {
               franchise_id:franchise_id,
               password:password
           },
           beforeSend: function(){
               show_logging_in_modal();
           },
           success: function(data){
               if(data.success) {
                    password = encodeURIComponent(password);
                    var mfl_url = 'http://football3.myfantasyleague.com/' + MFL_YEAR + '/login?L=' + MFL_LEAGUE_ID + '&FRANCHISE_ID=' + franchise_id + '&PASSWORD=' + password + '&XML=1';
                    iframe.attr('src', mfl_url);
                    document.getElementById('login_frame').onload = function() {
                        hide_logging_in_modal();
                        callback();                            
                    };
               } else {
                   hide_logging_in_modal();
                   show_error_modal(data.error);
               }
           },
           error: function(data) {
               hide_logging_in_modal();
               show_error_modal("Error Getting");
           },
           async: true,
           cache: false
       });
    }
    this.login = function (franchise_id, password, callback){
        login(franchise_id, password, callback);
    };

    this.init();
}