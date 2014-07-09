/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var MFL_DRAFT_ENABLED = false;
var MFL_YEAR = null;
var MFL_LEAGUE_ID = null;

this.init = function() {
    var url = '_get_php_globals.php';
    var return_value = false;
    $.ajax({
        type: "GET",
        url: url,
        dataType: "json",
        beforeSend: function(){},
        data: {},
        success: function(data){
            MFL_YEAR = data.MFL_YEAR;
            MFL_LEAGUE_ID = data.MFL_LEAGUE_ID;
        },
        error: function() {
            
        },
        async: false,
        cache: false
    });
    return return_value;
};

this.init();