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
    <script type="text/javascript" language="javascript" src="js/notification_modals.js"></script>
    <script type="text/javascript" src="bootstrap-3.1.1/js/bootstrap.min.js"></script>
    <link href="bootstrap-3.1.1/css/bootstrap.min.css" rel="stylesheet">
    
    <script>
        var heartbeat_delay = 3; //in seconds
        var update_heartbeat = true;
        
        $(document).ready(function() {
            StartUpdatingHeartbeat();
        });

        function SendHeartbeatUpdate() {
            WriteScreenMessage("Sending Heartbeat Update...");
            $.ajax({
                type: "POST",
                url: '_update_admin_heartbeat.php',
                dataType: "json",
                data: {},
                success: function(data){
                    if(data !== true) {
                        WriteScreenMessage("***Heartbeat Update Error***");
                    } else {
                        WriteScreenMessage("Heartbeat Updated!");
                    }
                },
                error: function(data) {
                    WriteScreenMessage("***POST Error***");
                },
                async: true,
                cache: false
            });
        }
        function StartUpdatingHeartbeat(franchise_id) {
            setInterval(function(){SendHeartbeatUpdate()},heartbeat_delay*1000);
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
        <div id="screen_log_div"><hr><h3>LOG</h3><hr></div>        
    </div>
    <!-- /Container -->
    
    <!-- Footer -->
    <?php include 'footer.php'; ?> 
    <!-- /Footer -->
  </body>
</html>