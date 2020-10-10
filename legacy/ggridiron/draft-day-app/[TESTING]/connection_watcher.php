<?php
    require_once "core.php";
    # TODO CHECK LOGIN and FWD
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
  <head>
    <title>Goal-Line Gridiron</title>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" language="javascript" src="jQuery/jquery-2.0.3.js"></script>
    <script type="text/javascript" language="javascript" src="js/modals.js"></script>
    <script type="text/javascript" src="bootstrap-3.1.1/js/bootstrap.min.js"></script>
    <link href="bootstrap-3.1.1/css/bootstrap.min.css" rel="stylesheet">
    
    <script>
        var refresh_delay = 5; //in seconds
        var update_heartbeat = true;
        
        $(document).ready(function() {
            StartCheckingAdminConnection();
            StartCheckingFranchiseConnections();
        });

        function CheckAdminConnection() {
            $.ajax({
                type: "GET",
                url: '_is_admin_connected.php',
                dataType: "json",
                data: {},
                success: function(data){
                    if(data === true) {
                        WriteScreenMessage("Admin Connection = CONNECTED!");
                    } else {
                        WriteScreenMessage("Admin Connection = <b>DISCONNECTED!</b>");
                    }
                },
                error: function(data) {
                    WriteScreenMessage("***GET Error***");
                },
                async: true,
                cache: false
            });
        }
        function CheckFranchiseConnections() {
            $.ajax({
                type: "GET",
                url: '_get_franchise_connections.php',
                dataType: "json",
                data: {},
                success: function(data){
                    if(data.length > 0) {
                        for(var i=0; i < data.length; i++) {
                            WriteScreenMessage("Franchise "+data[i].franchise_id+" = CONNECTED!");
                        }                        
                    }
                },
                error: function(data) {
                    WriteScreenMessage("***GET Error***");
                },
                async: true,
                cache: false
            });
        }
        function StartCheckingAdminConnection() {
            setInterval(function(){CheckAdminConnection()},refresh_delay*1000);
        }
        function StartCheckingFranchiseConnections() {
            setInterval(function(){CheckFranchiseConnections()},refresh_delay*1000);
        }
        function WriteScreenMessage(message) {
            $('#screen_log_div').append(message+"<br>");            
        }
    </script>
  </head>
  <body>
    <!-- Navigation --> 
    <?php include 'navigation.php'; ?>
    <!-- /Navigation -->  
    
    <!-- Container -->
    <div class="container">
        <div class="row">
            
        </div>
        <hr><h3>LOG</h3><hr>
        <div id="screen_log_div"></div>        
    </div>
    <!-- /Container -->
    
    <!-- Footer -->
    <?php include 'footer.php'; ?> 
    <!-- /Footer -->
  </body>
</html>