<?php
    require_once "core.php";    
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Goal-Line Gridiron</title>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" language="javascript" src="jQuery/jquery-2.0.3.js"></script>
    <script type="text/javascript" language="javascript" src="js/modals.js"></script>
    <script type="text/javascript" src="bootstrap-3.1.1/js/bootstrap.min.js"></script>
    <link href="bootstrap-3.1.1/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="js/login.js"></script>
    <style type="text/css">
        body { 
            padding-top: 60px; 
        }
        .AddBorder {
            border: 2px solid #FFFFCC;
        }
        .HoverHand {
            cursor: pointer;
        }
        .AddContainerBackground {
            background-image: url(images/background/dark_wood.png);
            position: relative;
            width: 101%;
            margin-top: -10px;
            margin-left: -10px;
            margin-right: -200px;
            margin-bottom: -10px;
	}
        .AddDivBackground {
            background-color: #FFFFFF;
            padding: 0 90px;
        }

    </style>
    
    <script>
        var modals = null;
        var login = null;
        
        $(document).ready(function() {
            login = new Login();
            modals = new Modals();
            UpdateFranchiseIcons();
        });
        
        function UpdateFranchiseIcons() {          
            $.ajax({
                type: "POST",
                url: '_get_franchises.php',
                dataType: "json",
                data: {},
                success: function(data){
                    var html = '';
                    for(var i = 0; i < data.length; i++) {
                        html += '<div class="col-md-6">';
                        html += '<img class="AddBorder HoverHand" src="'+data[i].icon_url+'" id="'+data[i].id+'"alt="'+data[i].name+'" onclick="PopulateAndShowLoginModal(\''+data[i].id+'\',\''+data[i].name+'\')"></img>';
                        html += '<br><br>';
                        html += '</div>';
                    }
                     $('#franchises_div').html(html); 
                },
                error: function(data) {
                    //modals.show_error_modal("***POST ERROR***");
                },
                async: true,
                cache: false
            });
        }
        function AttemptLogin() {
            $('#login_modal').modal('hide');
            
            var password = $('#password').val();
            $('#password').val("");
            var franchise_id = $('#franchise_id').val();    
 
            login.login(franchise_id, password, function() {window.location.replace("draft_room.php");});        
        }
        
        function CloseLoginModal() {
            $('#login_modal').modal('hide');
        }
        function PopulateLoginModal(franchise_id, franchise_name) {
            $('#franchise_id').val(franchise_id);
            $('#franchise_name').val(franchise_name);
        }
        function PopulateAndShowLoginModal(franchise_id, franchise_name) {
            PopulateLoginModal(franchise_id, franchise_name);
            ShowLoginModal();
        }
        function ShowLoginModal() {            
            $('#login_modal').modal('show');
            $("#password").focus();
        }
        function IsLoginModalShown() {
            if($('#login_modal').hasClass('in')) {
                return true;
            }
            return false;
        }
        
        $(document).keydown(function(event){
            if(event.keyCode === 13 && IsLoginModalShown()) {
                AttemptLogin();
            }
        });
    </script>
  </head>
  <body>
    <!-- Navigation --> 
    <?php include 'navigation.php'; ?>
    <!-- /Navigation -->  
    
    <div class="AddContainerBackground">
        <!-- Container -->
        <div class="container">
            <div class="row">                
                <div class="col-md-8 col-md-offset-2">
                    <div class="AddDivBackground" align="center"><h1><b>SELECT YOUR FRANCHISE</b></h1></div>
                    <br>
                    <div align="center" id="franchises_div"></div>
                    <p>&nbsp;<p><p>&nbsp;<p><p>&nbsp;<p><p>&nbsp;<p><p>&nbsp;<p><p>&nbsp;<p><p>&nbsp;<p>
                </div>
            </div>            
        </div>
        <!-- /Container -->
    
        <!-- Footer -->
        <?php include 'footer.php'; ?> 
        <!-- /Footer -->
    </div>
    
    <!-- Login Modal -->
    <div class="modal" id="login_modal" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" style="width:400px;margin-top:75px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
                    <h4 class="modal-title"><i class="glyphicon glyphicon-globe"></i> Franchise Log In</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input id="franchise_id" name="franchise_id" disabled hidden></input>
                        <input id="franchise_name" name="franchise_name" type="text" class="form-control" placeholder="Franchise Name" required autofocus disabled></input>
                    </div>
                    <p/>
                    <div class="input-group" id="password_input_div">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input id="password" name="password" type="password" class="form-control" placeholder="Password" required></input>
                    </div>
                    <br><button name="submit" type="submit" class="btn btn-primary btn-block" onclick="AttemptLogin()">Log In</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Login Modal -->
    
    <!-- End Header and Nav -->
  </body>
</html>