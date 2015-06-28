/**
* @copyright Copyright (C) 2014  SmythLLC
* @author Gregory A. Smyth
*/
function League () {    
    var League = this;
   
    this.init = function() {
        // Do something
    };
    
    // Updates
    this.updateLeague = function() {
        console.log("updateLeague() called");       
        var url = '_update_league.php';             
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            data: {},
            success: function(data){
                console.log("updateLeague() success");
            },
            error: function() {
                 console.log("updateLeague() ***ERROR***");
            },
            async: true,
            cache: false
        });
    };
    this.updateFreeAgents = function() {
        console.log("updateFreeAgents() called");       
        var url = '_update_free_agents.php';             
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            data: {},
            success: function(data){
                console.log("updateFreeAgents() success");
            },
            error: function() {
                 console.log("updateFreeAgents() ***ERROR***");
            },
            async: true,
            cache: false
        });
    };
    this.updateInjuries = function() {
        console.log("updateInjuries() called");       
        var url = '_update_injuries.php';             
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            data: {},
            success: function(data){
                console.log("updateInjuries() success");
            },
            error: function() {
                 console.log("updateInjuries() ***ERROR***");
            },
            async: true,
            cache: false
        });
    };
    this.updatePlayers = function() {
        console.log("updatePlayers() called");       
        var url = '_update_players.php';             
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            data: {},
            success: function(data){
                console.log("updatePlayers() success");
            },
            error: function() {
                 console.log("updatePlayers() ***ERROR***");
            },
            async: true,
            cache: false
        });
    };
    this.updatePlayerScores = function() {
        console.log("updatePlayerScores() called");       
        var url = '_update_player_scores.php';             
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            data: {},
            success: function(data){
                console.log("updatePlayerScores() success");
            },
            error: function() {
                 console.log("updatePlayerScores() ***ERROR***");
            },
            async: true,
            cache: false
        });
    };
    this.updateRosterPlayers = function() {
        console.log("updateRosterPlayers() called");       
        var url = '_update_roster_players.php';             
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            data: {},
            success: function(data){
                console.log("updateRosterPlayers() success");
            },
            error: function() {
                 console.log("updateRosterPlayers() ***ERROR***");
            },
            async: false,
            cache: false
        });
    };
    
    // Initialization
    this.init();
}