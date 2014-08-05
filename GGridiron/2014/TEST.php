<?php
    require_once "core.php";
?>
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
        
        <script type="text/javascript">
            var draft = null;
            var count = 0;
            $(document).ready(function() {  
                draft = new Draft();   
            });
            function AddToBoady() {
                $("body").append("UPDATED:"+count+", ");
                count++;
            }
        </script>
    </head>

    <body>        
        &nbsp;&nbsp;&nbsp;<button class="btn btn-primary" onclick="alert(draft.on_the_clock_data.on_time)"><span class="glyphicon glyphicon-star"></span> CHECK OTC</button>
        &nbsp;&nbsp;&nbsp;<button class="btn btn-primary" onclick="draft.updateOnTheClockData()"><span class="glyphicon glyphicon-star"></span> UPDATE OTC</button>
        &nbsp;&nbsp;&nbsp;<button class="btn btn-primary" onclick="draft.startOnTheClockUpdate()"><span class="glyphicon glyphicon-star"></span> START OTC UPDATE</button>
        &nbsp;&nbsp;&nbsp;<button class="btn btn-primary" onclick="draft.stopOnTheClockUpdate()"><span class="glyphicon glyphicon-star"></span> STOP OTC UPDATE</button>
        <hr>
        &nbsp;&nbsp;&nbsp;<button class="btn btn-primary" onclick="draft.startLiveDraft()"><span class="glyphicon glyphicon-star"></span> START LIVE DRAFT</button>
        &nbsp;&nbsp;&nbsp;<button class="btn btn-primary" onclick="draft.stopLiveDraft()"><span class="glyphicon glyphicon-star"></span> STOP LIVE DRAFT</button>
        &nbsp;&nbsp;&nbsp;<button class="btn btn-primary" onclick="draft.startOfflineDraft()"><span class="glyphicon glyphicon-star"></span> START OFFLINE DRAFT</button>
        &nbsp;&nbsp;&nbsp;<button class="btn btn-primary" onclick="draft.stopOfflineDraft()"><span class="glyphicon glyphicon-star"></span> STOP OFFLINE DRAFT</button>
        <hr>
        &nbsp;&nbsp;&nbsp;<button class="btn btn-primary" onclick="draft.handleDraftChange(AddToBoady)"><span class="glyphicon glyphicon-star"></span> UPDATE DRAFT RESULTS</button>
        &nbsp;&nbsp;&nbsp;<button class="btn btn-primary" onclick="draft.startCheckForDraftChangeUpdate(AddToBoady)"><span class="glyphicon glyphicon-star"></span> START DRAFT RESULTS UPDATE</button>
        &nbsp;&nbsp;&nbsp;<button class="btn btn-primary" onclick="draft.stopCheckForDraftChangeUpdate(AddToBoady)"><span class="glyphicon glyphicon-star"></span> STOP DRAFT RESULTS UPDATE</button>
        
    </body>
</html>