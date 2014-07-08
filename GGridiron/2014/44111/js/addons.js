/**
* DREAMS - Digitally Released Engineering Articles Management System 
* 
* @package DREAMS
* @copyright Copyright (C) 2014  SmythLLC
* @author Gregory A. Smyth
*
*/

//jQuery add-ons
(function($){
    $.get_url_var = function(key){
        var result = new RegExp(key + "=([^&]*)", "i").exec(window.location.search); 
        return result && unescape(result[1]) || ""; 
    };
})(jQuery);
